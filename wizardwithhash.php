<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
//include 'aheader.php';
$password='password';
//$hashed=password_hash($password,PASSWORD_DEFAULT);
//echo $hashed;
$email=((isset($_REQUEST['email']))?sanitize($_REQUEST['email']):'');
$password=((isset($_REQUEST['password']))?sanitize($_REQUEST['password']):'');
$mac=((isset($_REQUEST['mac']))?sanitize($_REQUEST['mac']):'');
$id=((isset($_REQUEST['id']))?sanitize($_REQUEST['id']):'');
$email=trim($email);
$password=trim($password);
$errors=array();
if($_GET){
    //check if email exist in db
    $query=$db->query("SELECT * FROM users WHERE email='$email'");
    $user=mysqli_fetch_assoc($query);
    $userCount=mysqli_num_rows($query);
    if($userCount<1){
  	  echo ('install=""');
	  return 0;
    }
    elseif(!password_verify($password,$user['password'])){
      echo ('install=""');
	}else{
    $user_id=$user['id'];
	if ($user['mac']==''){
		$db->query("UPDATE users SET mac='$mac' WHERE id=$user_id");
     }elseif($user['mac'] != $mac){
      echo ('install=""');
	  return 0;
	 }
      echo ('install="1"');
    }
}
?>