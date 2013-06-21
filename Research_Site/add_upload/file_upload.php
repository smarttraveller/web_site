<?php require_once('../Connections/smart_traveller.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
if(!empty($_REQUEST['Upload'])){
	$connect = mysql_connect($hostname_smart_traveller,$username_smart_traveller,$password_smart_traveller); 
		if (!$connect) { 
			die('Could not connect to the server <br/>' . mysql_error()); 
		}
			else
			
	$select = mysql_select_db($database_smart_traveller,$connect) or die("Could not find a DB");
}
?>
</head>

<body>
<div align="">
<form action="file_upload.php" method="post" enctype="multipart/form-data">
<label for="title"><strong>Title:</strong></label>
<input name="title" id="title" type="text" /> <br/>
<label for="description"><strong>Add description:</strong></label>
<textarea name="description" id="description" cols="20" rows="10"></textarea><br/>
<label for="resolution"><strong>Add resolution:</strong></label>
<p>
<input type="radio" name="resolution" value="320 * 240" id="320">
Fulltime
<br>
<input type="radio" name="resolution" value="240 * 60" id="240">
Parttime
<br>
</p>

<label for="file"><strong>Filename:</strong></label>
<input type="file" name="file" id="file" /><br/>
<input type="submit" name="Upload" value="Upload" id="Upload" />
</form>
</body>
</html>