<?php

class Type {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public $id;
  private $name;


  public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}
public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}
  
}
