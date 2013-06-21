<?php require_once('Connections/smart_traveller.php'); ?>
<?php 
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    
    <!-- stylesheets -->
  	<link rel="stylesheet" href="Sliding_login_panel_jquery/css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="Sliding_login_panel_jquery/css/slide.css" type="text/css" media="screen" />
    
    <!-- jQuery - the core -->
	<script src="Sliding_login_panel_jquery/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="Sliding_login_panel_jquery/js/slide.js" type="text/javascript"></script>
	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
    
    <!-- Rotating Adds -->
    <script src="js/rotate_add_1.js" type="text/javascript"></script>
    <script src="js/rotate_add_2.js" type="text/javascript"></script>
    <script src="js/rotate_add_3.js" type="text/javascript"></script>

	<!-- Alert Msgs -->
    <link rel="Stylesheet" href="alert_msgs/default.css" type="text/css" media="screen" />
	<link rel="Stylesheet" href="" type="text/css" media="screen" />
	<script type="text/javascript" src="alert_msgs/DOMAlert.js"></script>

    <script type="text/javascript">
	function validate_password(){
		var pass = document.getElementById("password").value;
		var con_pass = document.getElementById("con_password").value;
		if(pass!=con_pass){
			window.alert('!!! Passwords do not MATCH !!!');
			Signup.password.focus();
			return false;
		}
		else{
			
		}
	
	}
	
	function submitform()
	{
    	document.forms["myform"].submit();
	}

	</script>
    
    <!-- Alert Msgs -->
    <script type="text/javascript">
	
/*	function username_check(){
		//var username = document.signup.username.value;
		if(document.signup.username.value == ''){
			alert("Hello");
		}
	}*/

/////////////////////////////////////////////////////////////////////////////////////////
	function username_check(){
		if(document.signup.username.value == ''){
			doAlert();
		}
	}
	
	function doAlert(parent)
	{
		var msg = new DOMAlert(
		{
			title: 'Input Error',
			text: 'Username is required.',
			skin: 'default',
			width: 300,
			height: 30,
			ok: {value: true, text: 'OK', onclick: showValue},
			//cancel: {value: false, text: 'No', onclick: showValue }
		});
		msg.show();
	}
		
	function showValue(sender, value)
	{
		sender.close();
		var newMsg = new DOMAlert({skin: 'default', width: 200});
		//newMsg.show("Your response", "You pressed " + value);
	}
	
	
	
///////////////////////////////////////////////////////////////////////////
	
	function email_check(){
		if(document.signup.email.value == ''){
			doAlert_email();
		}
	}
			
	function doAlert_email(parent)
	{
		var msg_email = new DOMAlert(
		{
			title: 'Input Error',
			text: 'Email is required.',
			skin: 'default',
			width: 300,
			height: 30,
			ok: {value: true, text: 'OK', onclick: showValue},
			//cancel: {value: false, text: 'No', onclick: showValue }
		});
		msg_email.show();
	};
		
	function showValue_email(sender, value)
	{
		sender.close();
		var newMsg_email = new DOMAlert({skin: 'default', width: 200});
		//newMsg.show("Your response", "You pressed " + value);
	}
			
/////////////////////////////////////////////////////////////////////////////////////////

	function userType_check(){
		if(document.getElementById("signup").user_type.value == 'x'){
			doAlert_userType();
			
		}
	}
			
	function doAlert_userType(parent)
	{
		var msg_userType = new DOMAlert(
		{
			title: 'Input Error',
			text: 'User type is required.',
			skin: 'default',
			width: 300,
			height: 30,
			ok: {value: true, text: 'OK', onclick: showValue},
			//cancel: {value: false, text: 'No', onclick: showValue }
		});
		msg_userType.show();
	};
		
	function showValue_userType(sender, value)
	{
		sender.close();
		var newMsg_userType = new DOMAlert({skin: 'default', width: 200});
		//newMsg.show("Your response", "You pressed " + value);
	}
	
/////////////////////////////////////////////////////////////////////////////////////////

	function password_check(){
		if(document.signup.password.value == ''){
			doAlert_password();
		}
	}
			
	function doAlert_password(parent)
	{
		var msg_password = new DOMAlert(
		{
			title: 'Input Error',
			text: 'Password is required.',
			skin: 'default',
			width: 300,
			height: 30,
			ok: {value: true, text: 'OK', onclick: showValue},
			//cancel: {value: false, text: 'No', onclick: showValue }
		});
		msg_password.show();
	};
		
	function showValue_password(sender, value)
	{
		sender.close();
		var newMsg_password = new DOMAlert({skin: 'default', width: 200});
		//newMsg.show("Your response", "You pressed " + value);
	}

////////////////////////////////////////////////////////////////////////////////////
			
	</script>
    
    <?php 
	$user_group = $_SESSION['User_UserGroup'];
	?>
</head>

<body onload="validate_password();">


<?php if( $user_group == 3){?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li class="current"><a href="index.php">Home</a></li>
				<li><a href="guide_pages/guide_update.php">Profile</a></li>
                <li><a href="services.php">Services</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="guest_map.php">Guest Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 1){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li class="current"><a href="index.php">Home</a></li>
				<li><a href="tourist_pages/member_update.php">Profile</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="guest_map.php">Guest Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 0){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li class="current"><a href="index.php">Home</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="guest_map.php">Guest Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php } ?>
</body>
</html>