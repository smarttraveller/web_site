<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if($_SESSION['travel_plan_active_tab2']==""){
  $_SESSION['travel_plan_active_tab1'] = "active";  
}

@$_SESSION['travel_plan_page_numload']++;
if($_SESSION['travel_plan_page_reload_num_on_submit'] < ($_SESSION['travel_plan_page_numload']-1)){
    unset($_SESSION['travel_plan_submit_message']);
    unset($_SESSION['travel_plan_update_message']);
    unset($_SESSION['travel_plan_delete_message']);
}
if(isset($_SESSION['travel_plan_update_message'])){
	unset($_SESSION['travel_plan_delete_message']);
}
if(isset($_SESSION['travel_plan_delete_message'])){
	unset($_SESSION['travel_plan_update_message']);
}

$username = $_SESSION['User_Username'];
$user_group = $_SESSION['User_UserGroup'];

$acess_forbidden = '../index.php';
if((($_SESSION['User_UserGroup'])!="1")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
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

if ( $_POST ) {
    
    $_SESSION['travel_plan_active_tab1'] = "active";
    unset($_SESSION['travel_plan_active_tab2']);
    
	$destination = $_POST['destination'];	
	$start_date = $_POST['CalendarForm_travel_plan_start_date'];	
	$end_date = $_POST['CalendarForm_travel_plan_end_date'];
	$contact_number = $_POST['contact_number'];
	$plan_status = 0;
	
    $_SESSION['travel_plan_page_reload_num_on_submit'] = $_SESSION['travel_plan_page_numload'];
    
	$MM_redirectLoginSuccess = "travel_plan.php";
 	$MM_redirectLoginFailed = "travel_plan.php";
  	$MM_redirecttoReferrer = true;
  	mysql_select_db($database_smart_traveller, $smart_traveller);
	
		
	$plan_submit_query = "insert into travel_plan ( username, destination, start_date, end_date, contact_number, plan_status) value ( '$username', '$destination', '$start_date', '$end_date', '$contact_number', '$plan_status' )";

	$plan_submit = mysql_query($plan_submit_query, $smart_traveller) or die(mysql_error());
	
	
    if ($plan_submit) {

		/*echo("<script>window.alert('You have successfully submitted your travel plan');location.href = 'travel_plan.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        /*echo("<script> history.back();</script>");*/
        $_SESSION['travel_plan_submit_message'] = "You have successfully submitted your travel plan";
		$arr_submit_plan = array('msg'=>"You have successfully submitted your travel plan");
        echo json_encode($arr_submit_plan);
        return true;
 	}
    else {
		/*echo("<script>window.alert('Error..Submit failed..');location.href = 'travel_plan.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
      /*echo("<script> history.back();</script>");*/
        $_SESSION['travel_plan_submit_message'] = "Error..Submit failed..";
		$arr_submit_plan = array('msg'=>"Error..Submit failed..");
		echo json_encode($arr_submit_plan);
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
    <!--calendar scripts begins-->
    <script language="javascript" src="../js/cal2.js"></script>
	<script language="javascript" src="../js/cal_conf2.js"></script>
    <!--calendar scripts ends-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    <!-- validation files-->
    <link rel="stylesheet" type="text/css" href="validations/messages.css" />
    <script type="text/javascript" src="validations/travel_plan_validation.js"></script>
    <script type="text/javascript" src="validations/travel_plan_edit_validation.js"></script>
    <!-- /validation files-->
    
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
    
    <!--ajax post travel plan begins-->
    <script type="text/javascript">
		$(function() {
		$("input[id^='submit']").click(function() {
			var travel_plan_details = {
				destination: $("#destination").val(),	
				CalendarForm_travel_plan_start_date: $("#CalendarForm_travel_plan_start_date").val(),
				CalendarForm_travel_plan_end_date: $("#CalendarForm_travel_plan_end_date").val(),
				contact_number: $("#contact_number").val()
			};

            $.ajax({
                type: "POST",
                url: "travel_plan.php",
                data: travel_plan_details,
                success: function(data){	
                    var submit_msg = JSON.parse(data);
                    $("#travel_plan_submit_messages").html(submit_msg.msg);
                    setTimeout(function(){
                    	$("#travel_plan_submit_messages").html('');		
                    }, 1000);
					$("#destination").val(" ");
					$("#CalendarForm_travel_plan_start_date").val(" ");
					$("#CalendarForm_travel_plan_end_date").val(" ");
					$("#contact_number").val(" ");
                },
                error:function(){
                    alert("Update failed");
                }     

            });	
			return false;
			});
		});
	</script>
    <!--ajax post travel plan ends-->
    
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
    
    <script type="text/javascript">
		function max_add_error(){
			window.alert('Maximum number of advertisements is 5. Please delete one of below and try again...'); location.reload();	
		}
    </script>
<!--    travel plan submit error function begins
	<script type="text/javascript">
		function update_error(){
	
			setTimeout(function(){	
				$("#submit_error").hide();
			},1000);   
			
			validate_password();
		}
	</script>
    travel plan submit error function ends  -->

    <!--    sponsors rotate begins-->
    <link rel="stylesheet" type="text/css" href="../css/sponsors_css">
    <!--    sponsors rotate ends-->

    <!--form update password error function begins-->
    <script type="text/javascript">
        function update_error(){

            setTimeout(function(){	
                $("#travel_plan_submit_message").hide();
            },600);   
            
            setTimeout(function(){	
                $("#travel_plan_update_message").hide();
            },600);
            
            setTimeout(function(){	
                $("#travel_plan_delete_message").hide();
            },600);

            validate_password();
        }
    </script>
<!--form update password error function ends-->

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
    				<li><a href="member_update.php">Profile</a></li>
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
			<iframe src="banners/new banner/index.html" style="width:936px;height:230px;max-width:100%;overflow:hidden;border:none;padding:0;margin:0 auto;display:block;" marginheight="0" marginwidth="0"></iframe>
		</div>
        <div id="content">
            <div class="tabbable" style="margin-left:200px; margin-right:200px"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs" id="travel_plan">
                    <li class="<?php echo $_SESSION['travel_plan_active_tab1'];?>"><a href="#tab1" data-toggle="tab">Travel Plan Submit</a></li>
                    <li class="<?php echo $_SESSION['travel_plan_active_tab2'];?>"><a href="#tab2" data-toggle="tab">Edit your Travel Plan</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?php echo $_SESSION['travel_plan_active_tab1'];?>" id="tab1">
                      
                        <div id="register">
                            <h3>Submit your travel plan here</h3>
                            <p>
                                Please be kind enough to submit your correct details. So we can arrange your travel plan very sucessfully. If you submit incorrect details we will delete your plan without any notice. 
                            </p>
                            <div id='travel_plan_submit_messages' style="color: red; font-size: 14px; font-weight: bold; padding-left: 50px; padding-top: 10px"></div>
                            <div>
                                <form name="travel_plan_submit" id="travel_plan_submit" onSubmit="return main_validate_travel_plan();">
                                    <label for="destination"><span>Where you want to go:</span>
                                        <input type="text" id="destination" name="destination" value="" onBlur="validate_destination();">
                                    </label>
                                    <label for="start_date"><span>Start Date:</span>
                                        <input type="text" id="CalendarForm_travel_plan_start_date" name="CalendarForm_travel_plan_start_date" value="" onChange="validate_start_date();"> <a href="javascript:showCal('Calendar_travel_plan_start')" style="text-decoration:none; font-size:15px">&nbsp;<b>Select Date</b></a>
                                    </label>
                                    <label for="end_date"><span>End Date:</span>
                                        <input type="text" id="CalendarForm_travel_plan_end_date" name="CalendarForm_travel_plan_end_date" value="" onChange="validate_end_date();"> <a href="javascript:showCal('Calendar_travel_plan_end')" style="text-decoration:none; font-size:15px">&nbsp;<b>Select Date</b></a>
                                    </label>
                                    <label for="contact_number"><span>Contact Number:</span>
                                        <input type="text" id="contact_number" name="contact_number" value="" onBlur="validate_telephone();" onKeyUp="validate_telephone();">
                                    </label>
                                    <input type="submit" id="submit" name="submit" value="Submit Plan" onMouseOver="return  main_validate_travel_plan();">
                                </form>
                            </div>
                        </div> <!--// register-->
                         
                    </div> <!--// tab 1-->
                    
                    <div class="tab-pane <?php echo $_SESSION['travel_plan_active_tab2'];?>" id="tab2">
                        <div id="register">
                            <h3>Edit your travel plan here</h3>
                            <p>
                                Check whether your travel plan is assigned for a guide. If it already assigned you can't edit your plan. Please contact us in such case. Contact guide using the given number if you are not contacted yet. 
                            </p>
                            <div id='travel_plan_update_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 80px; padding-top: 10px; padding-bottom: 0px;"><?php echo $_SESSION['travel_plan_update_message']; ?></div>
                            <div id='travel_plan_delete_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 80px; padding-top: 10px; padding-bottom: 10px; "><?php echo $_SESSION['travel_plan_delete_message']; ?></div>
                        </div> <!--//register-->
                        	
						<?php 
                            $plans = mysql_query( "SELECT * FROM travel_plan where username = '$username'" ) or die( mysql_error() );
                            $i = 0;
                        ?>
                        <p style="text-align:left">
                            <!--<hr>-->
                            <!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px">
                                Your advertisements are listed below. Maximum 5 allowed. Please delete unnecessary, expired advertisements inorder to post new ones.
                                <br/><br/>
                            </p>-->
                            <table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                                <tr>
                                    <td style="color:#F00; font-size:14px">Plan Name</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            <?php while( $row_plans = mysql_fetch_array( $plans )) {
								$guide_user_name = $row_plans['assigned_guide'];
								$guide_name_query = mysql_query( "SELECT name_initials, telephone FROM guide WHERE username='$guide_user_name'" ) or die( mysql_error() );
								$row_guide_name = mysql_fetch_array( $guide_name_query );
                                $i++;
                            ?>
                            <table width="700" border="0" cellpadding="5" cellspacing="5" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                                <tr>
                                    <td width="150px"><?php echo $row_plans['destination']; ?></td>
                                    <td class="pull-left" width="60px">
                                        <a href="#myModal<?php echo $i; ?>" id="<?php echo $row_plans['id']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">Edit</a>
                                    </td>
                                    <form name="delete_plan" id="delete_plan" action="services/delete_plan.php" method="post">
                                    <td class="pull-left">
                                        <input type="hidden" id="plan_id" name="plan_id" value="<?php echo $row_plans['id']; ?>">
                                        <input type="submit" id="delete_plan" name="delete_plan" value="Delete" class="btn-danger"> 
                                    </td>
                                    </form>
                                </tr>
                            </table>
                    
                            <!-- Modal -->
                            <div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel">Edit your travel plan here....</h3>
                                </div> <!--modal-header-->
                                
                                <div class="modal-body">
                                	<?php if($row_guide_name['name_initials'] != null) {?>
                                    	<div style="color:#000"> Sorry this plan is already assigned for a travel guide. You can't edit it now. Please contact us for any issues. Sorry for any inconvenience... <br/><br/>
                                        </div>
                                    <?php } ?>
                                    <form name="travel_plan_edit" id="travel_plan_edit" action="services/update_plan.php" method="post">
                                        <label for="destination"><span>Change Place:</span>
                                            <input type="text" id="edit_destination" name="edit_destination" value="<?php echo $row_plans['destination']; ?>"style="color:#F00; margin-left:68px" <?php if($row_guide_name['name_initials'] != null) {?> disabled <?php } ?> onBlur="validate_edit_destination();">
                                        </label>
                                        <label for="start_date"><span>Change Start Date:</span>
                                            <input type="text" id="CalendarForm_travel_plan_edit_start_date" name="CalendarForm_travel_plan_edit_start_date" value="<?php echo $row_plans['start_date']; ?>" style="color:#F00; margin-left:39px" <?php if($row_guide_name['name_initials'] != null) {?> disabled <?php } ?> placeholder="2013/06/08" onBlur="validate_edit_start_date();"> <b>Format: YYYY/MM/DD</b>
                                        </label>
                                        <label for="end_date"><span> Change End Date:</span>
                                            <input type="text" id="CalendarForm_travel_plan_edit_end_date" name="CalendarForm_travel_plan_edit_end_date" value="<?php echo $row_plans['end_date']; ?>" style="color:#F00; margin-left:43px" <?php if($row_guide_name['name_initials'] != null) {?> disabled <?php } ?> onBlur="validate_edit_end_date();"> <b>Format: YYYY/MM/DD</b>
                                        </label>
                                        <label for="contact_number"><span>Change Contact Number:</span>
                                            <input type="text" id="edit_contact_number" name="edit_contact_number" value="<?php echo $row_plans['contact_number']; ?>" style="color:#F00" <?php if($row_guide_name['name_initials'] != null) {?> disabled <?php } ?> onBlur="validate_edit_telephone();">
                                        </label>
                                        <label for="assigned_guide"><span>Assigned Guide:</span>
                                            <input type="text" id="assigned_guide" name="assigned_guide" value="<?php if($row_guide_name['name_initials'] != null ){ echo $row_guide_name['name_initials'];} else { ?> Guide is not yet assigned <?php } ?>" style="color:#F00; margin-left:56px" disabled>
                                        </label>
                                        <?php if($row_guide_name['name_initials'] != null) {?>
                                        <label for="guide_contact_number"><span>Guide Contact Number:</span>
                                            <input type="text" id="guide_contact_number" name="guide_contact_number" value="<?php echo $row_guide_name['telephone']; ?>" style="color:#F00; margin-left:11px"" disabled >
                                        </label>
                                        <?php } ?>
                                        <input type="hidden" id="edit_plan_id" name="edit_plan_id" value="<?php echo $row_plans['id']; ?>">
                                        <?php if($row_guide_name['name_initials'] == null) {?>
                                        <input type="submit" id="update_plan" name="update_plan" value="Update Plan" class="btn btn-primary" style="margin-left:160px" onMouseOver="main_validate_edit_travel_plan();">
                                        <?php } ?>
                                    </form>
                                </div> <!--modal-body-->
                                
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div> <!--modal-footer-->
                            </div>  
                            <!-- Modal Ends -->   
                     
                            <?php } ?>     
                        </p>
                        
                    </div> <!--// tab 2-->
                    
                </div> <!--// tab-content-->
                
            </div> <!--end of tab section-->
        
        </div> <!--// content-->
    </div> <!--// body-->

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