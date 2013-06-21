<?php
require_once('../Connections/smart_traveller.php');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$acess_forbidden = '../index.php';
if((($_SESSION['User_UserGroup'])!="3")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
}

mysql_select_db($database_smart_traveller) or die(mysql_error()); 
$username = $_SESSION['User_Username'];

$data = mysql_query("SELECT * FROM guide WHERE username='$username'") or die(mysql_error());

while($info = mysql_fetch_array( $data )){
	
    $_SESSION['Availability'] = $info['availability'];

}

$MM_redirectLoginSuccess = htmlspecialchars($_SERVER['HTTP_REFERER']);

if( $_POST ){
	
	$current_availability_query = mysql_query("select availability from guide where username = '$username'") or die(mysql_error());
    $current_availability = mysql_fetch_array( $current_availability_query );
    $new_availability = 0;
    if($current_availability['availability'] == 1){
        $new_availability = 0;
        $_SESSION['Availability'] = 0;
        $arr_availability = array('availability'=>"0");
		echo json_encode($arr_availability);
    }
    else{
        $new_availability = 1;
        $_SESSION['Availability'] = 1;
        $arr_availability = array('availability'=>"1");
		echo json_encode($arr_availability);
    }
    
    $update_avaialability_query = "update guide set availability = '$new_availability' where username = '$username'";
    $update_avaialability = mysql_query($update_avaialability_query, $smart_traveller) or die(mysql_error());
    
//    if ($update_avaialability) {
//
//		echo("<script>window.alert('You have successfully updated your availability');location.href = 'guide_update.php';</script>");
////      header("Location: " . $MM_redirectLoginSuccess );
// 	}
//    else {
//		echo("<script>window.alert('Error..Update failed..');location.href = 'guide_update.php';</script>");
////      header("Location: ". $MM_redirectLoginSuccess );
//  	}
}
?>
