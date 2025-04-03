<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
include 'aheader.php';
//$password='password';
//$hashed=password_hash($password,PASSWORD_DEFAULT);
//echo $hashed;
$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$email=trim($email);
$password=trim($password);
$errors=array();
?>
<link href="admincss.css" rel="stylesheet" type="text/css">
<style>
body{
	background-color:grey;
	}
</style>
<div id="login-form">
<div >
<?php
if($_POST){
	//form validation
  if(empty($_POST['email'])||empty($_POST['password'])){
	$errors[]=  'you must provide email and password';
  }
  //email validation
  //if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  //	$errors[]=  'You must enter a valid email';  
  //}
  //pasword more than 6 charecters
  if(strlen($password)<6){
  $errors[]=  'passsword must be atleast 6 charecters';  
}
  //check if email exist in db
  $query=$db->query("SELECT * FROM users WHERE email='$email'");
  $user=mysqli_fetch_assoc($query);
  $userCount=mysqli_num_rows($query);
  if($userCount<1){
      $errors[]=  'Email doesnot exist in the database';
  }
  $query=$db->query("SELECT * FROM users WHERE password='$password'");
  $user=mysqli_fetch_assoc($query);
  $userCount=mysqli_num_rows($query);
  if($userCount<1){
      $errors[]=  'password doesnot meet in the database';
  }
  //if(!password_verify($password,$user['password'])){
//      $errors[]=  'passsword donot meet our records'; 
  //}
  //check for errors
  if(!empty($errors)){
	  echo display_errors($errors);
  }else{
  //log userin
  $user_id=$user['id'];
  login($user_id);
  }
}
?>
</div>
<h2 class="text-center" >Login</h2><br>
  <form action="login.php" method="post">
    <div class="form-group">
     <label for="email">Email:</label>
     <input type="username" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
     <label for="password">Password:</label>
     <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
     <input type="submit" value="login" class="btn btn-primary">
    </div>
  </form>
  <p class="text-right"><a href="/index.php" alt"home">Visit Site</a></p>
</div>
<?php include 'afooter.php'; ?>