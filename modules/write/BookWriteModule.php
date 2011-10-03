<?php

class BookWriteModule extends BaseWriteModule {

	function newBook() {
		// добавляем книгу
		global $current_user;

		$fields = array(
		    'title' => 'title',
		    'subtitle' => 'subtitle',
		    'isbn' => 'ISBN',
		    'year' => 'year',
		    'lang_code' => 'id_lang', //lang_code
		    'annotation' => 'description'
		);
		Request::$post['lang_code'] = Config::$langs[Request::$post['lang_code']];


		foreach ($fields as $field => $bookfield) {
			if (!isset(Request::$post[$field])) {
				throw new Exception('field missed #' . $field);
			}

			$to_update[$bookfield] = Request::$post[$field];
		}

		$q = array();
		foreach ($to_update as $field => $value) {
			if (in_array($field, array('ISBN', 'year'))) {
				$value = (int) $value;
			}
			$q[] = '`' . $field . '`=' . Database::escape($value) . '';
		}
		$q[] = '`add_time`=' . time();

		if (count($q)) {
			$query = 'INSERT INTO `book` SET ' . implode(',', $q);
			Database::query($query);
			if ($lid = Database::lastInsertId()) {
				if (Request::$post['n'] && Request::$post['m']) {
					// журнал - вставляем
					$query = 'INSERT INTO `book_magazines` SET `id_book`=' . $lid . ',id_magazine=' . (int) Request::$post['m'] . ',`year`=' . $to_update['year'] . ',`n`=' . (int) Request::$post['n'];
					Database::query($query, false);
				}

				if (isset($_FILES['cover']) && $_FILES['cover']['tmp_name']) {
					$folder = Config::need('static_path') . '/upload/covers/' . (ceil($lid / 5000));
					@mkdir($folder);
					chmod($folder, 755);
					$filename = $folder . '/' . $lid . '.jpg';
					$upload = new UploadAvatar($_FILES['cover']['tmp_name'], 100, 100, "simple", $filename);
					if ($upload->out) {
						$query = 'UPDATE `book` SET `is_cover`=1 WHERE `id`=' . $lid;
						Database::query($query);
					} else {
						throw new Exception('cant copy file to ' . $filename, 100);
					}
				}
				BookLog::addLog($to_update, array());
				BookLog::saveLog($lid, BookLog::TargetType_book, $current_user->id, BiberLog::BiberLogType_bookNew);
				ob_end_clean();
				$event = new Event();
				$event->event_BooksAdd($current_user->id, $lid);
				$event->push();
				header('Location:' . Config::need('www_path') . '/b/' . $lid);
				exit();
			}
		}
	}

	function write() {
		global $current_user;
		//$this->setWriteParameter('register_module', 'result', false);

		$id = isset(Request::$post['id']) ? (int) Request::$post['id'] : false;


		if (!$id) {
			$this->newBook();
			return;
		}


		$books = Books::getByIdsLoaded(array($id));
		$book = is_array($books) ? $books[$id] : false;
		if (!$book)
			return;
		/* @var $book Book */

		$fields = array(
		    'title' => 'title',
		    'subtitle' => 'subtitle',
		    'isbn' => 'ISBN',
		    'year' => 'year',
		    'lang_code' => 'id_lang', //lang_code
		    'annotation' => 'description'
		);

		Request::$post['lang_code'] = Config::$langs[Request::$post['lang_code']];
		$to_update = array();
		if (isset($_FILES['cover']) && $_FILES['cover']['tmp_name']) {
			$folder = Config::need('static_path') . '/upload/covers/' . (ceil($book->id / 5000));
			@mkdir($folder);
			chmod($folder, 755);
			$filename = $folder . '/' . $book->id . '.jpg';
			$upload = new UploadAvatar($_FILES['cover']['tmp_name'], 100, 100, "simple", $filename);
			if ($upload->out)
				$to_update['is_cover'] = 1;
			else {
				throw new Exception('cant copy file to ' . $filename, 100);
			}
		}

		if (isset($_FILES['file']) && isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']) {
			$filetype = explode('.', $_FILES['file']['name']);
			$filetype = isset($filetype[count($filetype) - 1]) ? $filetype[count($filetype) - 1] : 'fb2';
			$filetype = $filetype == 'fb2' ? 1 : 0;
			if (!$filetype)
				throw new Exception('only fb2 allowed');
			$destinationDir = Config::need('files_path') . DIRECTORY_SEPARATOR . getBookFileDirectory($book->id, $filetype);
			@mkdir($destinationDir, 755);
			// добавляем запись в базу
			$filesize = $_FILES['file']['size'];
			$query = 'INSERT INTO `book_files` SET
				`id_book`=' . $book->id . ',
				`filetype`=' . $filetype . ',
				`id_file_author`=' . $current_user->id . ',
				`modify_time`=' . time() . ',
				`filesize`=' . $filesize;
			//Database::query($query);
			if ($id_file = 78037 || $id_file = Database::lastInsertId()) {
				$destinationFile = getBookFilePath($id_file, $book->id, $filetype, Config::need('files_path'));
				move_uploaded_file($_FILES['file']['tmp_name'], $destinationFile);
			}
			if ($filetype == 1) {
				$parser = new FB2Parser($destinationFile);
				$parser->parseDescription();
				$toc = $parser->getTOCHTML();
				Request::$post['annotation'] = $parser->getProperty('annotation');
				Request::$post['title'] = $parser->getProperty('book-title');
				$to_update['table_of_contents'] = $toc;
			}
		}


		foreach ($fields as $field => $bookfield) {
			if (!isset(Request::$post[$field])) {
				throw new Exception('field missed #' . $field);
			}
			if ($book->data[$bookfield] !== Request::$post[$field]) {
				$to_update[$bookfield] = Request::$post[$field];
			}
		}

		$q = array();
		foreach ($to_update as $field => &$value) {
			if (in_array($field, array('ISBN', 'year'))) {
				$value = is_numeric($value) ? $value : 0;
			}
			$q[] = '`' . $field . '`=' . Database::escape($value) . '';
		}

		if (count($q)) {
			$query = 'UPDATE `book` SET ' . implode(',', $q) . ' WHERE `id`=' . $book->id;
			Database::query($query);
			BookLog::addLog($to_update, $book->data);
			BookLog::saveLog($book->id, BookLog::TargetType_book, $current_user->id, BiberLog::BiberLogType_bookEdit);
		}
		ob_end_clean();
		header('Location:' . Config::need('www_path') . '/b/' . $book->id);
		exit();
	}

}