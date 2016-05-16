<?php

class Model {

	public $_db;

	public function __construct() {
		$this->_db = new Database;
	}
}