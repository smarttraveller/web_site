<?php require_once('Connections/smart_traveller.php'); 
error_reporting(E_ALL ^ E_NOTICE);
mysql_select_db("smart_traveller") or die(mysql_error()); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
$data = mysql_query("SELECT username FROM guide where LOWER(username) like '%user%' and LOWER(institutes) like '%institute1%'") or die(mysql_error());
while($row = mysql_fetch_array($data)) { 
	echo $row['username'].'<br/>';
}
?>
</head>

<body>
</body>
</html>