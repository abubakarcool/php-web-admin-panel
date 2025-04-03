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
	$_SESSION['success_falsh']='user has been deleted';
	header('Location:users.php');
}
if (isset($_GET['resetmac'])){
	$resetmac_id=sanitize($_GET['resetmac']);
	$db->query("UPDATE users SET mac='' WHERE id =$resetmac_id");
	$_SESSION['success_falsh']='mac has been cleared';
	header('Location:users.php');
}
if (isset($_GET['add'])){
	$name=((isset($_POST['name']))?sanitize($_POST['name']):'');
	$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$permissions=((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
	$mac=((isset($_POST['mac']))?sanitize($_POST['mac']):'');
	$sdate=((isset($_POST['sdate']))?sanitize($_POST['sdate']):'');
	$date=((isset($_POST['date']))?sanitize($_POST['date']):'');
	$errors=array();
	
	if($_POST){
	$emailQuery=$db->query("SELECT * FROM users WHERE email='$email'");
	$emailCount=mysqli_num_rows($emailQuery);
	if($emailCount!=0){
		$errors[] ='that email already exist in database';
	}
	$required=array('name','email','password','confirm','sdate','date');
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
		  $errors[] ='your username must be atleast 10 charecters';
		  }
	if(!empty($errors)){
		  echo display_errors($errors);
	  }else{
		  //add user to database
		  //$hashed=password_hash($password,PASSWORD_DEFAULT);
		  //$db->query("INSERT INTO users(full_name,email,password,permissions,edate) VALUES ('$name','$email','$password','$permissions'//,'$date')");
		  $db->query("INSERT INTO users (full_name,email,password,last_login,permissions,sdate,edate) VALUES ('$name','$email','$password','0000-00-00 00:00:00','user','$sdate','$date')");
	      $_SESSION['success_falsh']='user has been added';
          header('Location:users.php');
	  }
	}
	?>
    <h2 class="text-center">Add new user</h2><hr>
    <form action="users.php?add=1" method="post">
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
    <div class="form-group col-md-6" >
      <label for="confirm">Start date:</label>
      <input type="date" name="sdate" id="sdate" data-date-format="YYYY MMMM DD 00:00:00" class="form-control" value="<?=$sdate;?>">
    </div>
    <div class="form-group col-md-6" >
      <label for="confirm">Expiry date:</label>
      <input type="date" name="date" id="date" data-date-format="YYYY MMMM DD 00:00:00" class="form-control" value="<?=$date;?>">
    </div>
    <div class="form-group col-md-6" style="margin-top:25px">
     <a href="users.php" class="btn btn-default">Cancel</a> 
     <input type="submit" value="Add User" class="btn btn-primary">
    </div>
    </form>
    <?php
}else{
//$userQuery=$db->query("SELECT * FROM users ORDER BY full_name");
$userQuery=$db->query("SELECT * FROM `users` where Permissions = 'user' ORDER BY full_name");
?>
<div class='is-grouped'>
<h2 class="text-center">Users
<a href="users.php?add=1" id="add-product-btn" class="btn btn-success pull-right">Add new user</a></h2>     
</div>
<table class="table table-bordered table-stripped table-condensed">
   <thead><th>Clear mac:</th><th>Delete user:</th><th>Name:</th><th>Username:</th><th>Password:</th><th>Join date:</th><th>Start date:</th><th>Expire date:</th><th>Permissions:</th><th>Mac address:</th></thead>
   <tbody>
   <?php while($user=mysqli_fetch_assoc($userQuery)):?>
     <tr>
       <td>
       <?php if($user['id']!=$user_data['id']): ?> 
       <a href="users.php?resetmac=<?=$user['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
       <?php endif; ?>
       </td>
       <td>
       <?php if($user['id']!=$user_data['id']): ?>     
       <a href="users.php?delete=<?=$user['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a>
       <?php endif; ?>
       </td>
       <td><?= $user['full_name']; ?></td>
       <td><?= $user['email']; ?></td>
       <td><?= $user['password']; ?></td>
       <td><?= (($user['join_date']=='0000-00-00 00:00:00')?'join date date not set':pretty_date($user['join_date'])); ?></td>
       <td><?= (($user['sdate']=='0000-00-00 00:00:00')?'start date not set':pretty_date($user['sdate'])); ?></td>
       <td><?= (($user['edate']=='0000-00-00 00:00:00')?'admin donot effect':pretty_date($user['edate'])); ?></td>
       <td><?= $user['permissions']; ?></td>
       <td><?= $user['mac']; ?></td>
     </tr>
   <?php endwhile; ?>
   </tbody>
</table>
<br>
<?php }include 'afooter.php'; ?>