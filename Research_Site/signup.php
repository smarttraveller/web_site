<?php require_once('Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ( $_POST ) {
	
	mysql_connect($hostname_smart_traveller, $username_smart_traveller, $password_smart_traveller) or die(mysql_error()); 
 	mysql_select_db($database_smart_traveller) or die(mysql_error()); 
	
	$MM_redirectLoginSuccess = htmlspecialchars($_SERVER['HTTP_REFERER']);
  	$MM_redirectLoginFailed = htmlspecialchars($_SERVER['HTTP_REFERER']);
  
 	$data = mysql_query("SELECT * FROM user") or die(mysql_error()); 
	
 	while($info = mysql_fetch_array( $data )) {
		
		 if(ucwords($_POST['username']) == ucwords($info['username'])){
			 
			/*echo("<script>window.alert('Your Username already exists. Choose another Username');location.href = '$MM_redirectLoginFailed';</script>");*/
			$arr_signup = array('msg_signup'=>"Your Username already exists. Choose another Username", 'status_signup'=>"false");
			echo json_encode($arr_signup);
			return true;
			
		 }
		 
		 else if(ucwords($_POST['email']) == ucwords($info['email'])){
			 
			/*echo("<script>window.alert('Your Email already exists. Choose another Email');location.href = '$MM_redirectLoginFailed';</script>");*/
			$arr_signup = array('msg_signup'=>"Your Email already exists. Choose another Email", 'status_signup'=>"false");
			echo json_encode($arr_signup);
			return true;
		 }
	}
	$user_level = 0;
	if($_POST['user_type']=="tourist"){
		$user_level = 1;
	}
	else if($_POST['user_type']=="advertiser"){
		$user_level = 2;
	}
	else if($_POST['user_type']=="guide"){
		$user_level = 3;
	}
	else{
		
		$user_level = 4;
  
	}
	
  $insert_user = sprintf("INSERT INTO `user` (username, email, password, user_type, user_level) VALUES (%s, %s, %s, %s, %u)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString(base64_encode($_POST['password']), "text"),
					   GetSQLValueString($_POST['user_type'], "text"),
					   $user_level, "text");
  


  mysql_select_db($database_smart_traveller, $smart_traveller);
  $Result_user = mysql_query($insert_user, $smart_traveller) or die(mysql_error());
  
  if($user_level == 3){
	  $insert_guide = sprintf("INSERT INTO `guide` (username, email, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString(base64_encode($_POST['password']), "text"));  
	  
	  $Result_guide = mysql_query($insert_guide, $smart_traveller) or die(mysql_error());
	  $insertGoTo = "guide_pages/guide_update.php"; 	  
  }
  if($user_level == 1){
	 $insert_tourist = sprintf("INSERT INTO `tourist` (username, email, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString(base64_encode($_POST['password']), "text"));  
	  
	  $Result_tourist = mysql_query($insert_tourist, $smart_traveller) or die(mysql_error());
	  $insertGoTo = "tourist_pages/member_update.php"; 
  }
  if($user_level == 2){
	 $insert_tourist = sprintf("INSERT INTO `advertiser` (username, email, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString(base64_encode($_POST['password']), "text"));  
	  
	  $Result_tourist = mysql_query($insert_tourist, $smart_traveller) or die(mysql_error());
	  $insertGoTo = "advertiser_pages/advertiser_update.php"; 
  }

  if (isset($_SERVER['QUERY_STRING'])) {
	$_SESSION['User_Username'] = $_POST['username'];
	$_SESSION['User_UserGroup'] = $user_level;
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  	/*echo("<script>window.alert('Welcome to Smart Traveller. Please update your profile...');location.href = '$insertGoTo';</script>");*/
  	$arr_login_admin = array('msg_signup'=>"Welcome to Smart Traveller. Please update your profile...", 'username_signup'=>"Hello ".ucwords($_POST['username']), 'redirect_page_signup'=>$insertGoTo, 'status_signup'=>"true");
	echo json_encode($arr_login_admin);
	return true;
  //header(sprintf("Location: %s", $insertGoTo));
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>