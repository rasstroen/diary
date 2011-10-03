<?php

// модуль отвечает за отображение баннеров
class reviews_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;
		$this->target_id = isset($params['target_id']) ? $params['target_id'] : 0;
		$this->target_type = isset($params['target_type']) ? $params['target_type'] : 0;
		$this->target_user = isset($params['target_user']) ? $params['target_user'] : 0;



		switch ($this->action) {
			case 'list':
				switch ($this->mode) {
					default:
						$this->getReviews();
						break;
				}
				break;
			case 'new':
				switch ($this->mode) {

					default:
						$this->getUserReview();
						break;
				}
				break;
			default:
				throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
				break;
		}
	}

	function getUserReview() {
		global $current_user;
		if (!$current_user->authorized)
			return;
		$query = 'SELECT * FROM `reviews` WHERE `id_target`=' . $this->target_id . ' AND `target_type`=' . $this->target_type . ' AND `id_user`=' . $current_user->id;
		$res = Database::sql2array($query);
		$this->data = $this->_item($res);
		$this->data['review']['target_id'] = $this->target_id;
		$this->data['review']['target_type'] = $this->target_type;
		$this->data['review']['rate'] = isset($this->data['review']['rate']) ?
			$this->data['review']['rate'] :
			Database::sql2single('SELECT `rate` FROM `book_rate` WHERE `id_book` =' . $this->target_id . ' AND `id_user`=' . $current_user->id);
	}

	function _item($data) {
		$out = array();
		$usrs = array();
		if (is_array($data)) {
			foreach ($data as $row) {
				$out['review'] = array(
				    'id_user' => $row['id_user'],
				    'time' => date('Y-m-d H:i', $row['time']),
				    'rate' => $row['rate'],
				    'html' => $row['comment'],
				);
				$usrs[$row['id_user']] = $row['id_user'];
			}
		}
		if (count($usrs)) {
			$users = Users::getByIdsLoaded($usrs);
			foreach ($users as $user) {
				$out['users'][] = array(
				    'id' => $user->id,
				    'picture' => $user->getAvatar(),
				    'nickname' => $user->getNickName(),
				);
			}
		}
		return $out;
	}

	function _list($data) {
		$out = array();
		$usrs = array();
		if (is_array($data)) {
			foreach ($data as $row) {
				$out['reviews'][] = array(
				    'id_user' => $row['id_user'],
				    'time' => date('Y-m-d H:i', $row['time']),
				    'rate' => $row['rate'],
				    'html' => $row['comment'],
				    'book_id' => $row['id_target'],
				);
				$usrs[$row['id_user']] = $row['id_user'];
			}
		}
		if (count($usrs)) {
			$users = Users::getByIdsLoaded($usrs);
			foreach ($users as $user) {
				$out['users'][$user->id] = array(
				    'id' => $user->id,
				    'picture' => $user->getAvatar(),
				    'nickname' => $user->getNickName(),
				);
			}
		}
		foreach ($usrs as $id => $idd) {
			if (!isset($out['users'][$id])) {
				$out['users'][$user->id] = array(
				    'id' => $id,
				);
			}
		}
		return $out;
	}

	function getReviews() {
		if ($this->target_user) {
			$query = 'SELECT * FROM `reviews` WHERE `id_user`=' . $this->target_user . ' ORDER BY `time` DESC';
			$res = Database::sql2array($query);
			$this->data = $this->_list($res);
			$bids = array();
			foreach ($this->data['reviews'] as $row) {
				$bids[$row['book_id']] = $row['book_id'];
			}
			$books = Books::getByIdsLoaded(array_keys($bids));
			Books::LoadBookPersons(array_keys($bids));

			foreach ($books as $book) {
				$book = Books::getById($book->id);
				list($aid, $aname) = $book->getAuthor(1, 1, 1); // именно наш автор, если их там много
				$this->data['books'][] = array('id' => $book->id,
				    'cover' => $book->getCover(),
				    'title' => $book->getTitle(true),
				    'author' => $aname,
				    'author_id' => $aid,
				    'lastSave' => $book->data['modify_time']);
			}
			$this->data['reviews']['target_id'] = $this->target_id;
			$this->data['reviews']['target_type'] = $this->target_type;
		} else {
			$query = 'SELECT * FROM `reviews` WHERE `id_target`=' . $this->target_id . ' AND `target_type`=' . $this->target_type;
			$res = Database::sql2array($query);
			$this->data = $this->_list($res);
			$this->data['reviews']['target_id'] = $this->target_id;
			$this->data['reviews']['target_type'] = $this->target_type;
		}
	}

}
