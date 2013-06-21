<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$acess_forbidden = '../index.php';
if((($_SESSION['Admin_Username'])=="")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
}
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
?>

<?php 
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if ( $_POST ) {
  $loginUsername=$_POST['log_admin'];
  $password=  base64_encode($_POST['pwd_admin']);
  //$MM_fldUserAuthorization = "user_level";
  $MM_redirectLoginSuccess = htmlspecialchars($_SERVER['HTTP_REFERER']);
  $MM_redirectLoginFailed = htmlspecialchars($_SERVER['HTTP_REFERER']);
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_smart_traveller, $smart_traveller);
  	
  $LoginRS__query=sprintf("SELECT username, password, email FROM `admin` WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $smart_traveller) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  $admin_details = mysql_fetch_array( $LoginRS );
  if ($loginFoundUser) {
    
   // $loginStrGroup  = mysql_result($LoginRS,1,'user_level');
    
    //declare two session variables and assign them
    $_SESSION['Admin_Username'] = $loginUsername;
	$_SESSION['User_UserGroup'] = 4;
    $_SESSION['Admin_email'] = $admin_details['email'];
   // $_SESSION['User_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    //header("Location: " . $MM_redirectLoginSuccess );
		$arr_login_admin = array('msg_admin'=>"You have sucessfully log in", 'username_admin'=>"Hello ".ucwords($loginUsername), 'redirect_page_admin'=>$MM_redirectLoginSuccess, 'status_admin'=>"true");
		echo json_encode($arr_login_admin);
		return true;
  }
  else {
    //header("Location: ". $MM_redirectLoginFailed );
		$arr_login_admin = array('msg_admin'=>"Error Login...Please check your usernname and password...", 'username_admin'=>"Hello Guest!", 'redirect_page_admin'=>$MM_redirectLoginFailed, 'status_admin'=>"false");
	  	echo json_encode($arr_login_admin);
	  	return true;
  }
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