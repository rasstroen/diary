<?php

// модуль отвечает за отображение баннеров
class books_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;
		$this->id = isset($params['user_id']) ? $params['user_id'] : $current_user->id;
		$this->book_id = isset($params['book_id']) ? $params['book_id'] : 0;
		$this->author_id = isset($params['author_id']) ? $params['author_id'] : 0;
		$this->shelf_type = isset($params['shelf_type']) ? $params['shelf_type'] : 0;

		if (isset(Request::$get['title']))
			$this->data['write']['title'] = Request::$get['title'];
		if (isset(Request::$get['subtitle']))
			$this->data['write']['subtitle'] = Request::$get['subtitle'];
		if (isset(Request::$get['year']))
			$this->data['write']['year'] = Request::$get['year'];
		
		if (isset(Request::$get['n']))
			$this->data['write']['n'] = Request::$get['n'];
		
		if (isset(Request::$get['m']))
			$this->data['write']['m'] = Request::$get['m'];


		switch ($this->action) {
			case 'show':
				switch ($this->mode) {

					default:
						$this->getBookInfo($this->book_id);
						break;
				}
				break;
			case 'edit':
				switch ($this->mode) {

					default:
						$this->getBookInfo($this->book_id);
						$this->getEditingInfo();
						break;
				}
				break;
			case 'new':
				switch ($this->mode) {
					default:
						$this->getEditingInfo();
						break;
				}
				break;
			case 'list':
				switch ($this->mode) {
					case 'author_books':
						$this->getAuthorBooks();
						break;
					case 'popular':
						$this->getPopular();
						break;
					case 'new':
						$this->getNew();
						break;
					case 'loved':
						$this->getLoved();
						break;
					case 'shelves':
						$this->getShelves();
						break;
					case 'shelf':
						$this->getShelf();
						break;
					default:
						throw new Exception('no mode #' . $this->mode . ' for ' . $this->moduleName);
						break;
				}
				break;
			default:
				throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
				break;
		}
	}

	function _list($ids, $opts = array(), $limit = false) {
		$person_id = isset($opts['person_id']) ? $opts['person_id'] : false;
		$books = Books::getByIdsLoaded($ids);
		Books::LoadBookPersons($ids);
		$out = array();
		/* @var $book Book */
		$i = 0;
		if (is_array($books))
			foreach ($books as $book) {
				if ($limit && ++$i > $limit)
					return $out;
				list($aid, $aname) = $book->getAuthor(1, 1, 1, $person_id); // именно наш автор, если их там много
				$out[] = array(
				    'id' => $book->id,
				    'cover' => $book->getCover(),
				    'title' => $book->getTitle(true),
				    'author' => $aname,
				    'author_id' => $aid,
				    'lastSave' => $book->data['modify_time'],
				);
			}
		return $out;
	}

	function getEditingInfo() {
		foreach (Config::$person_roles as $id => $title) {
			$this->data['book']['roles'][] = array(
			    'id' => $id,
			    'title' => $title,
			);
		}
		foreach (Config::$langRus as $code => $title) {
			$this->data['book']['lang_codes'][] = array(
			    'id' => Config::$langs[$code],
			    'code' => $code,
			    'title' => $title,
			);
		}
	}

	function getAuthorBooks() {
		$author_id = (int) $this->author_id;
		$ids = Database::sql2array('SELECT `id` FROM `book` B LEFT JOIN `book_persons` BP ON BP.id_book = B.id WHERE 
			BP.`id_person`=' . $author_id . '
			AND BP.`person_role`=' . Book::ROLE_AUTHOR, 'id');
		$this->data['books'] = $this->_list(array_keys($ids), array('person_id' => $author_id), 10);
		$this->data['books']['title'] = 'Книги автора';
		$this->data['books']['count'] = count($ids);
		$this->data['books']['link_url'] = 'a/' . $author_id . '/bibliography';
		$this->data['books']['link_title'] = 'Вся библиография';
	}

	function getNew() {
		$ids = Database::sql2array('SELECT `id` FROM `book` ORDER BY `add_time` DESC LIMIT 100', 'id');
		$this->data['books'] = $this->_list(array_keys($ids));
		$this->data['books']['title'] = 'Новые книги';
		$this->data['books']['count'] = count($ids);
	}

	function getPopular() {
		$ids = Database::sql2array('SELECT `id` FROM `book` ORDER BY `mark` DESC LIMIT 100', 'id');
		$this->data['books'] = $this->_list(array_keys($ids));
		$this->data['books']['title'] = 'Популярные книги';
		$this->data['books']['count'] = count($ids);
	}

	function getLoved() {
		$ids = Database::sql2array('SELECT `id` FROM book  ORDER BY `mark` DESC LIMIT 10', 'id');
		$this->data['books'] = $this->_list(array_keys($ids));
		$this->data['books']['title'] = 'Любимые книги';
		$this->data['books']['count'] = count($ids);
		$this->data['books']['link_title'] = 'Все любимые книги';
		$this->data['books']['link_url'] = 'user/' . $this->id . '/books/loved';
	}

	function getShelf() {
		$shelfCurrent = isset(Config::$shelfIdByNames[$this->params['shelf_type']]) ? Config::$shelfIdByNames[$this->params['shelf_type']] : false;
		if ($shelfCurrent === false)
			return;
		global $current_user;
		/* @var $current_user CurrentUser */
		/* @var $user User */

		$user = ($current_user->id === $this->id) ? $current_user : Users::getById($this->id);
		$bookShelf = $user->getBookShelf();

		$sort_type = Request::get(3, 'time');
		$sort_function = 'sort_by_add_time';
		switch ($sort_type) {
			case 'genre':
				$sort_function = 'sort_by_genre';
				break;
			case 'mark':
				$sort_function = 'sort_by_mark';
				break;
			default:
				$sort_function = 'sort_by_add_time';
				break;
		}

		foreach ($bookShelf as $shelf => &$books)
			if ($shelf == $shelfCurrent)
				uasort($books, $sort_function);

		$bookIds = array();
		foreach ($bookShelf as $shelf => $ids) {
			if ($shelf == $shelfCurrent)
				foreach ($ids as $bookId => $data)
					$bookIds[$bookId] = $bookId;
		}
		// все эти книжки нужно подгрузить
		Books::getByIdsLoaded($bookIds);
		Books::LoadBookPersons($bookIds);
		$shelfcounter = array($shelfCurrent => 0);
		foreach ($bookShelf as $shelf => $ids) {
			if ($shelf == $shelfCurrent)
				foreach ($ids as $bookId => $data) {
					$book = Books::getById($bookId);
					if (isset($shelfcounter[$shelf]))
						$shelfcounter[$shelf]++;
					else
						$shelfcounter[$shelf] = 1;
					if ($shelfcounter[$shelf] > 10)
						continue;
					/* @var $book Book */
					list($author_id, $author_name) = $book->getAuthor();
					$this->data['books'][$bookId] = array(
					    'id' => $book->id,
					    'title' => $book->getTitle(true),
					    'cover' => $book->getCover(),
					    'author' => $author_name,
					    'author_id' => $author_id,
					    'add_time' => $data['add_time']
					);
				}
		}
		$this->data['books']['count'] = (int) $shelfcounter[$shelfCurrent];
		$this->data['books']['title'] = Config::$shelves[$shelfCurrent];
	}

	function getShelves() {
		global $current_user;
		/* @var $current_user CurrentUser */
		/* @var $user User */
		$user = ($current_user->id === $this->id) ? $current_user : Users::getById($this->id);
		$bookShelf = $user->getBookShelf();
		foreach ($bookShelf as $shelf => &$books)
			uasort($books, 'sort_by_add_time');
		$bookIds = array();
		foreach ($bookShelf as $shelf => $ids) {
			foreach ($ids as $bookId => $data)
				$bookIds[$bookId] = $bookId;
		}
		// все эти книжки нужно подгрузить
		Books::getByIdsLoaded($bookIds);
		Books::LoadBookPersons($bookIds);
		$shelfcounter = array(1 => 0, 2 => 0, 3 => 0);
		foreach ($bookShelf as $shelf => $ids) {
			foreach ($ids as $bookId => $data) {
				$book = Books::getById($bookId);
				if (isset($shelfcounter[$shelf]))
					$shelfcounter[$shelf]++;
				else
					$shelfcounter[$shelf] = 1;
				if ($shelfcounter[$shelf] > 10)
					continue;
				/* @var $book Book */

				list($author_id, $author_name) = $book->getAuthor();
				$this->data['shelves'][$shelf]['books'][$bookId] = array(
				    'id' => $book->id,
				    'title' => $book->getTitle(true),
				    'cover' => $book->getCover(),
				    'author' => $author_name,
				    'author_id' => $author_id,
				    'add_time' => $data['add_time']
				);
			}
		}
		foreach (Config::$shelves as $id => $title) {
			$this->data['shelves'][$id]['books']['count'] = (int) $shelfcounter[$id];
			$this->data['shelves'][$id]['books']['title'] = $title;
			$this->data['shelves'][$id]['books']['link_title'] = 'Перейти на полку «' . $title . '»';
			$this->data['shelves'][$id]['books']['link_url'] = 'user/' . $this->id . '/books/' . Config::$shelfNameById[$id];
		}
	}

	function getBookInfo($id) {
		$book = new Book($id);
		if ($book->loadForFullView()) {
			$this->data['book'] = array();
			$this->data['book']['id'] = $book->id;
			$langId = $book->data['id_lang'];
			foreach (Config::$langs as $code => $id_lang) {
				if ($id_lang == $langId) {
					$langCode = $code;
				}
			}
			$this->data['book']['lang_code'] = $langCode;
			$this->data['book']['lang_title'] = Config::$langRus[$langCode];
			$this->data['book']['lang_id'] = $langId;
			$title = $book->getTitle();

			$this->data['book']['title'] = $title['title'];
			$this->data['book']['subtitle'] = $title['subtitle'];
			$this->setPageTitle($title['title'] . ($title['subtitle'] ? '. ' . $title['subtitle'] : ''));
			$this->data['book']['public'] = $book->isPublic();
			$persons = $book->getPersons();
			uasort($persons, 'sort_by_role');
			$this->data['book']['authors'] = $persons;
			$this->data['book']['genres'] = $book->getGenres();
			$this->data['book']['isbn'] = $book->getISBN();
			$this->data['book']['rightsholder'] = $book->getRightsholder();
			$this->data['book']['annotation'] = $book->getAnnotation();
			$this->data['book']['cover'] = $book->getCover();
			$this->data['book']['files'] = $book->getFiles();
			$this->data['book']['mark'] = $book->data['mark'] / 10;
			$this->data['book']['lastSave'] = $book->data['modify_time'];

			$this->data['book']['year'] = (int) $book->data['year'] ? (int) $book->data['year'] : '';
			$this->data['book']['book_type'] = Book::$book_types[$book->data['book_type']];
		}
		else
			throw new Exception('no book #' . $id . ' in database');
	}

}