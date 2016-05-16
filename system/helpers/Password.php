<?php

class Password {

	public static function Make($algo, $data, $salt) {
		$context = hash_init($algo, HASH_HMAC, $salt);

		hash_update($context, $data);

		return hash_final($context);
	}
}