<?php require_once('Connections/smart_traveller.php'); ?>
<?php 
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
  $user_group = $_SESSION['User_UserGroup'];
  
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
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>...::: Welcome to Smart Traveller :::...</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <!--<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    
    <!--social media icons begins-->
    <link href='http://fonts.googleapis.com/css?family=Francois+One|Lato:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css-social-media-menu/style.css" />
    <!--social media icons ends-->
    
    <link rel="stylesheet" href="Sliding_login_panel_jquery/css/slide.css" type="text/css" media="screen" />
    
    <!-- jQuery - the core -->
	<script src="Sliding_login_panel_jquery/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="Sliding_login_panel_jquery/js/slide.js" type="text/javascript"></script>
	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
    
    <!--java script custom alerts begins-->
    <script type="text/javascript" src="custom_alerts/js/jquery.js"></script>
    <link rel="stylesheet" href="custom_alerts/css/alert-style.css" type="text/css" media="screen"> 
    <script type="text/javascript" src="custom_alerts/js/alert-main.js"></script>       
    <!--java script custom alerts ends-->
    
    <!--ajax post contact submit begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='contact_submit']").click(function() {

			var name = $("#name").val();	
            var senders_email = $("#senders_email").val();
            var message = $("#message").val();

            var values = "name="+name+"&senders_email="+senders_email+"&message="+message;
			if((name=="")||(senders_email=="")||(message=="")){
				alert("please fill all the fields");
			}
			else{
				$.ajax({
					type: "POST",
					url: "contact.php",
					data: values,
					success: function(){	
                        jAlert("Your contact message sucessfully sent", 'Smart Traveller');
                        //alert("Your contact message sucessfully sent");
                        $("#name").val(" ");
                        $("#senders_email").val(" ");
                        $("#message").val(" ");
				    },
                    error:function(){
                        alert("Message sent failed");
                    }     
		  
				});	
			}
			return false;
			});
		});
	</script>
    <!--ajax post contact submit ends-->
    
    <!--ajax user signup begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='signup_submit']").click(function() {
			var user_signup_details = {
				username: $("#username").val(),
				email: $("#email").val(),
				password: $("#password").val(),
				user_type: $("#user_type").val()
			};
            $.ajax({
                type: "POST",
                url: "signup.php",
                data: user_signup_details,
                success: function(data){	
                    var submit_msg_signup = JSON.parse(data);
                    //jAlert(submit_msg_signup.msg_signup, 'Smart Traveller');
                    alert(submit_msg_signup.msg_signup);
                    if(submit_msg_signup.status_signup=="true"){
                        $("#open").html('Log Out');
                        setTimeout(function(){
                            $("#username").val("");
                            $("#email").val("");
                            $("#password").val("");
                             $("#user_type").val("x")
                            $("div#panel").slideUp("slow");	
                            $("#toggle a").toggle();
                            $("#welcome_name").html(submit_msg_signup.username_signup);
                            window.location.replace(submit_msg_signup.redirect_page_signup);
                        }, 300);
                    }

                    if(submit_msg_signup.status_signup=="false"){
                        setTimeout(function(){
                        }, 300);
                    }
                },
                error:function(){
                    alert("Update failed");
                }     

            });	
			return false;
			});
		});
	</script>
    <!--ajax user signup ends-->
    
    <!--ajax user login begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='submit_user']").click(function() {
			var user_login_details = {
				log_user: $("#log_user").val(),
				pwd_user: $("#pwd_user").val()
			};
            $.ajax({
                type: "POST",
                url: "signin.php",
                data: user_login_details,
                success: function(data){	
                    var submit_msg = JSON.parse(data);
                    jAlert(submit_msg.msg, 'Smart Traveller');
                    //alert(submit_msg.msg);
                    //$("#welcome_name").html(submit_msg.username);
                    if(submit_msg.status=="true"){
                        $('#header').load('contact.php #header');
                        $('#toppanel').load('contact.php #toppanel');
                        //$("#open").html('Log Out');
                        setTimeout(function(){
                            $("#log_user").val("");
                            $("#pwd_user").val("");
                            $("div#panel").slideUp("slow");	
                            //$("#toggle a").toggle();
                        }, 300);
                    }

                    if(submit_msg.status=="false"){
                        $("#pwd_user").val("");
                    }
                },
                error:function(){
                    alert("Update failed");
                }     

            });	
			return false;
			});
		});
	</script>
    <!--ajax user login ends-->
    
    <!--ajax admin login begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='submit_admin']").click(function() {
			var admin_login_details = {
				log_admin: $("#log_admin").val(),
				pwd_admin: $("#pwd_admin").val()
			};
			/*alert($("#log_admin").val());
			alert($("#pwd_admin").val());*/
            $.ajax({
                type: "POST",
                url: "admin_pages/admin_signin.php",
                data: admin_login_details,
                success: function(data){	
                    var submit_msg_admin = JSON.parse(data);
                    jAlert(submit_msg_admin.msg_admin, 'Smart Traveller');
                    //alert(submit_msg_admin.msg_admin);
                    //$("#welcome_name").html(submit_msg_admin.username_admin);	
                    if(submit_msg_admin.status_admin=="true"){
                        $('#header').load('contact.php #header');
                        $('#toppanel').load('contact.php #toppanel');
                        //$("#open").html('Log Out');
                        setTimeout(function(){
                            $("#log_admin").val("");
                            $("#pwd_admin").val("");
                            $("div#panel").slideUp("slow");	
                            //$("#toggle a").toggle();
                        }, 300);
                    }

                    if(submit_msg_admin.status_admin=="false"){
                        setTimeout(function(){
                            $("#pwd_admin").val("");
                        }, 300);
                    }
                },
                error:function(){
                    alert("Update failed");
                }     

            });	
			return false;
			});
		});
	</script>
    <!--ajax admin login ends-->
    
    <!-- forget username, password modal begins-->
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/send_details_validate_user.js"></script>
    <script src="js/send_details_validate_admin.js"></script>
    <link rel="stylesheet" href="css/twiiter_menu.css" />
    <link rel="stylesheet" href="css/twiiter_menu_admin.css" />
    <script>
    $(document).ready(function() {
        $("#clicker_user").click(function () {
            $("#sign_box_user").toggle("slow");
        });
        $("#clicker_admin").click(function () {
            $("#sign_box_admin").toggle("slow");
        });
    });
    
    </script>
    <!-- forget username, password modal ends-->
    
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
	
	function submitform_logout()
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
    
    <!--form validation begins-->
    <script type="text/javascript">
    function validate_sender_name(){
        var sender_name = document.contact.name.value;
        if(sender_name == ""){
            document.getElementById( 'sender_name' ).innerHTML = "Invalid sender name";
            document.getElementById("name").focus();
			document.getElementById("contact_submit").disabled=true;
            /*setTimeout(function(){	
                $("#sender_name").html('');
			},1000);*/	
            return false;
        }
		else{
			document.getElementById("contact_submit").disabled=false;
			document.getElementById( 'sender_name' ).innerHTML = "&nbsp;";
			return true;
		}
    }
    function validate_sender_email(){
        var email = document.contact.senders_email.value;
        var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if((email == "")||(!email.match(emailRegex))) {
            document.getElementById( 'sender_email' ).innerHTML = "Invalid email";
            document.getElementById("senders_email").focus();
            //setTimeout(function(){	
//                $("#sender_email").html('');
//			},1000);
			document.getElementById("contact_submit").disabled=true;
            return false;
        }
		else{
			document.getElementById("contact_submit").disabled=false;
			document.getElementById( 'sender_email' ).innerHTML = "&nbsp;";
			return true;
		}
    }
    function validate_sender_message(){
        var message = document.contact.message.value;
        if(message == ""){
            document.getElementById( 'message_text' ).innerHTML = "Invalid message";
            document.getElementById("message").focus();
            //setTimeout(function(){	
//                $("#message_text").html('');
//			},1000);
			document.getElementById("contact_submit").disabled=true;
            return false;
        }
		else{
			document.getElementById("contact_submit").disabled=false;
			document.getElementById( 'message_text' ).innerHTML = "&nbsp;";
			return true;
		}
    }

    </script>
    <!--form validation ends-->
    <?php 
	if( $_POST ){
        
		$name = $_POST['name'];
		$email = $_POST['senders_email'];
		$message = $_POST['message'];
		mysql_select_db($database_smart_traveller) or die(mysql_error());
        
//		$insert_contact = mysql_query( "insert into contact_messages contact_messages ( name, email, message ) values ( '$name', '$email', '$message' )" ) or die(mysql_error());
		//if(($name!="")&&($email!="")&&($message!="")){
			$insert_contact = sprintf("insert into `contact_messages` ( name, email, message ) VALUES (%s, %s, %s)",
						   GetSQLValueString($name, "text"),
						   GetSQLValueString($email, "text"),
						   GetSQLValueString($message, "text")); 
			
			 
			$Result_insert_contact = mysql_query($insert_contact, $smart_traveller) or die(mysql_error());
		//}
		if( $Result_insert_contact ){
			echo( "<script> window.alert( 'Your contact message sucessfully sent' ); location.href = 'contact.php'; </script>" );
		}
        else{
            echo( "<script> window.alert( 'Message sent failed' ); location.href = 'contact.php'; </script>" );
        }
	}
	
	?>
    <script type="text/javascript">
	function message_text(){
		var characer_count = ( 300 - parseInt(( document.contact.message.value ).length ) -1 );
		document.getElementById( 'character_count' ).innerHTML = 'You have '+characer_count+' characters left.';
	}
    </script>
    <script type="text/javascript">
    function message_text(){
        var characer_count = ( 300 - parseInt(( document.contact.message.value ).length ));
        if(characer_count == -1){
            characer_count = 0;
        }
        document.getElementById( 'character_count' ).innerHTML = 'You have '+characer_count+' characters left.';
    }
    function textLimit(field, maxlen) {
        if (field.value.length > maxlen)
            field.value = field.value.substring(0, maxlen);
    }
    </script>
    
    <!--    sponsors rotate begins-->
    <link rel="stylesheet" type="text/css" href="css/sponsors_css">
    <!--    sponsors rotate ends-->
    
    <?php 
    if(isset($_POST['send_details_user_submit'])){
		
        $send_details_user_email = $_POST['send_details_email_user'];
        $admin_email = "info@smarttravellerlk.com";
		
        mysql_select_db($database_smart_traveller) or die(mysql_error()); 
        $user_details_get_query = mysql_query("SELECT * FROM user WHERE email='$send_details_user_email'") or die(mysql_error());
        $user_details = mysql_fetch_array( $user_details_get_query );
		
        $user_username = $user_details['username'];
		$user_password = base64_decode($user_details['password']);
		
		if($user_details_get_query){
			$email_body = "Hello this is your username & password recovery email, \n\n Your username is: ".$user_username."\n Your password is: ".$user_password."\n\nThank you. \nAdmin - http://www.smarttravellerlk.com";
			$extra_auto_reply = "From: $admin_email\r\n" . "Reply-To: $admin_email \r\n" . "X-Mailer: PHP/" . phpversion();
		
			$mail_sucess = mail( $send_details_user_email, "Login Details for Smart Traveller", $email_body, $extra_auto_reply );
		}
        if($mail_sucess){
            echo("<script>window.alert('We have sent the username and password to given email..');location.href = 'contact.php';</script>");
        }
    }
    
    if(isset($_POST['send_details_admin_submit'])){
		
        $send_details_admin_email = $_POST['send_details_email_admin'];
        $admin_email = "info@smarttravellerlk.com";
		
        mysql_select_db($database_smart_traveller) or die(mysql_error()); 
        $admin_details_get_query = mysql_query("SELECT * FROM admin WHERE email='$send_details_admin_email'") or die(mysql_error());
        $admin_details = mysql_fetch_array( $admin_details_get_query );
        
        $admin_username = $admin_details['username'];
		$admin_password = base64_decode($admin_details['password']);
		
		if($admin_details_get_query){
			$email_body = "Hello Admin this is your username & password recovery email, \n\n Your username is: ".$admin_username."\n Your password is: ".$admin_password."\n\nThank you. \nAdmin - http://www.smarttravellerlk.com";
			$extra_auto_reply = "From: $admin_email\r\n" . "Reply-To: $admin_email \r\n" . "X-Mailer: PHP/" . phpversion();
		
			$mail_sucess = mail( $send_details_admin_email, "Login Details for Smart Traveller", $email_body, $extra_auto_reply );
		}
        if($mail_sucess){
            echo("<script>window.alert('We have sent the username and password to given email..');location.href = 'contact.php';</script>");
        }
    }
    ?>
    
</head>
<body onLoad="validate_password();">
    
    <!--facebook plugin begins-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!--facebook plugin ends-->
    
<?php if($_SESSION['User_Username'] != ""){?>

<!-- Panel -->
<div id="toppanel">
	<!-- The tab on top -->	
  <div class="tab">
	<ul class="login">
			<li class="left">&nbsp;</li>
            <li id="welcome_name">Hello <?php echo(ucwords($_SESSION['User_Username']));?></li>
			<li class="sep">|</li>
			<li id="toggle">
			  <form id="myform" action="session_destroy.php" method="post">
			  <a id="open" class="open" href="javascript: submitform_logout()">Log Out</a>		  
			</form>
	  </li>
			<li class="right">&nbsp;</li>
	</ul> 
  </div>  
  <!-- / top -->
	
</div> 
<!--panel -->

<?php } ?>

<?php if($_SESSION['Admin_Username'] != ""){?>

<!-- Panel -->
<div id="toppanel">
	<!-- The tab on top -->	
  <div class="tab">
	<ul class="login">
			<li class="left">&nbsp;</li>
			<li id="welcome_name">Hello <?php echo (ucwords($_SESSION['Admin_Username']));?></li>
			<li class="sep">|</li>
			<li id="toggle">
			  <form id="myform" action="session_destroy.php" method="post">
			  <a id="open" class="open" href="javascript: submitform_logout()">Log Out</a>		  
			</form>
	  </li>
			<li class="right">&nbsp;</li>
	</ul> 
  </div>  
  <!-- / top -->
	
</div> 
<!--panel -->

<?php } ?>

<?php if(($_SESSION['User_Username'] == "") && ($_SESSION['Admin_Username'] == "")){?>
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<!-- Admin Login Form -->
				<form class="clearfix" name="admin_signin" id="admin_signin">
					<h1>Admin Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="log_admin" id="log_admin" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd_admin" id="pwd_admin" value="" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit_admin" id="submit_admin" value="Login" class="bt_login" />
					<!--<a class="lost-pwd" href="#" id="clicker">Lost your password?</a>-->
                    <div id="clicker_admin" class="lost-pwd">Lost your password?</div>
				</form>
                <div id="sign_box_admin" style="margin-top: 5px;">
                    <form method="post" action="contact.php" name="send_details_admin" id="send_details_admin" >
                        <label style="color: black">Email
                            <input type="text" name="send_details_email_admin" id="send_details_email_admin" style="background: #414141; color: white; border: none" onKeyUp="validate_email_admin();" onKeyDown="validate_email_admin();"/>
                        </label>
                        <div id="send_details_error_message_admin" style="color: red;margin-left: 40px;font-weight: bold">&nbsp;</div>
                        <input type="submit" id="send_details_admin_submit" name="send_details_admin_submit" value=" Send Details " style="margin-left: 36px; background-color: #006dcc; border: #0088cc"/>
                        <br /><br />
                    </form>
                </div>
			</div>
			<div class="left">
				<!-- User Login Form -->
				<form class="clearfix"  name="signin" id="signin">
					<h1>Member Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="log_user" id="log_user" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd_user" id="pwd_user" value="" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
                    <input type="submit" name="submit_user" id="submit_user" value="Login" class="bt_login" />
<!--					<a class="lost-pwd" href="#">Lost your password?</a>-->
                        <div id="clicker_user" class="lost-pwd">Lost your password?</div>
                </form>
                    <div id="sign_box_user" style="margin-top: 5px;">
                        <form method="post" action="contact.php" name="send_details_user" id="send_details_user" >
                            <label style="color: black">Email
                                <input type="text" name="send_details_email_user" id="send_details_email_user" style="background: #414141; color: white; border: none" onKeyUp="validate_email();" onKeyDown="validate_email();"/>
                            </label>
                            <div id="send_details_error_message_user" style="color: red;margin-left: 40px;font-weight: bold">&nbsp;</div>
                            <input type="submit" id="send_details_user_submit" name="send_details_user_submit" value=" Send Details " style="margin-left: 36px; background-color: #006dcc; border: #0088cc"/>
                            <br /><br />
                        </form>
                    </div>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form name="signup" id="signup">
					<h1>Not a member yet? Sign Up!</h1>				
					<label class="grey" for="signup">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" onClick="username_check();" />
                    <br/><br/>
                    User Type:
					<select name="user_type" id="user_type" class="field" style="background-color:#414141;color:#FFFFFF;border:none; width:138px" onChange="email_check();">
					<option value="x">Select User Type</option>
  					<option value="tourist">Tourist</option>
  					<option value="advertiser">Advertiser</option>
                    <option value="guide">Guide</option>
					</select>
                    <br/>
                    <label class="grey" for="email">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" onClick="userType_check();" />
                    <label class="grey" for="email">Confirm Password:</label>
					<input class="field" type="password" name="con_password" id="con_password" size="23" onChange="validate_password();" onClick="password_check();" />
					<label>A password will be e-mailed to you.</label>
					<input type="submit" name="signup_submit" id="signup_submit" value="Register" class="bt_register" onMouseOver="validate_password();" />
					<input type="hidden" name="MM_insert" value="signup">
                </form>
			</div>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li id="welcome_name">Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In | Register</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<?php } ?>

<?php if( $user_group == 3){?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="guide_pages/guide_update.php">Profile</a></li>
				<li><a href="gallery.php">Gallery</a></li>
                <li><a href="services.php">Services</a></li>
				<li><a href="guest_map.php">Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li class="current"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 2){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="advertiser_pages/advertiser_update.php">Profile</a></li>
                <li><a href="gallery.php">Gallery</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="guest_map.php">Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li class="current"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 1){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="tourist_pages/member_update.php">Profile</a></li>
                <li><a href="gallery.php">Gallery</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="guest_map.php">Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li class="current"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 4){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="admin_pages/admin_centre.php">Admin Centre</a></li>
                <li><a href="gallery.php">Gallery</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="guest_map.php">Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li class="current"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php }else if( $user_group == 0){ ?>
	<div id="header">
		<div>
			<a href="" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="guest_map.php">Guest Map</a></li>
				<li><a href="guestbook.php">GuestBook</a></li>
				<li class="current"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
<?php } ?>
	<div id="body">
		<!--<div id="featured">
			<h3>We are hear to help you with pleasure. Feel free to leave your feedbacks and comments.</h3>
		</div>-->
        <div id="featured">
			<div class="section">
				<iframe src="banners/customer care/index.html" style="width:375px;height:264px;max-width:100%;overflow:hidden;border:none;padding:0;margin:0;" marginheight="0" marginwidth="0"></iframe>
				<div>
					<h3 style="text-align:center; margin-right:0px">How you are feeling....? We are here to discuss with you...</h3>
					<p style="text-align:center; margin-right:0px; margin-top:-5px">
						Our 24 hour customer service is waiting to help you. We are ready to hear your problems with pleasure. Feel free to leave your feedbacks and comments.
					</p>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="contact">
<!--				<p>
					This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
				</p>-->
				<div>
					<div>
						<h3>Contact details</h3>
						<h3>Location</h3>
						<p>
							Smart Traveller(Pvt).Ltd, Union Place, Colombo 02
						</p>
						<h3>Email</h3>
						<p>
							<a href="mailto:info@smarttraveller.lk" class="email">info@smarttraveller.lk</a>
						</p>
						<h3>Call</h3>
						<p>
							+94783583368
						</p>
						<p>
							+94912259132 - hotline
						</p>
						<h3>Office open hours</h3>
						<p>
							Monday to Friday : 9AM - 5PM
						</p>
                        <p>
							24 hour hot line Customer Care 
						</p>
					</div>
                    <form  name="contact" id="contact" onSubmit="main_validate();">
						<h3>Send a Message</h3>
                        <div id="sender_name" style="margin-left: 160px; color: red; text-align: right"></div><br/>
						<label for="name"><span>Your Name:</span>
                            <input type="text" id="name" name="name"  onBlur="validate_sender_name();" onKeyUp="validate_sender_name();" onKeyDown="validate_sender_name();">
                            <div id="sender_email" style="margin-left: 160px; color: red; text-align: right"></div><br/>
						</label>
						<label for="senders_email"><span>Email Address:</span>
                            <input type="text" id="senders_email" name="senders_email" onBlur="validate_sender_email();" onKeyUp="validate_sender_email();" onKeyDown="validate_sender_email();">
                            <div id="message_text" style="margin-left: 160px; color: red; text-align: right"></div><br/>
						</label>
                        
                        <p style="text-align:right" id="character_count">You have 300 characters left.</p>
						<label for="message"><span class="message">Message:</span>
                            <textarea name="message" id="message" cols="30" rows="10" onBlur="validate_sender_message();" onKeyUp="message_text(); textLimit(this, 300);validate_sender_message();" onKeyDown="message_text(); textLimit(this, 300);validate_sender_message();"></textarea>
						</label>
						<input type="submit" id="contact_submit" name="contact_submit" value="Send message">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
        <div>
            <table border="0" cellpadding="6">
                <tr>
                    <td rowspan="3" style="text-align: left"> 
                        <p style="width:300px; height:160px; margin-top: -80px">
                            <a class="twitter-timeline" href="https://twitter.com/smarttravellk" data-widget-id="343725371054759937">Tweets by @smarttravellk</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </p>
                        <br/>
                    </td>
                    <td>
                        <div class="fb-like" data-href="http://www.facebook.com/smarttravellerlk" data-send="true" data-width="300" data-show-faces="true" data-colorscheme="dark" style="margin-top: -80px"></div>
                    </td>
                    <td rowspan="2" style="text-align: left">
                        <div class="demo" style="margin-top:-25px; margin-right:40px">
                            <ul>
                                <li><a href="https://twitter.com/smarttravellk" title="" target="_blank"><span class="icon"><i aria-hidden="true" class="icon-twitter">
                                            </i></span><span>Follow</span></a> </li>
                                <li><a href="https://plus.google.com/u/0/b/105867281715453385870/105867281715453385870/about" title="" target="_blank"><span class="icon"><i aria-hidden="true" class="icon-google-plus">
                                            </i></span><span>Add</span></a> </li>
                                <li><a href="http://www.facebook.com/smarttravellerlk" title="" target="_blank"><span class="icon"><i aria-hidden="true" class="icon-facebook">
                                            </i></span><span>Like</span> </a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- Place this tag where you want the badge to render. -->
                        <div class="g-plus" data-height="69" data-href="//plus.google.com/105867281715453385870" data-rel="publisher" data-theme="dark" style="margin-left:-300px"></div>

                        <!-- Place this tag after the last badge tag. -->
                        <script type="text/javascript">
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="color:#999; font-size:13px; font-weight:bold">Click here to download our android app <img src="images/new.gif" </p><img src="images/smart traveller logo.jpg">
                    </td>
                    <td>
                        <div class="last" style="margin-right:40px">
                            <p style="color:#999; font-size:16px; font-weight:bold">Our Sponsors</p>
                            <table width="300" border="0" cellpadding="1" cellspacing="8">
                                <tr>
                                    <td style="width:70px" class="tilt pic_trip_advisor"><img src="images/sponsors/trip advisor logo.jpg" title="Trip Advisor"></td>
                                    <td style=" width:50px" class="tilt pic"><img src="images/sponsors/airlines logo.jpg" title="Sri Lankan Air Lines"></td>
                                    <td style="text-align:left; width:50px" class="tilt pic2"><img src="images/sponsors/tourism logo.jpg" title="Sri Lankan Tourism"></td>
                                    <td style="text-align:left; width:50px" class="tilt pic_noaa"><img src="images/sponsors/noaa logo.jpg" title="NOAA"></td>
                                </tr>
                            </table>

                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <p class="footnote" style="color:#999">
            &copy; Copyright 2013 @ Smart Traveller. All rights reserved.
        </p>
    </div>
</body>
</html>