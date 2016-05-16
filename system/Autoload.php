<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__) . DS);

function classAutoloader($class) {
	$folders = array('core', 'helpers');

	foreach ($folders as $search_folders) {
		$path = ROOT . 'system' . DS . $search_folders . DS . $class . '.php';

		if (file_exists($path)) {
			require_once $path;
		}
	}
}

spl_autoload_register('classAutoloader');