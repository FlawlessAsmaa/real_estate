<?php

class Admin {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public function find_by_sql($sql)
  {
    $admins_array = array();
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    while ($record = $result->fetch_assoc()) {
      $admins_array[] =  self::instantiate($record);
    }
    return $admins_array;
  }

  public function create($username)
  {
    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = self::$database->query($sql);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    //print_r($this);
    $sql  ="INSERT INTO admin(" ;
    $sql .=" name, email, username, hashed_password, created_at, updated_at, is_super";
    $sql .=" ) VALUES ( ";
    $sql .="'" . self::$database->escape_string($this->name) ."',";
    $sql .="'" . self::$database->escape_string($this->email) ."',";
    $sql .="'" . self::$database->escape_string($this->username) ."',";
    $sql .="'" . $this->hashed_password ."',";
    $sql .=" CURRENT_TIMESTAMP ,";
    $sql .=" CURRENT_TIMESTAMP,";
    $sql .="'" . $this->is_super ."'";
    $sql .=");";
    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
      return $result;
    }
  }else {
    echo "Username is taken try another one </br>";
  }


  }

  public function update()
  {
    //print_r($this);
    $sql  ="UPDATE admin SET " ;
    $sql .=" name = '" . self::$database->escape_string($this->name) ."',";
    $sql .=" email = '" . self::$database->escape_string($this->email) ."',";
    $sql .=" username = '" . self::$database->escape_string($this->username) ."',";
    $sql .=" hashed_password = '" . $this->hashed_password ."',";
    $sql .=" updated_at = CURRENT_TIMESTAMP ,";
    $sql .=" is_super = '" . $this->is_super ."'";
    $sql .=" WHERE ";
    $sql .="id = ".$this->id ." ;";

    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
    }else {
      echo "Can't update record " . self::$database->error ;
    }
    return $result;
  }

  public function delete()
  {
    //print_r($this);
    $sql  ="DELETE FROM admin" ;
    $sql .=" WHERE ";
    $sql .="id = ".$this->id ." ;";

    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id; //why??????
    }else {
      echo "Can't Delete record " . self::$database->error ;
    }
    return $result;
  }

  public function find_all()
  {
    $sql = "Select * from admin";
    $admin_array = self::find_by_sql($sql);

    return $admin_array;
  }

  public function find_by_id($id)
  {
    $cat_array = [];
    $sql = "SELECT * FROM admin WHERE id = {$id}";
    $admins_array = self::find_by_sql($sql);
    return array_shift($admins_array);
  }

  public function instantiate($value)
  {
    $obj = new self();
    $obj->id = $value ['id'];
    $obj->name = $value ['name'];
    $obj->email = $value ['email'];
    $obj->username = $value ['username'];
    $obj->hashed_password = $value ['hashed_password'];
    $obj->created_at = $value ['created_at'];
    $obj->updated_at = $value ['updated_at'];
    $obj->is_super = $value ['is_super'];

    return $obj;
  }

  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->hashed_password = $args['hashed_password'] ?? '';
    //$this->created_at = $args['created_at'] ?? '';
    //$this->updated_at = $args['updated_at'] ?? '';
    $this->is_super = $args['is_super'] ?? '';
    //var_dump($this);
  }

  static public function is_unique($username) {
      $sql = "SELECT * FROM admin ";
      $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
      $result = self::$database->query($sql);
      if ($result->num_rows >1){
        echo "username is already taken";
      }else {
        echo "";
      }

    }

  static public function find_by_username($username) {
      $sql = "SELECT * FROM admin ";
      $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
      $obj_array = self::find_by_sql($sql);
      //print_r($obj_array); exit();
      if(!empty($obj_array)) {
        return array_shift($obj_array);
      } else {
        return false;
      }
    }


  public $id;
  private $name;
  private $email;
  private $username;
  private $hashed_password;
  private $created_at;
  private $updated_at;
  private $is_super;




  public function verify_password($password) {
      return password_verify($password, $this->hashed_password);
    }

    public function getId(){
      return $this->id;
    }
    public function getName(){
      return $this->name;
    }
    public function getEmail(){
      return $this->email;
    }
    public function getUsername(){
      return $this->username;
    }
    public function getHashedPassword(){
      return $this->hashed_password;
    }
    public function getCreatedAt(){
      return $this->created_at;
    }
    public function getUpdatedAt(){
      return $this->updated_at;
    }
    public function setId($id){
      $this->id = $id;
    }
    public function setName($name){
      $this->name = $name;
    }
    public function setEmail($email){
      $this->email = $email;
    }
    public function setUsername($username){
      $this->username = $username;
    }
    public function setHashedPassword($hashed_password){
      $this->hashed_password = $hashed_password;
    }
    public function setCreatedAt($created_at){
      $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at){
      $this->updated_at = $updated_at;
    }

    public function getIsSuper(){
      return $this->is_super;
    }

    public function setIsSuper($is_super){
      $this->is_super = $is_super;
    }


}
