<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="stylesheet" href="css/jquery-ui-modal.css" />
<script src="js/username_password_send_modal.js"></script>
</head>

<body>
    <div id="dialog-form" title="Receive Login Details" style="font-size: 62.5%">
        <p class="validateTips">Please provide your email. We will sent you username and password again...</p>
        <form>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
        </form>
    </div>

    <button id="create-user" style="background:none; border:none; height:20px; font-size:10px; text-decoration:underline">Create new user</button>
</body>
</html>