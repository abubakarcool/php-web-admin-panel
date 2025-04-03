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
if (isset($_GET['add']) || isset($_GET['edit'])){
	$full_name=((isset($_POST['full_name']))?sanitize($_POST['full_name']):'');
	$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$permissions=((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
	$mac=((isset($_POST['mac']))?sanitize($_POST['mac']):'');
	$sdate=((isset($_POST['$sdate']))?sanitize($_POST['$sdate']):'');
	$date=((isset($_POST['date']))?sanitize($_POST['date']):'');
	$errors=array();
	if(isset($_GET['edit'])){
$edit_id=(int)$_GET['edit'];
$productResults=$db->query("SELECT * FROM users WHERE id = '$edit_id'");
$product=mysqli_fetch_assoc($productResults);
$full_name=((isset($_POST['full_name']) && $_POST['full_name']!='')?sanitize($_POST['full_name']):$product['full_name']);
$email=((isset($_POST['email']) && $_POST['email']!='')?sanitize($_POST['email']):$product['email']);
$password=((isset($_POST['password']) && $_POST['password']!='')?sanitize($_POST['password']):$product['password']);
$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$permissions=((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
$sdate=((isset($_POST['sdate']) && $_POST['sdate']!='')?sanitize($_POST['sdate']):$product['sdate']);
$date=((isset($_POST['date']) && $_POST['date']!='')?sanitize($_POST['date']):$product['date']);
//$db->query("DELETE FROM users WHERE ");
//$_SESSION['success_falsh']='user has been deleted';
//header('Location:users.php');
}
	if($_POST){
	$required=array('full_name','email','password','confirm','sdate','date');
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
    if(strlen($email)<6){
		  $errors[] ='your username must be atleast 6 charecters';
		  }
	if(!empty($errors)){
		  echo display_errors($errors);
	  }else{
		  //add user to database
		  //$hashed=password_hash($password,PASSWORD_DEFAULT);
	$db->query("UPDATE `users` SET full_name = '$full_name',email = '$email',password = '$password',permissions = 'user',sdate = '$sdate',edate = '$date' WHERE id ='$edit_id'");
	      $_SESSION['success_falsh']='user has been updated';
          header('Location:eusers.php');
	  }
	}
	?>
	<div class='is-grouped'>
    <h2 class="text-center">Edit User</h2>
    </div>
    <form action="eusers.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'');?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-6" >
      <label for="full_name">Full name:</label>
      <input type="text" name="full_name" id="full_name" class="form-control" value="<?=$full_name;?>">
    </div>
    <div class="form-group col-md-6" >
      <label for="email">Username:</label>
      <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group  col-md-6">
      <label for="password">Password:</label>
      <input type="text" name="password" id="password" class="form-control" value="<?=$password;?>">
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
     <a href="eusers.php" class="btn btn-default">Cancel</a> 
     <input type="submit" value="Edit User" class="btn btn-primary">
    </div>
    </form>
    <?php
}else{
$userQuery=$db->query("SELECT * FROM `users` where Permissions = 'user' ORDER BY full_name");
?>
<div class='is-grouped'>
<h2 class="text-center">Edit Users</h2>
<a href="eusers.php?edit=1" id="add-product-btn" type='hidden'></a>     
</div>
<table class="table table-bordered table-stripped table-condensed">
   <thead><th>Edit user:</th><th>Name:</th><th>Username:</th><th>Password:</th><th>Join date:</th><th>Start date:</th><th>Expire date:</th><th>Permissions:</th></thead>
   <tbody>
   <?php while($user=mysqli_fetch_assoc($userQuery)):?>
     <tr>
       <td>
       <?php if($user['id']!=$user_data['id']): ?> 
       <a href="eusers.php?edit=<?=$user['id'];?>"   class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
       <?php endif; ?>
       </td>
       <td><?= $user['full_name']; ?></td>
       <td><?= $user['email']; ?></td>
       <td><?= $user['password']; ?></td>
       <td><?= pretty_date($user['join_date']); ?></td>
       <td><?= (($user['sdate']=='0000-00-00 00:00:00')?'never entered':pretty_date($user['sdate'])); ?></td>
       <td><?= (($user['edate']=='0000-00-00 00:00:00')?'never entered':pretty_date($user['edate'])); ?></td>
       <td><?= $user['permissions']; ?></td>
     </tr>
   <?php endwhile; ?>
   </tbody>
</table>
<br>

<?php }include 'afooter.php'; ?>