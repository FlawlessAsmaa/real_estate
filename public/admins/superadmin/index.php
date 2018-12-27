<?php $selected = "admins";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>



<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">All Admins</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>List of All sub Admins & you can customize them.</p>

    <h4 ><font color ='#FF5733'><a href="new.php">Insert New Admin </a></font></h4>



          <table class="table">
            <thead>
            <tr>
          <th class="w3-xlarge" bgcolor ="#F8F8F8">  ID</th>
          <th class="w3-xlarge" bgcolor ="#F8F8F8">Name</th><br>
          <th class="w3-xlarge" bgcolor ="#F8F8F8">Username</th>
          <th class="w3-xlarge" bgcolor ="#F8F8F8">Email</th>
          <th class="w3-xlarge" bgcolor ="#F8F8F8">Operations</th>

      <?php
      $admins = Admin::find_all();
      foreach ($admins as $admin) {
        echo "<tr>";
        echo "<td><h6><font color ='#F8F8F8'>".$admin->getId() . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$admin->getName() . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$admin->getUsername() . "</font></h6></td>";
        echo "<td><h6><font color ='#F8F8F8'>".$admin->getEmail() . "</font></h6></td>";
        echo "<td> <h6>"
        ."<a href='view.php?id={$admin->getId()}' >". "<font color ='#F8F8F8'> View </font>" ."</a>"
        ."<a href='edit.php?id={$admin->getId()}'>". " <font color ='#F8F8F8'>- Edit </font>" ."</a>"
        ."<a href='delete.php?id={$admin->getId()}' "
        ."onclick='return confirm(\"Are you sure?\")' >". "<font color ='#F8F8F8'> -  Delete </font>" ."</a>"
        ."</font></h6></td>";

        //print_r($cat);
      }

      ?>
      </table>
    </div>
  </body>
</html>
