<?php

class Welcome extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
		$data = [
            'title' => WEBISTE_NAME . ' - Welcome'
        ];

        $this->_view->display('welcome/welcome', $data);
	}
}