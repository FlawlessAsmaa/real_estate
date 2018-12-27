<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>


<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">Insert New Property</h2>
    <hr style="width:200px" class="w3-opacity">
    <p><font color ='#F8F8F8'>Provide all information below </font></p>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $target_dir = "../../img/";

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }


  $name = $_POST['name'];
  $img = basename( $_FILES["fileToUpload"]["name"]);
  $price = $_POST['price'];
  $address = $_POST['address'];
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  $type = $_POST['type'];
  $service = $_POST['service'];
  //$service = $_POST['service'];

  $obj1 = new Address();
  $address_obj = $obj1->setAddress($address);
  $obj2 = new Type();
  $type_obj = $obj2->setName($type);
  $obj3 = new Service();
  $service_obj = $obj3->setName($service);
  //$obj3 = new Service ();

  $args['name'] = $name;
  $args['photo'] = $img;
  $args['price'] = $price;
  $args['address'] = $obj1->getAddress();
  $args['longitude'] = $longitude;
  $args['latitude'] = $latitude;
  $args['type'] = $obj2->getName();
  $args['num_of_view'] = 1;
  $args['service'] = $obj3->getName();
  //$args['services'] = $service_obj;


  $pro = new Propriety($args);
  //echo $_POST['service'];
//  echo  $obj3->getName();
  if($pro->create_pro())
  echo " Proparity Created Successfully";
  else
  echo "" ;
  die("");

}




 ?>



 <form role="form"  action="new.php" method="post" enctype="multipart/form-data">
   <div class="row">
     <div class="form-group col-lg-4">
       <label for="code"> Name:</label>
       <input type="text" name="name" class="form-control" />
     </div>
   </div>

   <div class="row">
     <div class="form-group col-lg-4 ">
       <label for="code">Image</label>
       <input type="file" name="fileToUpload" id="fileToUpload">
     </div>
   </div>
   <div class="row">
     <div class="form-group col-lg-4">
       <label for="code"> Price:</label>
       <input type="text" name="price" class="form-control" />
     </div>
   </div>

   <?php require_once(PUBLIC_PATH . '/js/map.php')?>

   <div id="myMap"></div>
   <label for="code">Address</label><br/>
   <input id="address" type="text" style="width:600px;" name = "address"/><br/>
   <label for="code">Longitude</label>
   <input type="text" id="latitude" placeholder="Latitude"/ class="w3-input w3-border" name = "longitude">
   <label for="code">Latitude</label>
   <input type="text" id="longitude" placeholder="Longitude"/ class="w3-input w3-border" name = "latitude">
   <br/>
   <div class="row">
     <div class="form-group col-lg-4">
       <label for="code"> type:</label>
       <input type="text" name="type" class="form-control" />
     </div>
   </div>

   <div class="row">
     <div class="form-group col-lg-4">
       <label for="code"> service:</label>
       <input type="text" name="service" class="form-control" />
     </div>
   </div>

   <div class="row">
     <div class="form-group col-lg-1 ">
       <input class="w3-button w3-block w3-section w3-black w3-ripple w3-padding" type="submit" name="submit" value="Add">
     </div>
   </div>

</form>
</div>
</body>
</html>









<?php
/*
$cat = new Category;
$cat->setName('Breakfast');
$args['name'] = 'asmaaa';
$args['description'] = "asmamamma";
$args['price'] = 50;
$args['photo'] = 'asmaa.png';
$args['category'] = $cat;

$meal = new MenuItem($args);
if ($meal->create()) {
  echo "success";
}else {
  echo "fail";
}
*/
?>
