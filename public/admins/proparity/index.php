<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>


<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">View All Proparties</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>Avialable Proparties </font></p>
  <h4 ><font color ='#FF5733'><a href="new.php">Insert New Property </a></font></h4>


  <table class="table">
    <thead>
    <tr>
      <th class="w3-xlarge" bgcolor ="#F8F8F8">Name</th><br>
      <th class="w3-xlarge" bgcolor ="#F8F8F8">Price</th>
      <th class="w3-xlarge" bgcolor ="#F8F8F8">Type</th>
      <th class="w3-xlarge" bgcolor ="#F8F8F8">Address</th>
      <th class="w3-xlarge" bgcolor ="#F8F8F8">Photo</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $pros= Propriety::find_all();
    //print_r ("asmaa" . $pros);
      foreach ($pros as $pro) {
        echo "<tr>";
      //echo "<td><h6><font color ='#F8F8F8'>".$pro['id'] . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$pro['name'] . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$pro['price'] . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$pro['type'] . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$pro['address'] . "</font></h6></td>";
        echo "<td><img id='myImg' height='100' width='100' src ='../../img/".$pro['photo']."' ></img></td>";;
      ?>

    <?php

        echo "</tr>";
      }
?>
