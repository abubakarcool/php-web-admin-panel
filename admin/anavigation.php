<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
 <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>                        
    </button>
    <a href="index.php" class="navbar-brand">Admin Panel</a>
 </div>
<div class="collapse navbar-collapse" id="myNavbar">
   <ul class="nav navbar-nav">
     <?php if(has_permission('admin')): ?>
     <li ><a href="admin.php">Add/Del Admin</a></li>
     <li ><a href="eadmin.php">Edit Admin</a></li>
     <li ><a href="users.php">Add/Del Users</a></li>
     <li ><a href="eusers.php">Edit Users</a></li>
     <?php endif; ?>
     <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">hello <?=$user_data['first'];?> ! 
         <span class="caret"></span>
       </a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="change_password.php">Change password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
     </li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
     <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Sign Up/Sign In</a></li>-->
   </ul>
 </div>
</div>
</nav>