<?php

class Session {

	private static $_starded = false;

	public static function initialize() {
		if (self::$_starded == false) {
			session_start();

			self::$_starded = true;
		}
	}

	public static function set($key, $value) {
		$_SESSION[SESSION_PREFIX . $key] = $value;
	}

	public static function get($key, $key_two = false) {
		if ($key_two == true) {
			if (isset($_SESSION[SESSION_PREFIX . $key][$key_two])) {
				return $_SESSION[SESSION_PREFIX . $key][$key_two];
			}
		} else {
			if (isset($_SESSION[SESSION_PREFIX . $key])) {
				return $_SESSION[SESSION_PREFIX . $key];
			}
		}

		return false;
	}

	public static function display() {
		return $_SESSION;
	}

	public static function destroy() {
		if (self::$_starded == true) {
			session_unset();
			session_destroy();
		}
	}
}