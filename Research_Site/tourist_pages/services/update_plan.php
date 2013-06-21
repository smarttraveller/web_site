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

if( isset($_POST['update_plan']) ){
	
    $_SESSION['travel_plan_active_tab2'] = "active";
    unset($_SESSION['travel_plan_active_tab1']);
    
	@$_SESSION['travel_plan_page_numload']++;
	
	$destination = $_POST['edit_destination'];	
	$start_date = $_POST['CalendarForm_travel_plan_edit_start_date'];	
	$end_date = $_POST['CalendarForm_travel_plan_edit_end_date'];
	$contact_number =$_POST['edit_contact_number'];
	$plan_status = 0;
	$edit_plan_id = $_POST['edit_plan_id'];
	//$_SESSION['time_stamp'] = $time_stamp;
	
    $_SESSION['travel_plan_page_reload_num_on_submit'] = $_SESSION['travel_plan_page_numload'];
    
    if(($destination=="")||($start_date=="")||($end_date=="")||($contact_number=="")){
        
        echo("<script>window.alert('Please fill all the fields');</script>");
    }
    else{
        $plan_update_query = "update travel_plan set destination = '$destination', start_date = '$start_date', end_date = '$end_date', contact_number = '$contact_number', plan_status = '$plan_status' where id = '$edit_plan_id'";
	
        $plan_update = mysql_query($plan_update_query, $smart_traveller) or die(mysql_error());

        if ($plan_update) {

            /*echo("<script>window.alert('You have successfully updated your travel plan');location.href = 'travel_plan.php';</script>");*/
          //header("Location: " . $MM_redirectLoginSuccess );
            echo("<script> history.back();</script>");
            $_SESSION['travel_plan_update_message'] = "You have successfully updated your travel plan"." ".$edit_plan_id;
            return true;
        }
        else {
           /* echo("<script>window.alert('Error..Update failed..');location.href = 'travel_plan.php';</script>");*/
          //header("Location: ". $MM_redirectLoginFailed );
            echo("<script> history.back();</script>");
            $_SESSION['travel_plan_update_message'] = "Error..Update failed..";
            return false;
        }
        
    }
	
}
?>
