<?php

namespace ova777\MYSQLi;

class Connection {
	/**
	 * @var \mysqli
	 */
	public $dbh;

	/**
	 * Connection constructor.
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $db
	 */
	public function __construct($host, $user, $pass, $db) {
		$this->dbh = mysqli_connect($host, $user, $pass, $db);
	}

	/**
	 * Создать новую команду на основе SQL
	 * @param string $sql
	 * @return Command
	 */
	public function command($sql) {
		return new Command($this, $sql);
	}
}