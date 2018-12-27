<?php

class Service {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public $id;
  private $name;
  //private $longitude;
  //private $latitude;

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

  public function getLongitude(){
		return $this->longitude;
	}

	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}

	public function getLatitude(){
		return $this->latitude;
	}

	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}


}


 ?>
