<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>



<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">Update Admin Record</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>update your information below </font></p>


<?php
if (is_post_request()) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = '';

  if (is_blank($_POST['new_password'])){
    $password = $_POST['password'];
  }
  if (!is_blank($_POST['new_password'])) {
    if (password_verify($_POST['old_password'], $_POST['password'])) {
      $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
      echo "<h3>Password changed successfully!</h3></br>";

    } else {
      $password = $_POST['password'];
      echo "<h3>wrong password, try again </h3></br>";

    }
  }

  $args['name'] = $name;
  $args['email'] = $email;
  $args['username'] = $username;
  $args['hashed_password'] = password_hash($password, PASSWORD_BCRYPT);
  $args['is_super'] = 0;
  $args['id'] = $_POST['admin_id'];


  $admin = new Admin($args);
  $result = $admin->update();

  if (!$result) {
    echo "<h3>error updating your recod </h3></br>";
    die("");
  }else {
    echo "<h3>Your record updating successfully</h3> </br>";
    die("");
  }
}
?>

<?php
$admin = Admin::find_by_id($_GET['id']);
//var_dump ($admin);

 ?>

 <form action="edit.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
 <h2 class="w3-center">Admin Info </h2>
 <input type="hidden" name="admin_id" value="<?php echo $admin->getId() ?>" />
 <input type="hidden" name="password" value="<?php echo $admin->getHashedPassword() ?>" />

 <div class="w3-row w3-section">
   <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
     <div class="w3-rest">
       <input class="w3-input w3-border" name="name" type="text" placeholder="Name" value= "<?php echo $admin->getName();?>" >
     </div>
 </div>

 <div class="w3-row w3-section">
   <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
     <div class="w3-rest">
       <!-- we can disable username editing  -->
       <input class="w3-input w3-border" name="username" type="text" placeholder=" Username"  value= "<?php echo $admin->getUsername();?>">
     </div>
 </div>

 <div class="w3-row w3-section">
   <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
     <div class="w3-rest">
       <input class="w3-input w3-border" name="email" type="text" placeholder="Email" value= "<?php echo $admin->getEmail();?>">
     </div>
 </div>

 <div class="w3-row w3-section">
   <div class="w3-col" style="width:50px"><i class="fa fa-edit" style="font-size:48px"></i></div>
     <div class="w3-rest">
       <input class="w3-input w3-border" name="old_password" type="password" placeholder="old_Password">
     </div>
 </div>
 <div class="w3-row w3-section">
   <div class="w3-col" style="width:50px"><i class="fa fa-edit" style="font-size:48px"></i></div>
     <div class="w3-rest">
       <input class="w3-input w3-border" name="new_password" type="password" placeholder="new_password">
     </div>
 </div>


 <button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Send</button>

 </form>
 </div>


  </body>
</html>
