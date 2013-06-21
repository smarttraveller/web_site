<?php require_once('Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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
  $loginUsername=$_POST['log_user'];
  $password=base64_encode($_POST['pwd_user']);
  //$MM_fldUserAuthorization = "user_level";
  $MM_redirectLoginSuccess = htmlspecialchars($_SERVER['HTTP_REFERER']);
  $MM_redirectLoginFailed = htmlspecialchars($_SERVER['HTTP_REFERER']);
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_smart_traveller, $smart_traveller);
  	
  $LoginRS__query=sprintf("SELECT username, password, user_level FROM `user` WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $smart_traveller) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
	while($info = mysql_fetch_array( $LoginRS )){
	
	$_SESSION['User_UserGroup'] = $info['user_level'];

	}
    //$loginStrGroup  = mysql_result($LoginRS,1,'user_level');
    
    //declare two session variables and assign them
    $_SESSION['User_Username'] = $loginUsername;
	
	$last_view_category_query=sprintf("SELECT last_view_category FROM `tourist` WHERE username=%s",
  	GetSQLValueString($loginUsername, "text")); 
	
	$last_view_category = mysql_query($last_view_category_query, $smart_traveller) or die(mysql_error());
	$last_view_category_found = mysql_fetch_array( $last_view_category );
	
	$_SESSION['category'] = $last_view_category_found['last_view_category'];
   // $_SESSION['User_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
		/*echo("<script>window.alert('Welcome to Smart Traveller....');location.href = '$MM_redirectLoginSuccess';</script>");*/
    //header("Location: " . $MM_redirectLoginSuccess );
		$arr_login = array('msg'=>"Welcome to Smart Traveller....", 'username'=>"Hello ".ucwords($loginUsername), 'redirect_page'=>$MM_redirectLoginSuccess, 'status'=>"true");
		echo json_encode($arr_login);
		return true;
  }
  else {
	  /*echo("<script>window.alert('Error Login...Please check your usernname and password...');location.href = '$MM_redirectLoginFailed';</script>");*/
	  $arr_login = array('msg'=>"Error Login...Please check your usernname and password...", 'username'=>"Hello Guest!", 'redirect_page'=>$MM_redirectLoginFailed, 'status'=>"false");
	  echo json_encode($arr_login);
	  return true;
    //header("Location: ". $MM_redirectLoginFailed );
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