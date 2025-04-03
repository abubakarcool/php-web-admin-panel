<?php
$db = mysqli_connect("localhost","u976233403_ucool38","123456aBU.","u976233403_database");
if(mysqli_connect_errno()){
echo'database connetion fail bro error chk kr ly ab:'.mysqli_connect_error();
die();
}session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require_once BASEURL.'helpers/helper.php';
if(isset($_SESSION['SBUser'])){
$user_id=$_SESSION['SBUser'];
$query=$db->query("SELECT * FROM users WHERE id='$user_id'");
$user_data=mysqli_fetch_assoc($query);
$fn = explode(' ', $user_data['full_name']);
$user_data['first']= $fn[0];
$user_data['last']= $fn[1];
}
if (isset($_SESSION['success_falsh'])){
echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_falsh'].'</p></div>';
unset($_SESSION['success_falsh']);
}
if(isset($_SESSION['error_falsh'])){
echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_falsh'].'</p></div>';
unset($_SESSION['error_falsh']);
}