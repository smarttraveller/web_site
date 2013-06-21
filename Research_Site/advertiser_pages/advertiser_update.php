<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

@$_SESSION['advertiser_update_page_numload']++;
if($_SESSION['advertiser_update_page_reload_num_on_submit'] < ($_SESSION['advertiser_update_page_numload']-1)){
    unset($_SESSION['advertiser_update_message']);
}

$username = $_SESSION['User_Username'];
$user_group = $_SESSION['User_UserGroup'];

$acess_forbidden = '../index.php';
if((($_SESSION['User_UserGroup'])!="2")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
}
mysql_select_db($database_smart_traveller) or die(mysql_error()); 
	
$data = mysql_query("SELECT * FROM advertiser WHERE username='$username'") or die(mysql_error());

while($info = mysql_fetch_array( $data )){
	
	$_SESSION['User_Title'] = $info['title'];
	$_SESSION['User_Name'] = $info['name_initials'];
	$_SESSION['User_Address'] = $info['address'];
	$_SESSION['User_Telephone'] = $info['telephone'];
	$_SESSION['User_Email'] = $info['email'];
}

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
?>

<?php 
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if ( $_POST ) {
	
	$title = $_POST['title'];
	$name = $_POST['name'];
	$address = $_POST['address'];	
	$telephone = $_POST['telephone'];	
	$email = $_POST['email'];	
	$new_username = $_POST['username'];
	$new_password = base64_encode($_POST['new_password']);	
	$old_password = base64_encode($_POST['old_password']);
	
	$MM_redirectLoginSuccess = "advertiser_update.php";
 	$MM_redirectLoginFailed = "../index.php";
  	$MM_redirecttoReferrer = true;
  	mysql_select_db($database_smart_traveller, $smart_traveller);
	
    $_SESSION['advertiser_update_page_reload_num_on_submit'] = $_SESSION['advertiser_update_page_numload'];
    
	$data2 = mysql_query("SELECT password FROM user WHERE username='$username'") or die(mysql_error());
  	$info2 = mysql_fetch_array( $data2 );
	if($new_password == ""){
		$new_password = $info2['password'];
	}
	
	if($old_password != $info2['password']){
			 
			/*echo("<script>window.alert('Passwords do not Match. Please type your Old Password correctly');location.href = 'advertiser_update.php';</script>");*/
			/*echo("<script> history.back();</script>");*/
			$_SESSION['advertiser_update_message'] = "Passwords do not Match. Type Old Password correctly";	
			$arr = array('msg'=>"Passwords do not Match. Type Old Password correctly", 'status'=>"true");
            echo json_encode($arr);
            return false;
	}
	
	if( ucwords($username) != ucwords($new_username) ){
		$username_check_query = mysql_query( "SELECT username FROM user WHERE username = '$new_username'") or die( mysql_error() );
		//$result_username_check = mysql_fetch_array( $username_check_query );
		if((mysql_num_rows($username_check_query)) != 0){
			/*echo("<script>window.alert('Your new username already exists. Please try with another one.....');location.href = 'advertiser_update.php';</script>");*/
//			return false;
            /*echo("<script> history.back();</script>");*/
			$_SESSION['advertiser_update_message'] = "Your new username already exists. Please try with another one.....";	
			$arr = array('msg'=>"Your new username already exists. Please try with another one.....", 'status'=>"true");
			echo json_encode($arr);
            return false;
		}
	}
	
	/*if( $_SESSION['User_ID'] != $id_number ){
		$id_number_check_query = mysql_query( "SELECT id_number FROM guide WHERE id_number = '$id_number'") or die( mysql_error() );
		$result_id_number_check = mysql_fetch_array( $id_number_check_query );
		if(count($result_id_number_check) != 0){
			echo("<script>window.alert('Your new id number already exists. Please try with another one.....');location.href = 'guide_update.php';</script>");
		}
	}*/
	
  	$update_advertiser_query="UPDATE advertiser SET username='$new_username', password='$new_password', title='$title', name_initials='$name', address='$address', telephone='$telephone', email='$email' WHERE username='$username'"; 
   	
	$update_user_query = "UPDATE user SET username='$new_username', email='$email', password='$new_password' WHERE username='$username'";
	
  	$update_advertiser = mysql_query($update_advertiser_query, $smart_traveller) or die(mysql_error());
	
	$update_user = mysql_query($update_user_query, $smart_traveller) or die(mysql_error());

    if ($update_advertiser) {
		$_SESSION['User_Username'] = $new_username;
		$_SESSION['User_Title'] = $title;
		$_SESSION['User_Name'] = $name;
		$_SESSION['User_Address'] = $address;
		$_SESSION['User_Telephone'] = $telephone;
		$_SESSION['User_Email'] = $email;
		
		/*echo("<script>window.alert('You have successfully Updated your details.Please Signin Again...');location.href = '../session_destroy.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        $arr = array('msg'=>"success");
		echo json_encode($arr);
		return true;
 	}
    else {
		/*echo("<script>window.alert('Error..Update failed..');location.href = '../index.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        /*echo("<script> history.back();</script>");*/
        $_SESSION['advertiser_update_message'] = "Error..Update failed...";	
        $arr = array('msg'=>"Error..Update failed..", 'status'=>"true");
		echo json_encode($arr);
		return false;
  	}
}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>...::: Welcome to Smart Traveller :::...</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- validation files-->
    <link rel="stylesheet" type="text/css" href="validations/messages.css" />
    <script type="text/javascript" src="validations/advertiser_validation.js"></script>
    <!-- /validation files-->
    <script type="text/javascript" src="../bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    
    <!--social media icons begins-->
    <link href='http://fonts.googleapis.com/css?family=Francois+One|Lato:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css-social-media-menu/style.css" />
    <!--social media icons ends-->
    
    <!-- stylesheets -->
  	<link rel="stylesheet" href="../Sliding_login_panel_jquery/css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="../Sliding_login_panel_jquery/css/slide.css" type="text/css" media="screen" />
    
    <!-- jQuery - the core -->
	<!--<script src="../Sliding_login_panel_jquery/js/jquery-1.3.2.min.js" type="text/javascript"></script>-->
	<!-- Sliding effect -->
	<script src="../Sliding_login_panel_jquery/js/slide.js" type="text/javascript"></script>
	<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
    
    <!--java script custom alerts begins-->
    <script type="text/javascript" src="../custom_alerts/js/jquery.js"></script>
    <link rel="stylesheet" href="../custom_alerts/css/alert-style.css" type="text/css" media="screen"> 
    <script type="text/javascript" src="../custom_alerts/js/alert-main.js"></script>       
    <!--java script custom alerts ends-->
    
    <!--ajax post advertiser update begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='submit']").click(function() {
			var advertiser_details = {
				title: $("#title").val(),	
				name: $("#name").val(),
				address: $("#address").val(),
				telephone: $("#telephone").val(),
				email: $("#email").val(),
				username: $("#username").val(),
				new_password: $("#new_password").val(),
				old_password: $("#old_password").val()
			};
            $.ajax({
                type: "POST",
                url: "advertiser_update.php",
                data: advertiser_details,
                success: function(data){	
                    var submit_msg = JSON.parse(data);
                    if(submit_msg.msg=="success"){
                        //jAlert("You have successfully Updated password and details.Please Signin again with new account details...", 'Smart Traveller');
                        alert("You have successfully Updated password and details.Please Signin again with new account details...");
                        window.location.replace("../session_destroy.php");
                    }
                    else{
                        $("#advertiser_update_messages").html(submit_msg.msg);
                        if(submit_msg.status){
                            setTimeout(function(){
                                $("#advertiser_update_messages").html('');				
                                $("#modal_advertiser").modal('hide');
                                $("#old_password").val(" ");
                            }, 1000);
                        }
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
    <!--ajax post advertiser update ends-->
    
    <!-- Alert Msgs -->
    <link rel="Stylesheet" href="../alert_msgs/default.css" type="text/css" media="screen" />
	<link rel="Stylesheet" href="" type="text/css" media="screen" />
	<script type="text/javascript" src="../alert_msgs/DOMAlert.js"></script>
    
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
    
<!--form update password error function begins-->
<script type="text/javascript">
    function update_error(){

        setTimeout(function(){	
            $("#advertiser_update_message").hide();
		},1000);   
        
        validate_password();
    }
</script>
<!--form update password error function ends-->     

<!--    sponsors rotate begins-->
<link rel="stylesheet" type="text/css" href="../css/sponsors_css">
<!--    sponsors rotate ends-->
        
</head>
<body onLoad="update_error();">

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
    
<?php if ($_SESSION['User_Username'] != "") { ?>

    <!-- Panel -->
    <div id="toppanel">
    	<!-- The tab on top -->	
      <div class="tab">
    	<ul class="login">
    			<li class="left">&nbsp;</li>
    			<li style="padding-top: 10px">Hello <?php echo(ucwords($_SESSION['User_Username'])); ?></li>
    			<li class="sep">|</li>
    			<li id="toggle">
    			  <form id="myform" action="../session_destroy.php" method="post">
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

<?php if ($_SESSION['Admin_Username'] != "") { ?>

    <!-- Panel -->
    <div id="toppanel">
    	<!-- The tab on top -->	
      <div class="tab">
    	<ul class="login">
    			<li class="left">&nbsp;</li>
                <li style="padding-top: 10px">Hello <?php echo (ucwords($_SESSION['Admin_Username'])); ?></li>
    			<li class="sep">|</li>
    			<li id="toggle">
    			  <form id="myform" action="../session_destroy.php" method="post">
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

<?php if (($_SESSION['User_Username'] == "") && ($_SESSION['Admin_Username'] == "")) { ?>
    <!-- Panel -->
    <div id="toppanel">
    	<div id="panel">
    		<div class="content clearfix">
    			<div class="left">
    				<!-- Admin Login Form -->
    				<form class="clearfix" action="../admin_pages/admin_signin.php" method="POST" name="admin_signin" id="admin_signin">
    					<h1>Admin Login</h1>
    					<label class="grey" for="log">Username:</label>
    					<input class="field" type="text" name="log" id="log" value="" size="23" />
    					<label class="grey" for="pwd">Password:</label>
    					<input class="field" type="password" name="pwd" id="pwd" size="23" />
    	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
            			<div class="clear"></div>
    					<input type="submit" name="submit" value="Login" class="bt_login" />
    					<a class="lost-pwd" href="#">Lost your password?</a>
    				</form>
    			</div>
    			<div class="left">
    				<!-- User Login Form -->
    				<form class="clearfix" action="../signin.php" method="POST" name="signin" id="signin">
    					<h1>Member Login</h1>
    					<label class="grey" for="log">Username:</label>
    					<input class="field" type="text" name="log" id="log" value="" size="23" />
    					<label class="grey" for="pwd">Password:</label>
    					<input class="field" type="password" name="pwd" id="pwd" size="23" />
    	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
            			<div class="clear"></div>
    					<input type="submit" name="submit" value="Login" class="bt_login" />
    					<a class="lost-pwd" href="#">Lost your password?</a>
    				</form>
    			</div>
    			<div class="left right">			
    				<!-- Register Form -->
    				<form action="../signup.php" method="POST" name="signup" id="signup">
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
    					<input class="field" type="text" name="password" id="password" size="23" onClick="userType_check();" />
                        <label class="grey" for="email">Confirm Password:</label>
    					<input class="field" type="text" name="con_password" id="con_password" size="23" onChange="validate_password();" onClick="password_check();" />
    					<label>A password will be e-mailed to you.</label>
    					<input type="submit" name="submit" value="Register" class="bt_register" onMouseOver="validate_password();" />
    					<input type="hidden" name="MM_insert" value="signup">
                    </form>
    			</div>
    		</div>
    </div> <!-- /login -->	

    	<!-- The tab on top -->	
    	<div class="tab">
    		<ul class="login">
    			<li class="left">&nbsp;</li>
    			<li style="padding-top: 10px">Hello Guest!</li>
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

<?php if ($user_group == 3) { ?>
    	<div id="header">
    		<div>
    			<a href="" id="logo"><img src="../images/logo.png" alt="Logo"></a>
    			<ul>
    				<li><a href="../index.php">Home</a></li>
    				<li class="current"><a href="../guide_pages/guide_update.php">Profile</a></li>
    				<li><a href="../gallery.php">Gallery</a></li>
                    <li><a href="../services.php">Services</a></li>
    				<li><a href="../guest_map.php">Map</a></li>
    				<li><a href="../guestbook.php">GuestBook</a></li>
    				<li><a href="../contact.php">Contact</a></li>
    			</ul>
    		</div>
    	</div>
<?php } else if ($user_group == 2) { ?>
    	<div id="header">
    		<div>
    			<a href="" id="logo"><img src="../images/logo.png" alt="Logo"></a>
    			<ul>
    				<li><a href="../index.php">Home</a></li>
    				<li class="current"><a href="advertiser_update.php">Profile</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
    				<li><a href="../services.php">Services</a></li>
    				<li><a href="../guest_map.php">Map</a></li>
    				<li><a href="../guestbook.php">GuestBook</a></li>
    				<li><a href="../contact.php">Contact</a></li>
    			</ul>
    		</div>
    	</div>
<?php } else if ($user_group == 1) { ?>
    	<div id="header">
    		<div>
    			<a href="" id="logo"><img src="../images/logo.png" alt="Logo"></a>
    			<ul>
    				<li><a href="../index.php">Home</a></li>
    				<li class="current"><a href="../tourist_pages/member_update.php">Profile</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
    				<li><a href="../services.php">Services</a></li>
    				<li><a href="../guest_map.php">Map</a></li>
    				<li><a href="../guestbook.php">GuestBook</a></li>
    				<li><a href="../contact.php">Contact</a></li>
    			</ul>
    		</div>
    	</div>
<?php } else if ($user_group == 4) { ?>
    	<div id="header">
    		<div>
    			<a href="" id="logo"><img src="../images/logo.png" alt="Logo"></a>
    			<ul>
    				<li><a href="../index.php">Home</a></li>
    				<li><a href="../admin_pages/admin_centre.php">Admin Centre</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
    				<li><a href="../services.php">Services</a></li>
    				<li><a href="../guest_map.php">Map</a></li>
    				<li><a href="../guestbook.php">GuestBook</a></li>
    				<li><a href="../contact.php">Contact</a></li>
    			</ul>
    		</div>
    	</div>
<?php } else if ($user_group == 0) { ?>
    	<div id="header">
    		<div>
    			<a href="" id="logo"><img src="../images/logo.png" alt="Logo"></a>
    			<ul>
    				<li><a href="../index.php">Home</a></li>
    				<li class="current"><a href="../services.php">Services</a></li>
    				<li><a href="../gallery.php">Gallery</a></li>
    				<li><a href="../guest_map.php">Guest Map</a></li>
    				<li><a href="../guestbook.php">GuestBook</a></li>
    				<li><a href="../contact.php">Contact</a></li>
    			</ul>
    		</div>
    	</div>
<?php } ?>

	<div id="body">
		<div id="featured">
			<iframe src="profile banner/index.html" style="width:936px;height:230px;max-width:100%;overflow:hidden;border:none;padding:0;margin:0 auto;display:block;" marginheight="0" marginwidth="0"></iframe>
		</div>
		<div id="content">
			<div id="register">
				<h3>Upload your profile here</h3>
				<p>
					Please upload your profile details here. Please provide very accurate details. Because we use these deails to contact you regarding the advertisements you are publishing.
				</p>
				<div>
				  <form action="advertiser_update.php" name="advertiser_update" id="advertiser_update" method="post" onSubmit="main_validate();">
                    	<label for="title"><span>Title:</span>
                        <select name="title" id="title" onChange="validate_title();">
                          <option value="X">Select Title</option>
                          <option value="Mr" <?php echo ( $_SESSION['User_Title'] == "Mr" ? 'selected="selected"': ''); ?> >Mr</option>
                          <option value="Mrs" <?php echo ( $_SESSION['User_Title'] == "Mrs" ? 'selected="selected"': ''); ?> >Mrs</option>
                          <option value="Miss" <?php echo ( $_SESSION['User_Title'] == "Miss" ? 'selected="selected"': ''); ?> >Miss</option>
                        </select>
                        </label>
						<label for="name"><span>Name with Initials:</span>
							<input type="text" id="name" name="name" value="<?php if(($_SESSION['User_Name'])==""){echo "";} else{ echo $_SESSION['User_Name'];}?>" onBlur="validate_name();">
						</label>
                        <label for="address"><span>Address:</span>
							<input type="text" id="address" name="address" value="<?php if(($_SESSION['User_Address'])==""){echo "";} else{ echo $_SESSION['User_Address'];}?>" onBlur="validate_address();">
						</label>
					</label>
                        <label for="telephone"><span>Telephone No:</span>
							<input type="text" id="telephone" name="telephone" value="<?php if(($_SESSION['User_Telephone'])=="0"){echo "";} else{ echo $_SESSION['User_Telephone'];}?>" onBlur="validate_telephone();">
						</label>
						<label for="email"><span>Email:</span>
							<input type="text" id="email" name="email" value="<?php if(($_SESSION['User_Email'])==""){echo "";} else{ echo $_SESSION['User_Email'];}?>" onBlur="validate_email();">
						</label>
            			<label for="username"><span>Preferred Username:</span>
							<input type="text" id="username" name="username" value="<?php if(($_SESSION['User_Username'])==""){echo "";} else{ echo $_SESSION['User_Username'];}?>" onBlur="validate_username();">
						</label>
                        <label for="new_password"><span>New Password:</span>
							<input type="password" id="new_password" name="new_password" value="">
						</label>
                        <label for="confirm_new_password"><span>Confirm New Password:</span>
                            <input type="password" id="confirm_new_password" name="confirm_new_password" value="" onKeyUp="validate_password_match();">
						</label>
                         <!--<label for="old_password"><span>Old Password:</span>
							<input type="text" id="old_password" name="old_password" value="">
						</label>-->
						<!--<label for="message"><span class="message">Message:</span>
							<textarea name="message" id="message" cols="30" rows="10"></textarea>
						</label>-->
						<!--<input type="submit" id="submit" name="submit" value="Update Info">-->
                        <!-- Button to trigger modal -->
                        <a href="#modal_advertiser" role="button" class="btn btn-info" data-toggle="modal" style="margin-left: 175px" onMouseOver="main_validate();">Continue</a>                        

                        <!-- Modal Begins -->
                        <div id="modal_advertiser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header" style="background-color:#B8C4CF; color: #000"> 
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Provide your old password here..</h3>
                            </div>
                            <div class="modal-body" style="background-color: #B8C4CF; color: #000">
                                <label for="old_password"><span>Old Password:</span>
                                    <input type="password" id="old_password" name="old_password" value="" onBlur="validate_old_password();" onKeyUp="validate_password_match();">
                                </label>
                                <div id="advertiser_update_messages" style="color: red; font-size: 14px; font-weight: bold; padding-left: 40px; padding-top: 0px"></div>
                                <input type="submit" id="submit" name="submit" value="Update Profile">
                            </div>
                        </div>
                        <!-- Modal Ends -->
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
                        <p style="color:#999; font-size:13px; font-weight:bold">Click here to download our android app <img src="../images/new.gif" </p><img src="../images/smart traveller logo.jpg">
                    </td>
                    <td>
                        <div class="last" style="margin-right:40px">
                            <p style="color:#999; font-size:16px; font-weight:bold">Our Sponsors</p>
                            <table width="300" border="0" cellpadding="1" cellspacing="8">
                                <tr>
                                    <td style="width:70px" class="tilt pic_trip_advisor"><img src="../images/sponsors/trip advisor logo.jpg" title="Trip Advisor"></td>
                                    <td style=" width:50px" class="tilt pic"><img src="../images/sponsors/airlines logo.jpg" title="Sri Lankan Air Lines"></td>
                                    <td style="text-align:left; width:50px" class="tilt pic2"><img src="../images/sponsors/tourism logo.jpg" title="Sri Lankan Tourism"></td>
                                    <td style="text-align:left; width:50px" class="tilt pic_noaa"><img src="../images/sponsors/noaa logo.jpg" title="NOAA"></td>
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

    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:750px">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <br/>
        </div>
        <div class="modal-body">
            <iframe src="image_upload/upload_crop_v1.2.php" scrolling="no" width="700px" height="600px" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</body>
</html>