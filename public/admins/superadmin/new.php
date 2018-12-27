<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>


<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">Insert New Admin</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>Provide all information below </font></p>

<?php

if (is_post_request()) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $args['name'] = $name;
  $args['email'] = $email;
  $args['username'] = $username;
  $args['hashed_password'] = password_hash($password, PASSWORD_BCRYPT);
  $args['is_super'] = 0;

  $admin = new Admin($args);
  echo $admin->is_unique($username);
  //echo $admin->getUsername();
//  if ($admin->is_unique()) {
    $result = $admin->create($username);
    if (!$result) {
      echo "error inserting your recod ";
      die("");
      redirect_to('new.php');
    }else {
      echo "<font color ='#F8F8F8'> Your record inserted successfully </font>";
      die("");
    }
  /*}else{
    echo "<h4><font color ='#FF5733'>Username is already taken, try another one</font></h4>";
  }*/



}


  //var_dump($args);
?>
<form action="new.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
<h2 class="w3-center">Admin Info </h2>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="name" type="text" placeholder="Name">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="username" type="text" placeholder=" Username">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="email" type="text" placeholder="Email">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="fa fa-edit" style="font-size:48px"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="password" type="password" placeholder="Password">
    </div>
</div>


<button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Send</button>

</form>

</div>





  </body>
</html>
