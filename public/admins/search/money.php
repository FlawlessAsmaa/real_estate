<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>



<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">  Search Proparties</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>Search Proparties By Money </font></p>


    <form action="money.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
      <h2 class="w3-center">Property Types  </h2></br>
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-search"></i></div>
        <div class="w3-rest">
          <label>Provide the amount of money blow</label></br></br></br>
          <select class="w3-input w3-border" width = "50" name = "money">
            <option value = "below 1000">Below 1000</option>
            <option value = "from 1000 to 10000">1000 - 10000</option>
            <option value = "from 10000 to 100000">10000 - 100000</option>
            <option value = "from 100000 to 1000000">100000 - 1000000</option>
            <option value = "more than 1000000">More than 1000000</option>
          </select>


        </div>
      <button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Search</button>
</form>

<!--
        <form action="money.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
          <h2 class="w3-center">Property Types  </h2></br>
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-search"></i></div>
            <div class="w3-rest">
              <label>Provide the amount of money blow</label></br></br></br>
              <div>
                <label>Choose Minimum Amount Of Money</label>
                <input class="w3-input w3-border" name="minimum" type="number" placeholder="minimum" />
              </div>
              <div>
                <label>Choose Maximum Amount Of Money</label>
                <input class="w3-input w3-border" name="maximum" type="number" placeholder="maximum" />
              </div>


            </div>
          <button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Search</button>

        </form>
-->

<?php
if (is_post_request()) {
  //$minimum = $_POST['minimum'];
  //$maximum = $_POST['maximum'];

  $money = $_POST['money'];
  //echo $money;
/*  $obj2 = new Propriety();
  $pro_obj = $obj2->search_by_money($minimum, $maximum);*/
  ?>

  <table class="table">
    <thead>
      <tr>
        <th width="30">Name</th>
        <th width="20">Price</th>
        <th width="20">Type</th>
        <th width="40">Address</th>
        <th width="100">Photo</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $pros= Propriety::search_by_specific_money($_POST['money']);
      //print_r ("asmaa" . $pros);
      if (!is_null($pros)) {
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
      }
    }

 ?>
