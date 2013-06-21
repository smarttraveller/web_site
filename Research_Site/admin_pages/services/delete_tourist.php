<?php
require_once('../../Connections/smart_traveller.php');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$acess_forbidden = '../../index.php';
if((($_SESSION['Admin_Username'])=="")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../../index.php';</script>");
	header("Location: " . $acess_forbidden );
}
mysql_select_db($database_smart_traveller) or die(mysql_error()); 

if( $_POST ){
    
    $_SESSION['active_tab1'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$tourist_username = $_POST['tourist_username'];
	$tourist_delete_query = "delete from tourist where username = '$tourist_username'";
	
	$tourist_delete = mysql_query($tourist_delete_query, $smart_traveller) or die(mysql_error());
    $tourists = array();
    
    if ($tourist_delete) {

		/*echo("<script>window.alert('You have successfully deleted that tourist');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
       /*echo("<script> history.back();</script>");*/
        $_SESSION['message_delete_tourist'] = "You have successfully deleted the tourist"." ".$tourist_username;
//        return false;
//        $arr_delete_tourist = array('msg_delete_tourist'=>"You have successfully deleted the tourist");
//		echo json_encode($arr_delete_tourist);
        
        $tourist_select_query = mysql_query( "SELECT * FROM tourist" ) or die( mysql_error() );
        while( $row_tourists = mysql_fetch_array( $tourist_select_query )){
            array_push($tourists, $row_tourists['name_initials']);
        }
        $arr_tourist_list = array('msg_delete_tourist'=>"You have successfully deleted the tourist", 'tourist_list'=>$tourists);
		echo json_encode($arr_tourist_list);
        
		return true;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        /*echo("<script> history.back();</script>");*/
        $_SESSION['message_delete_tourist'] = "Error..Delete failed..";
        $arr_delete_tourist = array('msg_delete_tourist'=>"Error..Delete failed..");
		echo json_encode($arr_delete_tourist);
		return false;
  	}
}
?>
