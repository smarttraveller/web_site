<?php require_once('Connections/smart_traveller.php'); ?>
<?php 
error_reporting(E_ALL ^ E_NOTICE);
mysql_select_db("smart_traveller") or die(mysql_error()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
$name = $_POST['link'];
$LoginRS__query_2 = "UPDATE guide SET username = 'namal1' WHERE id_number = '$name'";
$LoginRS_2 = mysql_query($LoginRS__query_2, $smart_traveller) or die(mysql_error());
header('Location: http://localhost/Research_Site/guide_list.php');
?>
</head>

<body>

</body>
</html>