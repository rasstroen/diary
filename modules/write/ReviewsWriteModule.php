<?php

class ReviewsWriteModule extends BaseWriteModule {

	function write() {
		global $current_user;
		/* @var $current_user CurrentUser */
		if (!$current_user->authorized)
			throw new Exception('Access denied');

		$data = array(
		    'target_id' => max(0, (int) Request::$post['target_id']),
		    'target_type' => max(0, (int) Request::$post['target_type']),
		    'comment' => prepare_review(Request::$post['annotation']),
		    'rate' => min(6, max(0, (int) Request::$post['rate'])) + 1,
		);


		$event = new Event();


		if (!$data['comment']) {
			// inserting rate
			if ($data['rate'] && ($data['target_type'] == 0)) {
				$time = time();
				if ($data['rate'] > 1) {
					$query = 'INSERT INTO `book_rate` SET `id_book`=' . $data['target_id'] . ',`id_user`=' . $current_user->id . ',`rate`=' . ($data['rate'] - 1) . ',`time`=' . $time . ' ON DUPLICATE KEY UPDATE
				`rate`=' . ($data['rate'] - 1) . ',`time`=' . $time . '';
					Database::query($query);
				}
				//recalculating rate
				$query = 'SELECT COUNT(1) as cnt, SUM(`rate`) as rate FROM `book_rate` WHERE `id_book`=' . $data['target_id'];
				$res = Database::sql2row($query);
				$book_mark = round($res['rate'] / $res['cnt'] * 10);
				$query = 'UPDATE `book` SET `mark`=' . $book_mark . ' WHERE `id`=' . $data['target_id'];
				Database::query($query);
				$event->event_BookRateAdd($current_user->id, $data['target_id'], $data['rate'] - 1);
			}
		} else {
			if (!$data['target_id'])
				return;
			$query = 'INSERT INTO `reviews` SET
				`id_target`=' . $data['target_id'] . ',
				`target_type`=' . $data['target_type'] . ',
				`id_user`=' . $current_user->id . ',
				`time`=' . time() . ',
				`comment`=' . Database::escape($data['comment']) . ',
				`rate`=' . ($data['rate'] - 1) . '
					ON DUPLICATE KEY UPDATE
				`time`=' . time() . ',
				`comment`=' . Database::escape($data['comment']) . ',
				`rate`=' . ($data['rate'] - 1) . '';
			Database::query($query);
			//event
			$event->event_BookReviewAdd($current_user->id, $data['target_id'],$data['target_type'], $data['rate'] - 1 , $data['comment']);
		}


		$event->push();
	}

}