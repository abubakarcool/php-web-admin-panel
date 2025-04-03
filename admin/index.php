<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
if(!is_logged_in()){
header('Location:login.php');
}
include 'aheader.php';
include 'anavigation.php';
?><?php
$userQuery=$db->query("SELECT * FROM users ORDER BY full_name");
?>
<div class='is-grouped'>
    <h2 class="text-center"><a href="users.php?add=1" id="add-product-btn" class="btn btn-success pull-left">Add new user</a>
    All Users
    <a href="admin.php?add=1" id="add-product-btn" class="btn btn-success pull-right">Add new admin</a></h2>
</div>
<table class="table table-bordered table-stripped table-condensed">
   <thead><th>Name:</th><th>Username:</th><th>Password:</th><th>Last login:</th><th>Join date:</th><th>Start date:</th><th>Expire date:</th><th>Permissions:</th><th>Mac address:</th></thead>
   <tbody>
   <?php while($user=mysqli_fetch_assoc($userQuery)):?>
     <tr>
       <td><?= $user['full_name']; ?></td>
       <td><?= $user['email']; ?></td>
       <td><?= $user['password']; ?></td>
       <td><?= (($user['last_login']=='0000-00-00 00:00:00')?'never logged-in':pretty_date($user['last_login'])); ?></td>
       <td><?= pretty_date($user['join_date']); ?></td>
       <td><?= (($user['sdate']=='0000-00-00 00:00:00')?'N/A':pretty_date($user['sdate'])); ?></td>
       <td><?= (($user['edate']=='0000-00-00 00:00:00')?'N/A':pretty_date($user['edate'])); ?></td>
       <td><?= $user['permissions']; ?></td>
       <td><?= $user['mac']; ?></td>
     </tr>
   <?php endwhile; ?>
   </tbody>
</table>
<br>
<?php include 'afooter.php'; ?>