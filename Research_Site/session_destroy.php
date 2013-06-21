<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$acess_forbidden = 'index.php';
if((($_SESSION['User_UserGroup'])!="1")&&(($_SESSION['User_UserGroup'])!="2")&&(($_SESSION['User_UserGroup'])!="3")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = 'index.php';</script>");
	header("Location: " . $acess_forbidden );
}
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
unset($_SESSION['User_Username']);
unset($_SESSION['User_UserGroup']);
unset($_SESSION['Admin_Username']);
unset($_SESSION['User_Email']);
unset($_SESSION['User_Name']);
unset($_SESSION['User_Address']);
unset($_SESSION['User_Country']);
unset($_SESSION['User_Telephone']);
unset($_SESSION['User_Title']);
unset($_SESSION['User_BadgeName']);
unset($_SESSION['User_Gender']);
unset($_SESSION['User_Dob']);
unset($_SESSION['User_ID']);
unset($_SESSION['User_Nationality']);
unset($_SESSION['User_Institutes']);
unset($_SESSION['User_Qualification_1']);
unset($_SESSION['User_Qualification_2']);
unset($_SESSION['User_Qualification_3']);
unset($_SESSION['User_Category']);
unset($_SESSION['User_Type']);
session_destroy();
//header("Location: $url");
echo("<script>location.href = '$url';</script>");
//<?php echo 'document.write("'.$_SERVER['HTTP_REFERER'].'")'; 
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