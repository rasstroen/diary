<?php

// модуль отвечает за отображение баннеров
class events_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;

		$this->user_id = isset($params['user_id']) ? $params['user_id'] : $current_user->id;
		$this->post_id = isset($params['post_id']) ? $params['post_id'] : false;
		$this->type = isset($params['type']) ? $params['type'] : 'self';

		switch ($this->action) {
			case 'list':
				switch ($this->mode) {
					case 'item':
						$this->getEvent();
						break;
					case 'last':
						$this->getEvents($all = true);
						break;
					default:
						$this->getEvents($all = false);
						break;
				}

				break;

			default:
				throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
				break;
		}
	}

	function getEvent() {
		if (!$this->post_id || !$this->user_id)
			return;
		$wall = MongoDatabase::getUserWallItem($this->post_id, $this->user_id);
		$events = MongoDatabase::getWallEvents($wall);
		$this->data = $this->_list($events);
	}

	function _list($events) {
		$data = array();
		$book_ids = array();
		$user_ids = array();
		foreach ($events as &$event) {
			unset($event['likes']);
			$event['time'] = date('Y/m/d H:i', $event['wall_time']);
			if (isset($event['book_id'])) {
				$book_ids[$event['book_id']] = $event['book_id'];
			}

			if (isset($event['owner_id'])) {
				$user_ids[$event['owner_id']] = $event['owner_id'];
			}
			if ($event['user_id'])
				$user_ids[$event['user_id']] = $event['user_id'];
			if ($event['retweet_from']) {
				$user_ids[$event['retweet_from']] = $event['retweet_from'];
			}
			$comments = array();
			if (isset($event['comments'])) {
				$event['comments'] = array_slice($event['comments'], -15, 15, true);
				foreach ($event['comments'] as $id => $comment) {
					$user_ids[$comment['commenter_id']] = $comment['commenter_id'];
					$comments[] = array('commenter_id' => $comment['commenter_id'], 'comment' => $comment['comment'], 'time' => date('Y/m/d H:i', $comment['time']));
				}
			}
			$event['comments'] = $comments;
		}

		$data['events'] = $events;

		$data['users'] = $this->getEventsUsers($user_ids);
		$data['books'] = $this->getEventsBooks($book_ids);

		$data['events']['title'] = 'События';
		$data['events']['count'] = count($events);
		if ($this->type == 'not_self')
			$data['events']['self'] = $this->user_id;
		return $data;
	}

	function getEvents($all = false) {
		if (!$all) {
			if (isset($this->params['select']) && $this->params['select'] == 'self') { // выбрали "только свои записи" на "моей стене"
				$wall = MongoDatabase::getUserWall((int) $this->user_id, 0, 10, 'self');
			}else
				$wall = MongoDatabase::getUserWall((int) $this->user_id, 0, 10, $this->type);
		}else {
			// показываем просто последнюю активность
			$wall = MongoDatabase::getLastWall();
		}

		$events = MongoDatabase::getWallEvents($wall);
		$this->data = $this->_list($events);
	}

	function getEventsUsers($ids) {
		$users = Users::getByIdsLoaded($ids);
		$out = array();
		/* @var $user User */
		$i = 0;
		if (is_array($users))
			foreach ($users as $user) {
				$out[] = array(
				    'id' => $user->id,
				    'picture' => $user->getAvatar(),
				    'nickname' => $user->getNickName(),
				);
			}
		return $out;
	}

	function getEventsBooks($ids, $opts = array(), $limit = false) {
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
				$out[] = $book->getListData();
			}
		return $out;
	}

}