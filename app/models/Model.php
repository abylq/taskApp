<?php
namespace app\models;
use app\database\Database;

abstract class Model
{
	public $db;

	public function __construct() {
		
		$this->db = new Database;
	}

}