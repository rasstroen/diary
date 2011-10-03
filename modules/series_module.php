<?php

// модуль отвечает за отображение баннеров
class series_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;
		$this->series_id = isset($params['series_id']) ? $params['series_id'] : 0;

		switch ($this->action) {
			case 'show':
				$this->getOne();
				break;
			case 'edit':
				$this->getOne();
				break;
			case 'new':

				break;
			case 'list':
				switch ($this->mode) {
					default:
						$this->getAll();
						break;
				}
				break;
			default:
				throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
				break;
		}
	}

	function getAll() {
		$series = Database::sql2array('SELECT id,title,position,books_count FROM `series` WHERE `books_count`>0 AND `id_parent`=0 ORDER BY `books_count` DESC LIMIT 20', 'id');

		$series_books = Database::sql2array('SELECT * FROM `book_series` WHERE id_series IN (' . implode(',', array_keys($series)) . ')');
		$bid = array();

		$cnt = array();
		$series_books_p = array();
		foreach ($series_books as $sb) {
			$cnt[$sb['id_series']] = isset($cnt[$sb['id_series']]) ? $cnt[$sb['id_series']] + 1 : 1;
			if ($cnt[$sb['id_series']] > 10)
				continue;
			$series_books_p[$sb['id_series']][] = $sb;
			$bid[$sb['id_book']] = $sb['id_book'];
		}

		if (count($bid)) {
			Books::getByIdsLoaded($bid);
			Books::LoadBookPersons($bid);
		}

		foreach ($series_books_p as &$sb) {
			foreach ($sb as &$bookrow) {
				$book = Books::getById($bookrow['id_book']);
				list($aid, $aname) = $book->getAuthor(1, 1, 1); // именно наш автор, если их там много
				$bookrow = array('id' => $book->id,
				    'cover' => $book->getCover(),
				    'title' => $book->getTitle(true),
				    'author' => $aname,
				    'author_id' => $aid,
				    'lastSave' => $book->data['modify_time']);
			}
		}


		foreach ($series as $id => &$ser) {
			$this->data['series'][$id] = $ser;
			$this->data['series'][$id]['books'] = isset($series_books_p[$id]) ? $series_books_p[$id] : array();
			$this->data['series'][$id]['books']['count'] = $ser['books_count'];
			$this->data['series'][$id]['books']['title'] = $ser['title'];
			$this->data['series'][$id]['books']['link_url'] = 's/' . $ser['id'];
			$this->data['series'][$id]['books']['link_title'] = 'Смотреть серию';
			unset($this->data['series'][$id]['books_count']);
		}
	}

	function getOne() {
		if (!$this->series_id)
			return;
		$series = Database::sql2array('SELECT id,title,position,books_count,id_parent,description FROM `series` WHERE `id`=' . $this->series_id . ' OR `id_parent`=' . $this->series_id, 'id');
		$parent_id = $series[$this->series_id]['id_parent'];
		if ($parent_id) {
			$parentInfo = Database::sql2array('SELECT id,title,position,books_count,id_parent FROM `series` WHERE `id`=' . $parent_id, 'id');
		}else
			$parentInfo = array();
		$series_books = Database::sql2array('SELECT * FROM `book_series` WHERE id_series IN (' . implode(',', array_keys($series)) . ')');
		$bid = array();

		$cnt = array();
		$series_books_p = array();
		foreach ($series_books as $sb) {
			$cnt[$sb['id_series']] = isset($cnt[$sb['id_series']]) ? $cnt[$sb['id_series']] + 1 : 1;
	
			$series_books_p[$sb['id_series']][] = $sb;
			$bid[$sb['id_book']] = $sb['id_book'];
		}

		if (count($bid)) {
			Books::getByIdsLoaded($bid);
			Books::LoadBookPersons($bid);
		}

		foreach ($series_books_p as &$sb) {
			foreach ($sb as &$bookrow) {
				$book = Books::getById($bookrow['id_book']);
				list($aid, $aname) = $book->getAuthor(1, 1, 1); // именно наш автор, если их там много
				$bookrow = array('id' => $book->id,
				    'cover' => $book->getCover(),
				    'title' => $book->getTitle(true),
				    'author' => $aname,
				    'author_id' => $aid,
				    'lastSave' => $book->data['modify_time']);
			}
		}

		$this->data['serie']['series'] = array();

		$this->data['serie'] = $series[$this->series_id];
		$this->data['serie']['books'] = isset($series_books_p[$this->series_id]) ? $series_books_p[$this->series_id] : array();
		$this->data['serie']['books']['count'] = isset($cnt[$this->series_id]) ? $cnt[$this->series_id] : 0;

		foreach ($series as $id => $ser) {
			if ($ser['id'] == $this->series_id) {
				unset($this->data['serie']['books_count']);
				continue;
			} else {
				$this->data['serie']['series'][$id] = $ser;
				$this->data['serie']['series'][$id]['books'] = isset($series_books_p[$id]) ? $series_books_p[$id] : array();
				$this->data['serie']['series'][$id]['books']['count'] = $ser['books_count'];
				unset($this->data['serie']['series'][$id]['books_count']);
			}
		}
		$this->data['serie']['parent'] = $parentInfo;
	}

}