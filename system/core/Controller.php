<?php

class Controller {
	
	public $_model;

	public $_view;

	public function __construct() {
		$this->_view = new View;
	}

	public function loadModel($file_name) {
		$path = './app/models/' . $file_name . '_model.php';

		if (file_exists($path)) {
			require_once $path;

			$model_name = ucwords($file_name) . '_Model';

			$this->_model = new $model_name();
		}
	}
}