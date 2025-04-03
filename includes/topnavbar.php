<?php
$sql="SELECT * FROM catagories WHERE parent ='0'";
$pquery=$db->query($sql);
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
 <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>                        
    </button>
 </div>
<div class="collapse navbar-collapse" id="myNavbar">
   <ul class="nav navbar-nav navbar">
     <li><a href="index.php" class="navbar-brand">Kodi Home</a></li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
      <li><a href="/iptvplus/admin/login.php"><span class="glyphicon glyphicon-log-in"></span> LogIn</a></li>
   </ul>
 </div>
</div>
</nav>