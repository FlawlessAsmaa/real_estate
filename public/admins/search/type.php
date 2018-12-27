<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">  Search Proparties</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>Search Proparties By Type </font></p>

    <form action="type.php" class="w3-container w3-card-4 w3-white w3-text-black w3-margin" method = "post" >
      <h2 class="w3-center">Property Types  </h2></br>
      <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-search"></i></div>
        <div class="w3-rest">
          <label>Choose type of the property you are searching for below</label></br>
          <select class="w3-input w3-border" width = "50" name = "type">
            <option value = "sale">sale</option>
            <option value = "rent">rent</option>
          </select>
        </div>
      </div>
      <button class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Search</button>

    </form>

<?php

if (is_post_request()) {
  $type = $_POST['type'];

  $obj1 = new Type();
  $type_obj = $obj1->setName($type);

  $obj2 = new Propriety();
  $pro_obj = $obj2->search_by_type($obj1->getName());


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
$pros= Propriety::search_by_type($type);
foreach ($pros as $pro) {
  echo "<tr>";
  //echo "<td><h6><font color ='#F8F8F8'>".$pro['id'] . "</font></h6></td>";
  echo "<td><h6><font color ='#F8F8F8'>".$pro['name'] . "</font></h6></td>";
  echo "<td><h6><font color ='#F8F8F8'>".$pro['price'] . "</font></h6></td>";
  echo "<td><h6><font color ='#F8F8F8'>".$pro['type'] . "</font></h6></td>";
  echo "<td><h6><font color ='#F8F8F8'>".$pro['address'] . "</font></h6></td>";
  echo "<td><img id='myImg' height='100' width='100' src ='../../img/".$pro['photo']."' ></img>";
  ?>
  <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<?php
echo "</td>";
echo "</tr>";
}
require_once('../../js/enlarg_photo.php');

}

 ?>
