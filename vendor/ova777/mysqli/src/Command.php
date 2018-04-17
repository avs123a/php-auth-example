<?php

namespace ova777\MYSQLi;

class Command {
	/**
	 * Хранит подготовленныйй mysqli запрос
	 * @var \mysqli_stmt
	 */
	private $prepare;

	/**
	 * Хранит привязанные к запросу параметры
	 * @var array
	 */
	private $vars;

	/**
	 * @var Connection
	 */
	private $connection;

	/**
	 * Command constructor.
	 * @param Connection $connection
	 * @param string $sql
	 */
	public function __construct($connection, $sql) {
		$this->connection = $connection;
		$this->prepare = $this->connection->dbh->prepare($sql);
	}

	/**
	 * Привязывает значения к запросу
	 * @param mixed $types типы данных (или $vars)
	 * @param mixed $vars значение или массив значений
	 * @return $this
	 */
	public function bind($types, $vars = null) {
		if($vars === null) $vars = $types;
		if(!is_array($vars)) $vars = array($vars);
		if(null === $this->vars) {
			$this->vars = $vars;
			$pointers = array();
			foreach($vars as $k=>$var) $pointers[] = &$this->vars[$k];
			call_user_func_array(array($this->prepare, 'bind_param'), array_merge(array($types), $pointers));
		} else {
			foreach($this->vars as $k=>$v) $this->vars[$k] = $vars[$k];
		}
		return $this;
	}

	/**
	 * Выполняет запрос
	 * @return bool
	 */
	public function execute() {
		return $this->prepare->execute();
	}


	/**
	 * Закрывает подготовленный запрос
	 * @return bool
	 */
	public function close() {
		return $this->prepare->close();
	}

	/**
	 * Выполняет запрос и возвращает все строки результата в виде массива ассоциативных массивов
	 * @return array
	 */
	public function queryAll() {
		$this->execute();
		$rows = $this->prepare->get_result()->fetch_all(MYSQLI_ASSOC);
		$this->close();
		return $rows;
	}

	/**
	 * Выполняет запрос и возвращает первую строку результата в виде ассоциативного массива
	 * @return array|null
	 */
	public function queryRow() {
		$this->execute();
		$row = $this->prepare->get_result()->fetch_assoc();
		$this->close();
		return $row;
	}

	/**
	 * Выполняет запрос и возвращает данные первой колонки результата
	 * @return array
	 */
	public function queryColumn() {
		$this->execute();
		$rows = $this->prepare->get_result()->fetch_all(MYSQLI_NUM);
		$this->close();
		return array_map(function($item){
			return array_shift($item);
		}, $rows);
	}

	/**
	 * Выполняет запрос и возвращает результат в первом столбце первой колонки
	 * @return mixed|null
	 */
	public function queryScalar() {
		$this->execute();
		$row = $this->prepare->get_result()->fetch_array(MYSQLI_NUM);
		$this->close();
		if(!$row) return NULL;
		return array_shift($row);
	}
}