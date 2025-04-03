<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
if(!is_logged_in()){
header('Location:login.php');
}
include 'aheader.php';
$hashed=$user_data['password'];
$old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password=trim($old_password);
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm=trim($confirm);
$new_hashed=$password;
$user_id=$user_data['id'];
$errors=array();
?>
<link href="admincss.css" rel="stylesheet" type="text/css">
<style>
body{
	background-color:grey;
	}
.form-group {
    margin-bottom: 1px;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 7px;
    margin-bottom: 1px;
}
</style>
<div id="login-form">
<div >
<?php
if($_POST){
	//form validation
  if(empty($_POST['old_password'])|| empty($_POST['password']) ||empty($_POST['confirm'])){
	$errors[]=  'you must fill out all feilds';
  }
  //pasword more than 6 charecters
  if(strlen($password)<6){
  $errors[]=  'passsword must be atleast 6 charecters';  
  }
  //check paswword and confirm equal
  if($password!=$confirm){
      $errors[]=  'passsword and confirm paswword donot same'; 
  }
  //check paswword in database
   $query=$db->query("SELECT * FROM users WHERE password='$old_password'");
  $user=mysqli_fetch_assoc($query);
  $userCount=mysqli_num_rows($query);
  if($userCount<1){
      $errors[]=  'password doesnot meet our records';
  }
  //check for errors
  if(!empty($errors)){
	  echo display_errors($errors);
  }else{
  //change paswword
  $db->query("UPDATE users SET password='$new_hashed' WHERE id='$user_id'");
  $_SESSION['success_falsh']='your password has been updated';
  header('Location:index.php');
  }
}
?>
</div>
<h3 class="text-center" >Change password</h3><br>
  <form action="change_password.php" method="post" >
    <div class="form-group">
     <label for="old_password">Old password:</label>
     <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
    </div>
    <div class="form-group">
     <label for="password">New password:</label>
     <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
     <label for="confirm">Confirm new password:</label>
     <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
    </div>
    <div class="form-group">
     <a href="index.php" class="btn btn-default">Cancel</a> 
     <input type="submit" value="login" class="btn btn-primary">
    </div>
  </form>
  <p class="text-right"><a href="index.php" alt"home">Visit Site</a></p>
</div>
<?php include 'afooter.php'; ?>