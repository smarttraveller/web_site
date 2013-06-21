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
	
	mysql_connect("localhost", "root", "") or die(mysql_error()); 
 	mysql_select_db("smart_traveller") or die(mysql_error()); 
	
 	/*$data = mysql_query("SELECT email FROM emails") or die(mysql_error()); 
	$data2 = mysql_query("SELECT email FROM user") or die(mysql_error()); 
	
 	while(($info = mysql_fetch_array( $data ))&&($info2 = mysql_fetch_array( $data2 ))) {
		
		 if((ucwords($_POST['newsletter']) == ucwords($info['email']))||(ucwords($_POST['newsletter']) == ucwords($info2['email']))){
			 
			echo("<script>window.alert('Your email is already Subscribed for our News Letters');location.href = 'index.php';</script>");
			
		 }
	}*/
	
	$data2 = mysql_query("SELECT email FROM user") or die(mysql_error()); 
	
 	while($info2 = mysql_fetch_array( $data2 )) {
		
		 echo $info2['email'];
			 
			
	}
	echo '<br/>';
	echo $_SESSION['User_UserGroup'];
 



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