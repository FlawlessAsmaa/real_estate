<?php

   function validate_username($username) {
    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
      echo "Username must be 5 characters at least - english chars & numbers only allowed ";
  }
}

   function validate_name($name) {
    if(strlen($name) < 8){
      echo " Name must be 8 or more charactes";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      echo "Only letters and white space allowed";
    }

  }

   function validate_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      return FALSE;
    }
    //check if the domail is real
    $domain = explode("@", $email, 2);
    return checkdnsrr($domain[1]); // returns TRUE/FALSE;
}
 ?>
