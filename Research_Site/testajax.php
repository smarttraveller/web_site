<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script>
    $('#foo').submit(function(event){
  $.ajax({
    url: 'http://localhost/Research_Site/testajax.php',
    type: 'post',
    dataType:'html',   //expect return data as html from server
   data: $('#foo').serialize(),
   success: function(response, textStatus, jqXHR){
      $('#divID').html(response);   //select the id and put the response in the html
    },
   error: function(jqXHR, textStatus, errorThrown){
      console.log('error(s):'+textStatus, errorThrown);
   }
 });
 });
    </script>
</head>

<body>
<div id="divID">  </div>
<form id='foo' method="post" action="">
 <input type='text' name="yourname">
 <input type='submit'>
</form>
</body>
</html>