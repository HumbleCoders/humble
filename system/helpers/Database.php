<?php

class Database extends PDO {

	public function __construct() {

		try {
			parent::__construct(DATABASE_TYPE . ':host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME, DATABASE_USER, DATABASE_PASS);

			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
		} catch (PDOException $e) {
			die('Connection error: ' . $e->getMessage());
		}
	}

	public function insert($table, $params) {
		ksort($params);

		$fields_keys 	= implode('` ,`', array_keys($params));
		$fields_values 	= ':' . implode(' , :', array_keys($params));

		$pdo = $this->prepare("INSERT INTO `{$table}` (`{$fields_keys}`) VALUES ({$fields_values})");

		foreach ($params as $key => $value) {
			$pdo->bindValue(":$key", $value);
		}

		$pdo->execute();
	}

	public function read($sql, array $params, $fetchMode = PDO::FETCH_ASSOC) {
		$pdo = $this->prepare($sql);

		foreach ($params as $key => $value) {
			$pdo->bindValue("{$key}", $value);
		}

		$pdo->execute();

		return $pdo->fetchAll($fetchMode);
	}

	public function update($table, $params, $where) {
		ksort($params);

		$fields_details = null;

		foreach ($params as $key => $value) {
			$fields_details .= "`$key`=:$key,";
		}

		$fields_details = rtrim($fields_details, ',');

		$pdo = $this->prepare("UPDATE `{$table}` SET {$fields_details} WHERE {$where}");

		foreach ($params as $key => $value) {
			$pdo->bindValue(":{$key}, $value");
		}

		$pdo->execute();
	}

	public function delete($table, $where, $limit = 1) {
		return $this->exec("DELETE FROM `{$table}` WHERE {$where} LIMIT {$limit}");
	}
}