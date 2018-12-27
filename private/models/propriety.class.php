<?php

class Propriety {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public function create_pro() {
    $sql  ="INSERT INTO property(" ;
    $sql .=" name, photo, created_at, updated_at, price, longitude, latitude, num_of_view";
    $sql .=" ) VALUES ( ";
    $sql .="'" . self::$database->escape_string($this->name) ."',";
    $sql .="'" . $this->photo ."',";
    $sql .=" CURRENT_TIMESTAMP ,";
    $sql .=" CURRENT_TIMESTAMP ,";
    $sql .="'" . self::$database->escape_string($this->price) ."',";
    $sql .="'" . $this->longitude ."',";
    $sql .="'" . $this->latitude ."',";
    $sql .="'" . $this->num_of_view ."'";
    $sql .=");";
    $result = self::$database->query($sql);
    $this->id = self::$database->insert_id;
    if($result){
      //$this->id = self::$database->insert_id;
      $sql  ="INSERT INTO address(" ;
      $sql .="address, property_id";
      $sql .=" ) VALUES ( ";
      $sql .="'" . $this->address ."',";
      $sql .="'" . $this->id ."'";
      $sql .=");";
      $result2 = self::$database->query($sql);
      $sql1  ="INSERT INTO type(" ;
      $sql1 .=" name, property_id";
      $sql1 .=" ) VALUES ( ";
      $sql1 .="'" . self::$database->escape_string($this->type) ."',";
      $sql1 .="'" . $this->id ."'";
      $sql1 .=");";
      $result3 = self::$database->query($sql1);
      if($result3){
        $sql2  ="INSERT INTO service_around(" ;
        $sql2 .=" name";
        $sql2 .=" ) VALUES ( ";
        $sql2 .="'" . $this->service ."'";
        $sql2 .=");";
        $result4 = self::$database->query($sql2);

        if ($result4){
          $service_id = self::$database->insert_id;
          $sql3  ="INSERT INTO property_service(" ;
          $sql3 .=" propriety_id, service_id";
          $sql3 .=" ) VALUES ( ";
          $sql3 .="'" . $this->id ."',";
          $sql3 .="'" . $service_id ."'";
          $sql3 .=");";
          $result5 = self::$database->query($sql3);
          if($result5){
            echo "inserted successfully";
            //echo $sql2;
          }else {
            echo "error 1"  . self::$database->error ;
          }
        }else {
          echo "error 2" . self::$database->error ;
        }

      }else {
        echo "error 3" . self::$database->error ;
      }

    }else {
      echo "error 4" . self::$database->error ;
    }

  }

  public function create()
  {

    $sql  ="INSERT INTO property(" ;
    $sql .=" name, photo, created_at, updated_at, price, longitude, latitude, num_of_view";
    $sql .=" ) VALUES ( ";
    $sql .="'" . self::$database->escape_string($this->name) ."',";
    $sql .="'" . $this->photo ."',";
    $sql .=" CURRENT_TIMESTAMP ,";
    $sql .=" CURRENT_TIMESTAMP ,";
    $sql .="'" . self::$database->escape_string($this->price) ."',";
    $sql .="'" . $this->longitude ."',";
    $sql .="'" . $this->latitude ."',";
    $sql .="'" . $this->num_of_view ."'";
    $sql .=");";


    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
      $sql  ="INSERT INTO address(" ;
      $sql .="address, property_id";
      $sql .=" ) VALUES ( ";
      $sql .="'" . $this->address ."',";
      $sql .="'" . $this->id ."'";
      $sql .=");";
      $result2 = self::$database->query($sql);
      $sql1  ="INSERT INTO type(" ;
      $sql1 .=" name, property_id";
      $sql1 .=" ) VALUES ( ";
      $sql1 .="'" . self::$database->escape_string($this->type) ."',";
      $sql1 .="'" . $this->id ."'";
      $sql1 .=");";
      $result3 = self::$database->query($sql1);
        if($result3){
          //echo "Your record inserted Successfully";
          echo "";
        }else {
            echo "Can't insert record1 " . self::$database->error ;
        }
      }else {
        echo "Can't insert record 2 " . self::$database->error ;
      }
    return $result;
  }

  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->photo = $args['photo'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->longitude = $args['longitude'] ?? '';
    $this->latitude = $args['latitude'] ?? '';
    $this->num_of_view = $args['num_of_view'] ?? '';
    $this->type = $args['type'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->service = $args['service'] ?? '';
    //var_dump($this);
  }

  public function search_by_type ($type) {
    $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND t.name = '{$type}' ";
    $result = self::$database->query($sql);
    while ($record = $result->fetch_assoc()) {
      $property_array[] =  $record;
    }
    return $property_array;
  }


  public function search_by_money($min, $max) {
    $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price BETWEEN $min AND $max ";
    $result = self::$database->query($sql);
    while ($record = $result->fetch_assoc()) {
    $property_array[] =  $record;
  }
  return $property_array;
}

  public function search_by_specific_money($money) {
    if ($money === "below 1000") {
      $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price <1000";
    }else if ($money === "from 1000 to 10000") {
      $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price BETWEEN 1000 AND 10000";
    }else if ($money === "from 10000 to 100000") {
      $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price BETWEEN 10000 AND 100000";
    }else if ($money === "from 100000 to 1000000") {
      $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price BETWEEN 100000 AND 1000000";
    }else if ($money === "more than 1000000" ) {
      $sql = "SELECT p.id, p.name, p.price, p.photo, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id AND p.price > 1000000";
    }else {
      echo "No record are there";
    }
    $result = self::$database->query($sql);
    if ($result) {
      while ($record = $result->fetch_assoc()) {
        $property_array[] =  $record;
      }
      return $property_array;
    }
  }

  public function find_all()
  {
    $sql = "Select p.name, p.photo, p.price, t.name as type, d.address FROM property as p JOIN type as t ON p.id = t.property_id JOIN address as d ON p.id = d.property_id";
    $property_array = self::find_by_sql($sql);

    return $property_array;
  }

  public function find_by_sql($sql)
  {
    $property_array = array();
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    while ($record = $result->fetch_assoc()) {
      $admins_array[] = $record;
    }
    return $admins_array;
  }



  public function instantiate($value)
  {
    $obj = new self();
    $obj->id = $value ['id'];
    $obj->name = $value ['name'];
    $obj->photo = $value ['photo'];
    $obj->created_at = $value ['created_at'];
    $obj->updated_at = $value ['updated_at'];
    $obj->price = $value ['price'];
    $obj->longitude = $value ['longitude'];
    $obj->latitude = $value ['latitude'];
    $obj->type = $value ['type'];
    $obj->address = $value ['address'];
    return $obj;
  }


  /*  public function instantiate($value)
    {
      $obj = new self();
      $obj->id = $value ['id'];
      $obj->name = $value ['name'];
      $obj->photo = $value ['photo'];
      $obj->created_at = $value ['created_at'];
      $obj->updated_at = $value ['updated_at'];
      $obj->price = $value ['price'];
      $obj->longitude = $value ['longitude'];
      $obj->latitude = $value ['latitude'];
      $obj->type = $value ['type'];
      $obj->address = $value ['address'];

      return $obj;
    }*/




  public $id;
  private $name;
  private $photo;
  private $created_at;
  private $updated_at;
  private $price;
  private $longitude;
  private $latitude;
  private $num_of_view;
  private $type;
  private $address;
  private $service;

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

	public function getPhotos(){
		return $this->photos;
	}

	public function setPhotos($photos){
		$this->photos = $photos;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getUpdated_at(){
		return $this->updated_at;
	}

	public function setUpdated_at($updated_at){
		$this->updated_at = $updated_at;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
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

	public function getNum_of_view(){
		return $this->num_of_view;
	}

	public function setNum_of_view($num_of_view){
		$this->num_of_view = $num_of_view;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}

  public function getService(){
		return $this->$service;
	}

	public function setService($service){
		$this->service = $service;
	}


}
