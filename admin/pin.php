<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Ummerkodi/coresystem/init.php';
//include 'aheader.php';
$pin=((isset($_REQUEST['pin']))?sanitize($_REQUEST['pin']):'');
$mac=((isset($_REQUEST['mac']))?sanitize($_REQUEST['mac']):'');
$id=((isset($_REQUEST['id']))?sanitize($_REQUEST['id']):'');
$errors=array();
if($_GET){
    //check if email exist in db
    $query=$db->query("SELECT * FROM pins WHERE pin='$pin'");
    $pins=mysqli_fetch_assoc($query);
    $userCount=mysqli_num_rows($query);
    if($userCount<1){
  	  echo ('install=""');
	  return 0;
    }else{
    $pins_id=$pins['id'];
	if ($pins['pin']==''){
		$db->query("UPDATE pins SET pin='$pin'");
		
     }elseif($pins['mac']==''){
	    $db->query("UPDATE pins SET mac='$mac' WHERE id=$pins_id");
	}elseif($pins['mac'] != $mac){
      echo ('install=""');
	  return 0;
	 }
     elseif($pins['pin'] != $pin){
      echo ('install=""');
	  return 0;
	 }
      echo ('install="1"');
    }
}
?>