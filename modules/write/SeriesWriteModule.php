<?php

class SeriesWriteModule extends BaseWriteModule {

	function write() {
		global $current_user;
		/* @var $current_user CurrentUser */
		if (!$current_user->authorized)
			throw new Exception('Access denied');

		$id = isset(Request::$post['id']) ? Request::$post['id'] : 0;
		$id = max(0, (int) $id);
		$parent_id = isset(Request::$post['parent_id']) ? Request::$post['parent_id'] : false;
		$parent_id = max(0, (int) $parent_id);
		if (!$id)
			throw new Exception('Illegal id');

		$title = isset(Request::$post['title']) ? Request::$post['title'] : false;
		$description = isset(Request::$post['description']) ? Request::$post['description'] : false;


		if ($parent_id == $id)
			throw new Exception('Illegal parent');

		if ($parent_id) {
			$query = 'SELECT `id` FROM `series` WHERE `id`=' . $parent_id;
			if (!Database::sql2single($query))
				throw new Exception('No such parent');
		}

		if (!$title)
			throw new Exception('Empty title');

		$description = prepare_review($description);
		$title = prepare_review($title, '');

		$query = 'UPDATE `series` SET `id_parent`=' . $parent_id . ',`title`=' . Database::escape($title) . ', `description`=' . Database::escape($description) . ' WHERE `id`=' . $id;
		Database::query($query);
	}

}