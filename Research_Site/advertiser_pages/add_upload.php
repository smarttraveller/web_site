<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

@$_SESSION['add_upload_page_numload']++;
if($_SESSION['add_upload_page_reload_num_on_submit'] < ($_SESSION['add_upload_page_numload']-1)){
    unset($_SESSION['add_upload_message']);
    unset($_SESSION['add_update_message']);
    unset($_SESSION['add_delete_message']);
}

$username = $_SESSION['User_Username'];
$acess_forbidden = '../index.php';
if((($_SESSION['User_UserGroup'])!="2")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
}

if(($_SESSION['active_tab2']=="")){
    $_SESSION['active_tab1'] = "active" ;
}

mysql_select_db($database_smart_traveller) or die(mysql_error()); 

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

$add_count_query = mysql_query( "SELECT * FROM advertisements WHERE username='$username'" ) or die( mysql_error() );
$total_ads = mysql_num_rows($add_count_query);
$_SESSION['add_count'] = $total_ads;

if (isset($_POST['submit'])) {

    $_SESSION['active_tab1'] = "active";
    unset($_SESSION['active_tab2']);
    
	$add_category = $_POST['category'];	
	$add_title = $_POST['add_title'];	
	$add_descriptiton = $_POST['add_descriptiton'];
	$add_links = $_POST['add_links'];
	$add_telephone = $_POST['add_telephone'];
	$cost_per_item = $_POST['cost'];
	$star_level = $_POST['star_level'];
	
	$MM_redirectLoginSuccess = "add_upload.php";
 	$MM_redirectLoginFailed = "add_upload.php";
  	$MM_redirecttoReferrer = true;
  	mysql_select_db($database_smart_traveller, $smart_traveller);
    
    $_SESSION['add_upload_page_reload_num_on_submit'] = $_SESSION['add_upload_page_numload'];
	
	$data2 = mysql_query("SELECT password FROM user WHERE username='$username'") or die( mysql_error() );
  	$info2 = mysql_fetch_array( $data2 );

	$time_stamp = $_SESSION['time_stamp'];
	if($time_stamp==""){
		echo("<script> history.back();</script>");
		$_SESSION['add_upload_message'] = "Please upload a picture for the advertisement";	
		return false;
	}
	$add_count_query = mysql_query( "SELECT * FROM advertisements WHERE username='$username'" ) or die( mysql_error() );
	$total_ads = mysql_num_rows($add_count_query);
	if( $total_ads  > 4 ){
		
		echo("<script>window.alert('Maximum number of advertisements is 5. Please delete one in Edit Tab and try again...');location.href = 'add_upload.php';</script>");
		return false;
	}
	else{
		
		$add_post_query = "update advertisements set username = '$username', add_category = '$add_category', add_title = '$add_title', add_description = '$add_descriptiton', telephone = '$add_telephone', links = '$add_links', cost_per_item = '$cost_per_item', star_level = '$star_level' where time_stamp = '$time_stamp'";
	
  		$add_post = mysql_query($add_post_query, $smart_traveller) or die(mysql_error());
	}
	
    if ($add_post) {

		unset($_SESSION['time_stamp']);
		/*echo("<script>window.alert('You have successfully posted your add');location.href = 'add_upload.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
		$_SESSION['add_upload_message'] = "You have successfully posted your advertisement";	
		return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Update failed..');location.href = 'add_upload.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
		$_SESSION['add_upload_message'] = "Error..Update failed..";	
		return false;
  	}
}

if(isset($_POST['update_add'])){
	
    $_SESSION['active_tab2'] = "active";
    unset($_SESSION['active_tab1']);
    
	$add_category = $_POST['category'];	
	$add_title = $_POST['add_title'];	
	$add_descriptiton = $_POST['add_descriptiton'];
	$add_links = $_POST['add_links'];
	$time_stamp = $_POST['time_stamp'];
	$cost_per_item = $_POST['cost'];
	$star_level = $_POST['star_level'];
	$add_telephone = $_POST['add_telephone'];
    
    $_SESSION['add_upload_page_reload_num_on_submit'] = $_SESSION['add_upload_page_numload'];
    
	//$_SESSION['time_stamp'] = $time_stamp;
    if(($add_category=="Hotels")||($add_category=="Restaurants")){
        $is_empty_fields = ($add_category=="X")||($add_title=="")||($add_descriptiton=="")||($add_links=="")||($add_telephone=="")||($cost_per_item=="")||($star_level=="0");
    }
    else{
        $is_empty_fields = ($add_category=="X")||($add_title=="")||($add_descriptiton=="")||($add_links=="")||($add_telephone=="")||($cost_per_item=="");
    }
    if($is_empty_fields){
        echo("<script>window.alert('Please fill all the fields');</script>");
    }
    else{
        $add_update_query = "update advertisements set add_category = '$add_category', add_title = '$add_title', add_description = '$add_descriptiton', links = '$add_links', telephone = '$add_telephone', cost_per_item = '$cost_per_item', star_level = '$star_level' where time_stamp = '$time_stamp'";

        $add_update = mysql_query($add_update_query, $smart_traveller) or die(mysql_error());

        if ($add_update) {

            unset($_SESSION['time_stamp']);
            /*echo("<script>window.alert('You have successfully updated your add');location.href = 'add_upload.php';</script>");*/
            echo("<script> history.back();</script>");
            $_SESSION['add_update_message'] = "You have successfully updated your advertisement";	
            return false;
          //header("Location: " . $MM_redirectLoginSuccess );
        }
        else {
            /*echo("<script>window.alert('Error..Update failed..');location.href = 'add_upload.php';</script>");*/
          //header("Location: ". $MM_redirectLoginFailed );
            echo("<script> history.back();</script>");
            $_SESSION['add_update_message'] = "Error..Update failed..";	
            return false;
        }
    }
}

if(isset($_POST['delete_add'])){
	
    $_SESSION['active_tab2'] = "active";
    unset($_SESSION['active_tab1']);
    
	$time_stamp = $_POST['time_stamp'];
    
    $_SESSION['add_upload_page_reload_num_on_submit'] = $_SESSION['add_upload_page_numload'];
    
	$add_delete_query = "delete from advertisements where time_stamp = '$time_stamp'";
	
	$add_delete = mysql_query($add_delete_query, $smart_traveller) or die(mysql_error());

    if ($add_delete) {

		unset($_SESSION['time_stamp']);
		/*echo("<script>window.alert('You have successfully deleted your add');location.href = 'add_upload.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['add_delete_message'] = "You have successfully deleted your add";	
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'add_upload.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['add_delete_message'] = "Error..Delete failed...";	
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
	<script src="../Sliding_login_panel_jquery/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="../Sliding_login_panel_jquery/js/slide.js" type="text/javascript"></script>
	<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
    
    <!-- Alert Msgs -->
    <link rel="Stylesheet" href="../alert_msgs/default.css" type="text/css" media="screen" />
	<link rel="Stylesheet" href="" type="text/css" media="screen" />
	<script type="text/javascript" src="../alert_msgs/DOMAlert.js"></script>
    
    <!-- validation files-->
    <link rel="stylesheet" type="text/css" href="validations/messages.css" />
    <script type="text/javascript" src="validations/add_upload_validation.js"></script>
    <script type="text/javascript" src="validations/add_edit_validation.js"></script>
    <!-- /validation files-->
    
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
    
    <script type="text/javascript">
		function max_add_error(){
			window.alert('Maximum number of advertisements is 5. Please delete one of below and try again...'); location.reload();	
		}
    </script>
    <!--form update password error function begins-->
	<script type="text/javascript">
		function update_error(){
	
			setTimeout(function(){	
				$("#add_upload_message").hide();
			},1000);  
            
            setTimeout(function(){	
				$("#add_update_message").hide();
			},1000);  
            
            setTimeout(function(){	
				$("#add_delete_message").hide();
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
    			<li>Hello Guest!</li>
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
    				<li><a href="../guide_pages/guide_update.php">Profile</a></li>
    				<li><a href="../gallery.php">Gallery</a></li>
                    <li class="current"><a href="../services.php">Services</a></li>
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
    				<li><a href="../advertiser_pages/advertiser_update.php">Profile</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
    				<li class="current"><a href="../services.php">Services</a></li>
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
    				<li><a href="../tourist_pages/member_update.php">Profile</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
    				<li class="current"><a href="../services.php">Services</a></li>
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
    				<li class="current"><a href="../services.php">Services</a></li>
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
			<iframe src="banner/index.html" style="width:936px;height:230px;max-width:100%;overflow:hidden;border:none;padding:0;margin:0 auto;display:block;" marginheight="0" marginwidth="0"></iframe>
		</div>
		<div id="content">
        	
            <div class="tabbable" style="margin-left:200px; margin-right:200px"> <!-- Only required for left/right tabs -->
  				<ul class="nav nav-tabs">
    				<li class="<?php echo $_SESSION['active_tab1'];?>"><a href="#tab1" data-toggle="tab">Post Advertisements</a></li>
    				<li class="<?php echo $_SESSION['active_tab2'];?>"><a href="#tab2" data-toggle="tab">Edit Advertisements</a></li>
 				</ul>
 				<div class="tab-content">
    				<div class="tab-pane <?php echo $_SESSION['active_tab1'];?>" id="tab1">
      					<div id="register">
                            <h3>Submit your advertisement here</h3>
                            <p>
                                Please be kind enough to post valid, necessary advertisements. Specially consider about the advertisement content. If your advertisement is noe suitable or outdated it will be deleted with out any notice.
                            </p>
                            <p style="text-align:left; font-weight:200; color:#0F0; font-size:15px">
                				 Maximum number of advertisements allowed is 5. Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/>
                			</p>
                            <div id='add_upload_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 175px; padding-top: 10px"><?php echo $_SESSION['add_upload_message']; ?></div>
                            <br/>
                            <div style="margin-left: 60px">
                                <span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*&nbsp;</span><span style="font-size: 16px; font-weight: bold; color: yellow">Mandatory Fields</span>
                            </div>
                            <br/>
                            <div>
                                <form action="add_upload.php" name="add_upload" id="add_upload" method="post" onSubmit="main_validate_advertisement();">
                                    <label for="add_category"><span>Add Category:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <select name="category" id="category" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onChange="max_add_error();" <?php } ?> onChange="validate_advertisement_category();">
                                            <option value="X">Select Category</option>
                                            <option value="Clothing">Clothing</option>
                                            <option value="Antiques">Antiques</option>
                                            <option value="Books">Books</option>
                                            <option value="Travel & Hospitality">Travel & Hospitality</option>
                                            <option value="Beauty & Healthcare">Beauty & Healthcare</option>
                                            <option value="Immigration">Immigration</option>
                                            <option value="Medical">Medical</option>
                                            <option value="Transport">Transport</option>
                                            <option value="Sports">Sports</option>
                                            <option value="Elephants and Wild Life Safari">IT & Computing</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Hotels">Hotels</option>
                                            <option value="Restaurants">Restaurants</option>
                                            <option value="Photography/Vediography">Photography/Vediography</option>
                                            <option value="Vehicle Renting">Vehicle Renting</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </label>
                                    <label for="add_title"><span>Add Title:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <input type="text" id="add_title" name="add_title" value="" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onKeyDown="max_add_error();" <?php } ?> onBlur="validate_advertisement_title();">
                                    </label>
                                    <label for="add_descriptiton"><span class="institute">Add Description:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                      <textarea name="add_descriptiton" id="add_descriptiton" cols="20" rows="10" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onKeyDown="max_add_error();" <?php } ?> onBlur="validate_advertisement_description();"></textarea>
                                    </label>
                                    <label for="#myModal"><span>Add Image:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                    	<input type="hidden" id="add_image" name="add_image" value="<?php echo $_SESSION['time_stamp']; ?>">
                                        <a href="#myModal" role="button" class="btn" data-toggle="modal" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onClick="max_add_error();" <?php } ?>>Clik here to select image</a>
                                    </label>
                                    <label for="add_links"><span>Add Lnks:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <input type="text" id="add_links" name="add_links" value="" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onKeyDown="max_add_error();" <?php } ?> onBlur="validate_advertisement_links();">
                                    </label>
                                    <label for="telephone"><span>Telephone No:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <input type="text" id="add_telephone" name="add_telephone" value="" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onKeyDown="max_add_error();" <?php } ?> onBlur="validate_advertisement_telephone();">
                                    </label>
                                    <label for="cost"><span>Cost (Rs.):<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <input type="text" id="cost" name="cost" placeholder="per item / person" value="" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onKeyDown="max_add_error();" <?php } ?> onBlur="validate_advertisement_cost();">
                                    </label>
                                    <label for="star_level"><span>Star level (hotels & <b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b> restaurants):</span>
                                        <select name="star_level" id="star_level" <?php if( intval( $_SESSION['add_count'] ) > 4 ){?> onChange="max_add_error();" <?php } ?> onChange="validate_advertisement_star();">
                                            <option value="0">Select Star Level</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </label>
                                    <input type="submit" id="submit" name="submit" value="Post Advertisement" onMouseOver="main_validate_advertisement();">
                                </form>
                            </div>
						</div> <!--// register-->
    				</div> <!--//tab1-->
    				<div class="tab-pane <?php echo $_SESSION['active_tab2'];?>" id="tab2">
      					<div id="register">
                            <h3>Edit your advertisement here</h3>
                            <p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>
                        </div> <!--//register-->
                        
                        <?php 
							$ads = mysql_query( "SELECT username, add_category, add_title, add_description, add_image, links, telephone, time_stamp, cost_per_item, star_level FROM advertisements where username = '$username'" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/>
                			</p>
                            <div id='add_update_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 140px; padding-top: -30px"><?php echo $_SESSION['add_update_message'];?></div>
                            <div id='add_delete_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 140px; padding-top: -30px"><?php echo $_SESSION['add_delete_message'];?></div>
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Add Title</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_ads = mysql_fetch_array( $ads )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="150px"><?php echo $row_ads['add_title']; ?></td>
                                    <td class="pull-left" width="60px">
                                        <a href="#myModal<?php echo $i; ?>" id="<?php echo $row_ads['time_stamp']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">Edit</a>
                                    </td>
                                    <form name="add_delete" id="add_delete" action="add_upload.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="time_stamp" name="time_stamp" value="<?php echo $row_ads['time_stamp']; ?>">
                                            <input type="submit" id="delete_add" name="delete_add" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel">Edit your advertisement here....</h3>
                                </div>
                                <div class="modal-body">
                                    <div style="margin-left: 20px">
                                        <span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*&nbsp;</span><span style="font-size: 16px; font-weight: bold">Mandatory Fields</span>
                                    </div>
                                    <br/>
                                    <form action="add_upload.php" name="update_add" id="update_add" method="post" onSubmit="main_validate_edit_advertisement();">
                                        <label for="add_category"><span>Change Category:</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <select name="category" id="category" style="margin-left:30px" onChange="validate_advertisement_edit_category();">
                                                <option value="X" <?php if($row_ads['add_category']=='X'){?> selected <?php } ?>>Select Category</option>
                                                <option value="Clothing" <?php if($row_ads['add_category']=='Clothing'){?> selected <?php } ?>>Clothing</option>
                                                <option value="Antiques" <?php if($row_ads['add_category']=='Antiques'){?> selected <?php } ?>>Antiques</option>
                                                <option value="Books" <?php if($row_ads['add_category']=='Books'){?> selected <?php } ?>>Books</option>
                                                <option value="Travel & Hospitality" <?php if($row_ads['add_category']=='Travel & Hospitality'){?> selected <?php } ?>>Travel & Hospitality</option>
                                                <option value="Beauty & Healthcare" <?php if($row_ads['add_category']=='Beauty & Healthcare'){?> selected <?php } ?>>Beauty & Healthcare</option>
                                                <option value="Immigration" <?php if($row_ads['add_category']=='Immigration'){?> selected <?php } ?>>Immigration</option>
                                                <option value="Medical" <?php if($row_ads['add_category']=='Medical'){?> selected <?php } ?>>Medical</option>
                                                <option value="Transport" <?php if($row_ads['add_category']=='Transport'){?> selected <?php } ?>>Transport</option>
                                                <option value="Sports" <?php if($row_ads['add_category']=='Sports'){?> selected <?php } ?>>Sports</option>
                                                <option value="Elephants and Wild Life Safari" <?php if($row_ads['add_category']=='Elephants and Wild Life Safari'){?> selected <?php } ?>>IT & Computing</option>
                                                <option value="Entertainment" <?php if($row_ads['add_category']=='Entertainment'){?> selected <?php } ?>>Entertainment</option>
                                                <option value="Hotels" <?php if($row_ads['add_category']=='Hotels'){?> selected <?php } ?>>Hotels</option>
                                                <option value="Restaurants" <?php if($row_ads['add_category']=='Restaurants'){?> selected <?php } ?>>Restaurants</option>
                                                <option value="Photography/Vediography" <?php if($row_ads['add_category']=='Photography/Vediography'){?> selected <?php } ?>>Photography/Vediography</option>
                                                <option value="Vehicle Renting" <?php if($row_ads['add_category']=='Vehicle Renting'){?> selected <?php } ?>>Vehicle Renting</option>
                                                <option value="other" <?php if($row_ads['add_category']=='other'){?> selected <?php } ?>>Other</option>
                                            </select>
                                        </label>
                                        <label for="add_title"><span>Change Title:</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <input type="text" id="add_title" name="add_title" value="<?php echo $row_ads['add_title']; ?>" style="margin-left:60px" onBlur="validate_advertisement_edit_title();">
                                        </label>
                                        <label for="add_descriptiton"><span class="institute">Change Description:</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <textarea name="add_descriptiton" id="add_descriptiton" cols="30" rows="10" style="margin-left:15px; width:370px" onBlur="validate_advertisement_edit_description();"><?php echo $row_ads['add_description']; ?></textarea>
                                        </label>
                                        <label for="current_image"><span>Your Image:</span>
                                        <img src="add_pics/<?php echo $row_ads['add_image']; ?>" style="margin-left:78px"/>
                                        </label>
                                        <label for="add_links"><span>Change Lnks:</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <input type="text" id="add_links" name="add_links" value="<?php echo $row_ads['links']; ?>" style="margin-left:55px" onBlur="validate_advertisement_edit_links();">
                                        </label>
                                        <label for="telephone"><span>Telephone No:<b style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</b></span>
                                        <input type="text" id="add_telephone" name="add_telephone" value="<?php echo $row_ads['telephone']; ?>" style="margin-left:55px" onBlur="validate_advertisement_edit_telephone();">
                                    </label>
                                        <label for="cost"><span>Cost per item/person(Rs):</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <input type="text" id="cost" name="cost" value="<?php echo $row_ads['cost_per_item']; ?>" style="width:186px" onBlur="validate_advertisement_edit_cost();">
                                   	 	</label>
                                        <?php if(( $row_ads['add_category'] == 'Hotels' )||( $row_ads['add_category'] == 'Restaurants' )){?>
                                    	<label for="star_level"><span>Star level</span><span style="color: #F00; font-size: 18px; font-weight: bold">&nbsp;*</span>
                                            <select name="star_level" id="star_level" style="margin-left:86px" onChange="validate_advertisement_edit_star()">;
                                      			<option value="0" <?php if($row_ads['star_level']=='0'){?> selected <?php } ?> >Select Star Level</option>
                                          		<option value="1" <?php if($row_ads['star_level']=='1'){?> selected <?php } ?> >1 Star</option>
                                          		<option value="2" <?php if($row_ads['star_level']=='2'){?> selected <?php } ?> >2 Star</option>
                                          		<option value="3" <?php if($row_ads['star_level']=='3'){?> selected <?php } ?> >3 Star</option>
                                          		<option value="4" <?php if($row_ads['star_level']=='4'){?> selected <?php } ?> >4 Star</option>
                                          		<option value="5" <?php if($row_ads['star_level']=='5'){?> selected <?php } ?> >5 Star</option>
                                    		</select>
                                    	</label>
                                        <?php } ?>
                                        <label for="hidden_field">
                                            <input type="hidden" id="time_stamp" name="time_stamp" value="<?php echo $row_ads['time_stamp']; ?>" style="margin-left:55px">
                                        </label>
                                        <input type="submit" id="update_add" name="update_add" value="Update Add" style="margin-left:150px" class="btn-success" onMouseOver="main_validate_edit_advertisement();">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         <!-- Modal Ends -->   
                         
                         <?php } ?>     
            		</p>
    				</div> <!--//tab2-->
  				</div> <!--//tab content-->
			</div> <!--//tab section-->

		</div> <!--//content-->
        
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
    <!-- Modal Ends -->
</body>
</html>