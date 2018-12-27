<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>

<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">View Admin</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'> Information of Admin  </font></p>

<?php if (is_get_request()) {
  $admin = Admin::find_by_id($_GET['id']);
 ?>

  <form action="index.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
  <h2 class="w3-center">Admin Info </h2>
  <?php


  echo "<h4> ID:  {$admin->getId()}</h4> </br>";

  echo "<h4> Name:  {$admin->getName()}</h4> </br>";

  echo "<h4> Email:  {$admin->getEmail()}</h4></br>";

  echo "<h4> Username:  {$admin->getUsername()}</h4></br>";

  echo "<h4> Created at:  {$admin->getCreatedAt()}</h4></br>";

  echo "<h4> Updated at: {$admin->getUpdatedAt()}</h4></br>";
  }
?>
<button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Back</button>



</form>

</div>
  </body>
</html>
