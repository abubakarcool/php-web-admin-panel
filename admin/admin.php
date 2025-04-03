<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
if(!is_logged_in())
{
	login_error_redirect();
}
if(!has_permission('admin'))
{
	permission_error_redirect('index.php');
}
include 'aheader.php';
include 'anavigation.php';
if (isset($_GET['delete'])){
	$delete_id=sanitize($_GET['delete']);
	$db->query("DELETE FROM users WHERE id =$delete_id");
	$_SESSION['success_falsh']='admin has been deleted';
	header('Location:admin.php');
}
if (isset($_GET['add'])){
	$name=((isset($_POST['name']))?sanitize($_POST['name']):'');
	$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$permissions=((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
	$date=((isset($_POST['date']))?sanitize($_POST['date']):'');
	$errors=array();
	
	if($_POST){
	$emailQuery=$db->query("SELECT * FROM users WHERE email='$email'");
	$emailCount=mysqli_num_rows($emailQuery);
	if($emailCount!=0){
		$errors[] ='that username already exist in database';
	}
	$required=array('name','email','password','confirm');
	foreach($required as $f){
	  if(empty($_POST[$f])){
		  $errors[] ='you must fill all feilds';
		  break;
	  }
	}
	if(strlen($password)<6){
		  $errors[] ='your password must be atleast 6 charecters';
		  }
	if($password!=$confirm){
		  $errors[] ='your password donot match';
		  }
	//if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	//	  $errors[] ='enter valid email';
	//	  }
    if(strlen($email)>10){
		  $errors[] ='your username must be less then 10 charecters';
		  }
	if(!empty($errors)){
		  echo display_errors($errors);
	  }else{
		  //add user to database
		  //$hashed=password_hash($password,PASSWORD_DEFAULT);
		  //$db->query("INSERT INTO users(full_name,email,password,permissions,edate) VALUES ('$name','$email','$password','$permissions'//,'$date')");
		  $db->query("INSERT INTO users (full_name,email,password,last_login,permissions,sdate,edate) VALUES ('$name','$email','$password','0000-00-00 00:00:00','admin','0000-00-00 00:00:00','0000-00-00 00:00:00')");
	      $_SESSION['success_falsh']='admin has been added';
          header('Location:admin.php');
	  }
	}
	?>
    <h2 class="text-center">Add new admin</h2><hr>
    <form action="admin.php?add=1" method="post">
    <div class="form-group col-md-6" >
      <label for="name">Full name:</label>
      <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
    </div>
    <div class="form-group col-md-6" >
      <label for="email">Username:</label>
      <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group  col-md-6">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group col-md-6" >
      <label for="confirm">Confirm password:</label>
      <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
    </div>
    <div class="form-group col-md-6" style="margin-top:25px">
     <a href="admin.php" class="btn btn-default">Cancel</a> 
     <input type="submit" value="Add Admin" class="btn btn-primary">
    </div>
    </form>
    <?php
}else{
$userQuery=$db->query("SELECT * FROM `users` where Permissions = 'admin' ORDER BY full_name");
?>
<div class='is-grouped'>
<h2 class="text-center">Admins
<a href="admin.php?add=1" id="add-product-btn" class="btn btn-success pull-right">Add new admin</a></h2>     
</div>
<table class="table table-bordered table-stripped table-condensed">
   <thead><th>Delete admin:</th><th>Name:</th><th>Username:</th><th>Password:</th><th>Join date:</th><th>Last login:</th><th>Permissions:</th></thead>
   <tbody>
   <?php while($user=mysqli_fetch_assoc($userQuery)):?>
     <tr>
        <td>
       <?php if($user['id']!=$user_data['id']): ?>     
       <a href="admin.php?delete=<?=$user['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a>
       <?php endif; ?>
       </td>
       <td><?= $user['full_name']; ?></td>
       <td><?= $user['email']; ?></td>
       <td><?= $user['password']; ?></td>
       <td><?= pretty_date($user['join_date']); ?></td>
       <td><?= (($user['last_login']=='0000-00-00 00:00:00')?'never logged-in':pretty_date($user['last_login'])); ?></td>
       <td><?= $user['permissions']; ?></td>
     </tr>
   <?php endwhile; ?>
   </tbody>
</table>
<br>
<?php }include 'afooter.php'; ?>