<?php

class App {

	private $_url;

	private $_controller;

	private $_setController;

	public function __construct() {
		Session::initialize();
		
		$this->url();
	}

	public function init() {
		if (empty($this->_url[0])) {
			$this->load_default();

			return false;
		}

		$this->load_existing();
		$this->controller_method();
	}

	public function set($controller_name) {
		$this->_setController = $controller_name;
	}

	private function url() {
		$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
		$url = filter_var($url, FILTER_SANITIZE_URL);

		$this->_url = explode('/', $url);
	}

	private function load_default() {
		require_once './app/controllers/' . $this->_setController . '.php';

		$this->_controller = new $this->_setController;
		$this->_controller->loadModel($this->_setController);
		$this->_controller->index();
	}

	private function load_existing() {
		$path = './app/controllers/' . $this->_url[0] . '.php';

		if (file_exists($path)) {
			require_once $path;

			$this->_controller = new $this->_url[0];
			$this->_controller->loadModel($this->_url[0]);
		} else {
			$this->error_404();

			return false;
		}
	}

	private function controller_method() {
		$length = count($this->_url);

		if ($length > 1) {
			if (!method_exists($this->_controller, $this->_url[1])) {
				$this->error_404();

				return false;
			}
		}

		switch ($length) {
			case 5:
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
				break;

			case 4:
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
				break;

			case 3:
				$this->_controller->{$this->_url[1]}($this->_url[2]);
				break;

			case 2:
				$this->_controller->{$this->_url[1]}();
				break;
			
			default:
				$this->_controller->index();
				break;
		}
	}

	private function error_404() {
		require_once './system/core/error/Error.php';

		$this->_controller = new Error;
		$this->_controller->index();
		die;
	}
}