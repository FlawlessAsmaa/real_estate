<?php

class Address {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public $id;
  private $address;

  public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

  public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}
}

?>
