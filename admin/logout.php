<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
unset($_SESSION['SBUser']);
header('Location:login.php');
?>