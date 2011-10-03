<?php

class MagazineWriteModule extends BaseWriteModule {

	function write() {
		global $current_user;

		$id = isset(Request::$post['id']) ? (int) Request::$post['id'] : false;


		if (!$id) {
			return;
		}
	}

}