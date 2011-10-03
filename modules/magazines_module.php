<?php

// модуль отвечает за отображение баннеров
class magazines_module extends BaseModule {

	function generateData() {
		global $current_user;
		$params = $this->params;
		$this->magazine_id = isset($params['magazine_id']) ? $params['magazine_id'] : 0;

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
		// вся периодика
		$query = 'SELECT `id`,`title`,`first_year`,`last_year` FROM `magazines` ORDER BY `last_year` DESC';
		$magazines = Database::sql2array($query);
		$this->data['magazines'] = $magazines;
	}

	function getOne() {
		$m = new Magazine($this->magazine_id);
		$this->data['magazine']['id'] = $m->id;
		$this->data['magazine']['years'] = $m->getPeriodMap();
		$this->data['magazine']['title'] = $m->data['title'];
		$this->data['magazine']['rightholder'] = $m->data['rightsholder'] ? $m->data['rightsholder'] : '';
		$this->data['magazine']['annotation'] = $m->data['annotation'];
	}

}
