<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/admin_header.php'); ?>
<?php require_once(PRIVATE_PATH . '/includes/super_admin_header.php'); ?>
<<?php
$args['id'] = $_GET['id'];

$admin = new Admin($args);
$result = $admin->delete();

if (!$result) {
  echo "error Deleting your recod ";
}else {
  echo "Your record is Deleted successfully";
    header("Location: index.php" );
}





 ?>
