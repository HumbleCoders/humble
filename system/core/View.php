<?php

class View {

	public function display($file, $data = false) {
		require_once './app/views/' . $file . '.php';
	} 
}