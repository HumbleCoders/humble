<?php

class Error extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {

		$data = [
            'title' => WEBISTE_NAME . ' - 404 page not found'
        ];

        $this->_view->display('error/error', $data);
	}
}