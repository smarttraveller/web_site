<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function LaunchApp() {
    netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
    var file = Components.classes["@mozilla.org/file/local;1"]
    .createInstance(Components.interfaces.nsILocalFile);
    file.initWithPath("http://localhost/Research_Site/panorma/Adisham3.exe");
    file.launch();
}
</script>

<!--<script type="text/javascript"> 

function LaunchApp() {
 

if (!document.all) {
 

  alert ("This ActiveXObject is only available for Internet Explorer");
 

  return;
 

}
 

var ws = new ActiveXObject("WScript.Shell");
 

ws.Exec("http://localhost/Research_Site/panorma/Adisham3.exe");
 

}
 
</script>-->

</head>

<body>
<a href="javascript:LaunchApp()">Click here to Execute your file</a>

<!--<a href="javascript:LaunchApp()">Click here to Execute your file</a>-->


</body>
</html>