<?php

// модуль отвечает за отображение баннеров
class genres_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;
		$this->genre_name = isset($params['genre_name']) ? $params['genre_name'] : false;
		$this->user_id = isset($params['user_id']) ? $params['user_id'] : $current_user->id;
		$this->author_id = isset($params['author_id']) ? $params['author_id'] : $current_user->id;

		switch ($this->action) {

			case 'list':
				switch ($this->mode) {
					default:
						$this->data['genres'] = $this->getAll();
						break;
				}
				break;
			case 'show':
				$this->getOne();
				break;
			default:
				throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
				break;
		}
	}

	function getOne() {
		$query = 'SELECT * FROM `genre` WHERE `name`=' . Database::escape($this->genre_name);
		$data = Database::sql2row($query);
		if (!isset($data['name']))
			return;
		$this->data['genres'][$data['id']] = array(
		    'name' => $data['name'],
		    'id' => $data['id'],
		    'id_parent' => $data['id_parent'],
		    'title' => $data['title'],
		    'books_count' => $data['books_count']
		);

		if (!$data['id_parent']) {
			$this->data['genres'][$data['id']]['subgenres'] = $this->getAll($data['id']);
			return;
		}

		$query = 'SELECT `id_book` FROM `book_genre` BG JOIN `book` B ON B.id = BG.id_book WHERE BG.id_genre = ' . $data['id'] . ' ORDER BY B.mark DESC LIMIT 20';
		$bids = Database::sql2array($query, 'id_book');
		$books = Books::getByIdsLoaded(array_keys($bids));
		Books::LoadBookPersons(array_keys($bids));

		foreach ($books as $book) {
			$book = Books::getById($book->id);
			list($aid, $aname) = $book->getAuthor(1, 1, 1); // именно наш автор, если их там много
			$this->data['genres'][$data['id']]['books'][] = array('id' => $book->id,
			    'cover' => $book->getCover(),
			    'title' => $book->getTitle(true),
			    'author' => $aname,
			    'author_id' => $aid,
			    'lastSave' => $book->data['modify_time']);
		}
	}

	function getAll($parent_id = 0) {
		if (!$parent_id)
			$query = 'SELECT id,id_parent,name,title,books_count FROM `genre` ORDER BY `id_parent`,`books_count` DESC';
		else
			$query = 'SELECT id,id_parent,name,title,books_count FROM `genre` WHERE id_parent=' . $parent_id . ' ORDER BY `id_parent`,`books_count` DESC';
		$genres = Database::sql2array($query);

		$parents = array();
		foreach ($genres as &$g) {
			$parents[$g['id_parent']][] = $g;
		}
		if (isset($parents[$parent_id]))
			foreach ($parents[$parent_id] as $item) {
				$genres_prepared[$item['id']] = $item;
				if (isset($parents[$item['id']])) {
					foreach ($parents[$item['id']] as $item_2) {
						$genres_prepared[$item['id']]['subgenres'][$item_2['id']] = $item_2;
					}
				}
			}

		return $genres_prepared;
	}

}