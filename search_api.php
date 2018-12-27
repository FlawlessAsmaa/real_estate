<?php


function db_connect(){
	$server = true;
  if ($server === false){
    $servername = "localhost";
    $username 	= "root";
    $password 	= "";
    $dbname 	= "istanbul_real_estate";
  }else {
    $servername = "localhost";
    $username 	= "root";
    $password 	= "machine1";
    $dbname 	= "istanbul_real_estate";

  }
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	  return $conn;
}

$header = '';
$key = "Y^Tm}GHm'&>_hX0";
if(isset($_SERVER['HTTP_KEY'])) {
  $header = $_SERVER['HTTP_KEY'];
}
$pros = array();
if ($key === $header) {
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['id'];
		$conn = db_connect();
		$sql = "SELECT p.id, p.name, p.photo, p.created_at, p.updated_at, p.price, p.longitude, p.latitude, t.name as type ,d.address, s.name as service FROM property as p JOIN address as d on p.id = d.property_id JOIN type as t on p.id = t.property_id JOIN property_service on p.id = property_service.propriety_id JOIN service_around as s on s.id =  property_service.service_id WHERE p.id = {$id}";
		$con_results = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($con_results)) {
			$pros[]=$row;

		}
		header("HTTP/1.0 200  Found");
		$response['response_code'] = array("code"=>"200","msg"=>" Your data is  ");
		$response['data'] =  $pros;
		print_r(json_encode($response));

	}

}else{
	header("HTTP/1.0 403 Not Authorized");
	$response['response_code'] = array("code"=>"403","msg"=>" You Are not Authorized to use system  ");
	$response['data'] =  $errors;
	print_r(json_encode($response));
}

 ?>
?>
