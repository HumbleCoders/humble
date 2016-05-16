<?php

class Url {

	public static function redirect($url = null) {
		header('Location: ' . URL_BASE . $url);
	}

	public static function refresh($time, $url = null) {
		header('Refresh: ' . $time . ';url=' . URL_BASE . $url);
	}

	public static function url_base() {
		return URL_BASE;
	}
}