<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
//include 'aheader.php';
//$password='password';
//$hashed=password_hash($password,PASSWORD_DEFAULT);
//echo $hashed;
$email=((isset($_REQUEST['email']))?sanitize($_REQUEST['email']):'');
$password=((isset($_REQUEST['password']))?sanitize($_REQUEST['password']):'');
$mac=((isset($_REQUEST['mac']))?sanitize($_REQUEST['mac']):'');
$id=((isset($_REQUEST['id']))?sanitize($_REQUEST['id']):'');
$email=trim($email);
$password=trim($password);
$errors=array();
if($_GET)
{
	//check if email exist in db
    $query=$db->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $user=mysqli_fetch_assoc($query);
    $userCount=mysqli_num_rows($query);
    if($userCount<1)
	{
		echo ('install="0"');
		return 0;
    }
	else
	{
		$user_id=$user['id'];
		if ($user['mac']=='')//mac is input for 1st time
		{
			$db->query("UPDATE users SET mac='$mac' WHERE id=$user_id");
			echo ('install="1"');
			return 0;
		}
		elseif($user['mac'] != $mac)//if mac is not matched
		{
			echo ('install="0"');
			return 0;
		}
		else//means that it is matched
		{
			echo ('install="1"');
			return 0;
		}
	}
}
?>