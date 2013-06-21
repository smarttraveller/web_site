<?php
require_once('../../Connections/smart_traveller.php'); 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$username = $_SESSION['User_Username'];
$acess_forbidden = '../../index.php';
if((($_SESSION['User_UserGroup'])!="1")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../../index.php';</script>");
	header("Location: " . $acess_forbidden );
}
mysql_select_db($database_smart_traveller) or die(mysql_error()); 

if(isset($_POST['delete_plan'])){
	
    $_SESSION['travel_plan_active_tab2'] = "active";
    unset($_SESSION['travel_plan_active_tab1']);
    @$_SESSION['travel_plan_page_numload']++;
	
	$plan_id = $_POST['plan_id'];
    
    $_SESSION['travel_plan_page_reload_num_on_submit'] = $_SESSION['travel_plan_page_numload'];
    
	$plan_delete_query = "delete from travel_plan where id = '$plan_id'";
	
	$plan_delete = mysql_query($plan_delete_query, $smart_traveller) or die(mysql_error());

    if ($plan_delete) {

		/*echo("<script>window.alert('You have successfully deleted your plan');location.href = 'travel_plan.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['travel_plan_delete_message'] = "You have successfully deleted your plan"." ".$plan_id;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'travel_plan.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['travel_plan_delete_message'] = "Error..Delete failed..";
        return false;
  	}
}
?>
