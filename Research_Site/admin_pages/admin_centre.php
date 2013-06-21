<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

@$_SESSION['thispageidnumload']++;
if($_SESSION['page_reload_num_on_submit'] < ($_SESSION['thispageidnumload']-1)){
    unset($_SESSION['message_delete_contact']);
    unset($_SESSION['admin_update_error']);
    unset($_SESSION['message_delete_travel_plan']);
    unset($_SESSION['message_assign_guide']);
    unset($_SESSION['message_delete_advertisement']);
    unset($_SESSION['message_delete_advertiser']);
    unset($_SESSION['message_delete_guide']);
    unset($_SESSION['message_delete_tourist']);
	unset($_SESSION['reply_sent_message']);
}

$username = $_SESSION['Admin_Username'];
$user_group = $_SESSION['User_UserGroup'];
$email = $_SESSION['Admin_email'];
if(($_SESSION['active_tab2']=="")&&($_SESSION['active_tab3']=="")&&($_SESSION['active_tab4']=="")&&
   ($_SESSION['active_tab5']=="")&&($_SESSION['active_tab6']=="")&&($_SESSION['active_tab7']=="")){
    $_SESSION['active_tab1'] = "active" ;
}

$acess_forbidden = '../index.php';
if((($_SESSION['Admin_Username'])=="")&&(($_SESSION['User_UserGroup'])!="4")){
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

if(isset($_POST['delete_guide'])){
	
    $_SESSION['active_tab2'] = "active";
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);

    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$guide_username = $_POST['guide_username'];
	$guide_delete_query = "delete from guide where username = '$guide_username'";
	$guide_user_delete_query = "delete from user where username = '$guide_username'";
	
	$guide_delete = mysql_query($guide_delete_query, $smart_traveller) or die(mysql_error());
	$guide_user_delete = mysql_query($guide_user_delete_query, $smart_traveller) or die(mysql_error());

    if ($guide_delete && $guide_user_delete) {

		/*echo("<script>window.alert('You have successfully deleted that guide');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_guide'] = "You have successfully deleted the guide"." ".$guide_username;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_guide'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['delete_tourist'])){
    
    $_SESSION['active_tab1'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$tourist_username = $_POST['tourist_username'];
	$tourist_delete_query = "delete from tourist where username = '$tourist_username'";
	$tourist_delete_user_query = "delete from user where username = '$tourist_username'";
	
	$tourist_delete = mysql_query($tourist_delete_query, $smart_traveller) or die(mysql_error());
	$tourist_user_delete = mysql_query($tourist_delete_user_query, $smart_traveller) or die(mysql_error());

    if ($tourist_delete && $tourist_user_delete) {

		/*echo("<script>window.alert('You have successfully deleted that tourist');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_tourist'] = "You have successfully deleted the tourist"." ".$tourist_username;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_tourist'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['delete_advertiser'])){
	
    $_SESSION['active_tab3'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);
    
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$advertiser_username = $_POST['advertiser_username'];
	$advertiser_delete_query = "delete from advertiser where username = '$advertiser_username'";
	$advertiser_user_delete_query = "delete from user where username = '$advertiser_username'";
	
	$advertiser_delete = mysql_query($advertiser_delete_query, $smart_traveller) or die(mysql_error());
	$advertiser_user_delete = mysql_query($advertiser_user_delete_query, $smart_traveller) or die(mysql_error());

    if ($advertiser_delete && $advertiser_user_delete) {

		/*echo("<script>window.alert('You have successfully deleted that advertiser');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_advertiser'] = "You have successfully deleted the advertiser"." ".$advertiser_username;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_advertiser'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['delete_advertisement'])){
    
    $_SESSION['active_tab4'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$advertisement_timestamp = $_POST['advertisement_timestamp'];
	$advertisement_delete_query = "delete from advertisements where time_stamp = '$advertisement_timestamp'";
	
	$advertisement_delete = mysql_query($advertisement_delete_query, $smart_traveller) or die(mysql_error());

    if ($advertisement_delete) {

		/*echo("<script>window.alert('You have successfully deleted that advertisement');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_advertisement'] = "You have successfully deleted that advertisement";
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_advertisement'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['delete_contact'])){
    
    $_SESSION['active_tab6'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$contact_id = $_POST['contact_id'];
	$contact_delete_query = "delete from contact_messages where id = '$contact_id'";
	
	$contact_delete = mysql_query($contact_delete_query, $smart_traveller) or die(mysql_error());

    if ($contact_delete) {

		/*echo("<script>window.alert('You have successfully deleted that contact');location.href = 'admin_centre.php';</script>");*/
      //header("Location: " . $MM_redirectLoginSuccess );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_contact'] = "You have successfully deleted that contact message"." ".$contact_id;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_contact'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['assign_guide'])){
	
    $_SESSION['active_tab5'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab7']);
    
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$travel_plan_id = $_POST['travel_plan_id'];
    $assign_guide_name = $_POST['guide_list'];
    $current_assign_guide_query = mysql_query("select assigned_guide from travel_plan where id = '$travel_plan_id'") or die(mysql_error());
	$current_assign_guide = mysql_fetch_array( $current_assign_guide_query );
    $current_assign_guide_name = $current_assign_guide['assigned_guide'];
//    if($current_assign_guide_name != $assign_guide_name){
        
        $assign_guide_query = "update travel_plan set assigned_guide = '$assign_guide_name', plan_status = 1 where id = '$travel_plan_id'";
        $assign_guide = mysql_query($assign_guide_query, $smart_traveller) or die(mysql_error());
        
        $update_new_guide_avaialability = "update guide set availability = 0 where username = '$assign_guide_name'";
        $new_guide_avaialability = mysql_query($update_new_guide_avaialability, $smart_traveller) or die(mysql_error());
        
        $update_old_guide_avaialability = "update guide set availability = 1 where username = '$current_assign_guide_name'";
        $old_guide_avaialability = mysql_query($update_old_guide_avaialability, $smart_traveller) or die(mysql_error());
        
        if ($assign_guide && $new_guide_avaialability && $old_guide_avaialability) {

            /*echo("<script>window.alert('You have successfully assigned guide for plan');location.href = 'admin_centre.php';</script>");*/
        //header("Location: " . $MM_redirectLoginSuccess );
            echo("<script> history.back();</script>");
            $_SESSION['message_assign_guide'] = "You have successfully assigned guide for plan" . " " . $travel_plan_id;
            return false;
        }
        else {
            /*echo("<script>window.alert('Error..Guide assign failed..');location.href = 'admin_centre.php';</script>");*/
          //header("Location: ". $MM_redirectLoginFailed );
            echo("<script> history.back();</script>");
            $_SESSION['message_assign_guide'] = "Error..Guide assign failed...";
            return false;
        }
//    }
}

if(isset($_POST['delete_travel_plan'])){
    
    $_SESSION['active_tab5'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
	$plan_id = $_POST['travel_plan_id'];
	$travel_plan_delete_query = "delete from travel_plan where id = '$plan_id'";
	
	$travel_plan_delete = mysql_query($travel_plan_delete_query, $smart_traveller) or die(mysql_error());

    if ($travel_plan_delete) {
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_travel_plan'] = "You have successfully deleted the tavel plan"." ".$plan_id;
        return false;
 	}
    else {
		/*echo("<script>window.alert('Error..Delete failed..');location.href = 'admin_centre.php';</script>");*/
      //header("Location: ". $MM_redirectLoginFailed );
        echo("<script> history.back();</script>");
        $_SESSION['message_delete_travel_plan'] = "Error..Delete failed..";
        return false;
  	}
}

if(isset($_POST['reply_submit'])){
	$contact_id = $_POST['contact_id'];
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$messsage_admin = $_POST['reply_text'];
	$admin_email = "info@smarttravellerlk.com";
	
	$_SESSION['active_tab6'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab3']);
    unset($_SESSION['active_tab7']);
	
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
	
	$email_body = "Hello $contact_name, \n".$messsage_admin."\nThank you. \n\nAdmin - http://www.smarttravellerlk.com";
	$extra_auto_reply = "From: $admin_email\r\n" . "Reply-To: $admin_email \r\n" . "X-Mailer: PHP/" . phpversion();
	
	$mail_sucess = mail( $contact_email, "Auto Reply - Re: $contact_name", $email_body, $extra_auto_reply );
	
	if($mail_sucess){
		echo("<script> history.back();</script>");
        $_SESSION['reply_sent_message'] = "Reply sucessfully sent via Email for Message"." ".$contact_id;
        return true;
	}
}

if(isset($_POST['update_admin'])) {

    $_SESSION['active_tab7'] = "active";
    unset($_SESSION['active_tab2']);
    unset($_SESSION['active_tab1']);
    unset($_SESSION['active_tab4']);
    unset($_SESSION['active_tab5']);
    unset($_SESSION['active_tab6']);
    unset($_SESSION['active_tab3']);
    
    $_SESSION['page_reload_num_on_submit'] = $_SESSION['thispageidnumload'];
    
    $new_admin_username = $_POST['admin_new_username'];
    $new_admin_email = $_POST['admin_new_email'];
    $new_admin_password = base64_encode($_POST['admin_new_password']);
    $confirm_new_admin_password = base64_encode($_POST['admin_confirm_password']);
    $old_admin_password = base64_encode($_POST['admin_old_password']);

    $admin_old_details_query = mysql_query("SELECT password, email FROM admin WHERE username='$username'") or die(mysql_error());
    $admin_old_details = mysql_fetch_array($admin_old_details_query);

    if ($new_admin_username == "") {
        $new_admin_username = $admin_old_details['username'];
    }
    if ($new_admin_email == "") {
        $new_admin_email = $admin_old_details['email'];
    }
    if ($new_admin_password == "") {
        $new_admin_password = $admin_old_details['password'];
        $confirm_new_admin_password = $admin_old_details['password'];
    }
    
    if ($old_admin_password != $admin_old_details['password']) {
        echo("<script> history.back();</script>");
        $_SESSION['admin_update_error'] = "Passwords do not Match. Type Old Password correctly";
        return false;
        /*echo("<script> 
        alert('Passwords do not Match. Type Old Password correctly...');
        return false;
        </script>")*/;
    }

    if (($new_admin_password == $confirm_new_admin_password) && ($old_admin_password == $admin_old_details['password'])) {

        $update_admin_query = "UPDATE admin SET username='$new_admin_username', password='$new_admin_password', email = '$new_admin_email' WHERE username='$username'";
        $update_admin = mysql_query($update_admin_query, $smart_traveller) or die(mysql_error());
    }

    if ($update_admin) {
        echo("<script>window.alert('You have successfully Updated your details.Please Signin Again...');location.href = '../session_destroy.php';</script>");
    }
}

?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html><head>
	<meta charset="UTF-8">
	<title>...::: Welcome to Smart Traveller :::...</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    
    <!-- validation files-->
    <link rel="stylesheet" type="text/css" href="validations/messages.css" />
    <script type="text/javascript" src="validations/admin_validation.js"></script>
    <!-- /validation files-->
    
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
    
<!--    form update password error function begins-->
    <script type="text/javascript">
        function update_error(){

            setTimeout(function(){	
                $("#admin_update_message").hide();
            },300);   
            
            setTimeout(function(){	
                $("#contact_delete_message").hide();
            },300);
			
			setTimeout(function(){	
                $("#reply_sent_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#travel_plan_delete_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#guide_assign_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#advertisement_delete_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#advertiser_delete_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#guide_delete_message").hide();
            },300);
            
            setTimeout(function(){	
                $("#tourist_delete_message").hide();
            },300);
            
            validate_password();
        }
    </script>
<!--    form update password error function ends -->

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
                    <li>Hello <?php echo(ucwords($_SESSION['User_Username'])); ?></li>
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
                        <form class="clearfix" action="admin_signin.php" method="POST" name="admin_signin" id="admin_signin">
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
                    <li><a href="../advertiser_pages/advertiser_update.php">Profile</a></li>
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
                    <li><a href="../tourist_pages/member_update.php">Profile</a></li>
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
                    <li class="current"><a href="admin_centre.php">Admin Centre</a></li>
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
                    <li><a href="../services.php">Services</a></li>
                    <li><a href="../gallery.php">Gallery</a></li>
                    <li><a href="../guest_map.php">Guest Map</a></li>
                    <li><a href="../guestbook.php">GuestBook</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div id="body">
		<!--<div id="featured">
			<h3>This is just a place holder, so you can see what the site would look like. You can replace all this text with your own text.</h3>
		</div>-->
		<div id="content">
        	
            <div class="tabbable" style="margin-left:200px; margin-right:200px"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs" id="admin_tab">
    				<li class="<?php echo $_SESSION['active_tab1'];?>"><a href="#tab1" data-toggle="tab">Tourist List</a></li>
    				<li class="<?php echo $_SESSION['active_tab2'];?>"><a href="#tab2" data-toggle="tab">Guide List</a></li>
                    <li class="<?php echo $_SESSION['active_tab3'];?>"><a href="#tab3" data-toggle="tab">Advertiser List</a></li>
                    <li class="<?php echo $_SESSION['active_tab4'];?>"><a href="#tab4" data-toggle="tab">Advertisement List</a></li>
                    <li class="<?php echo $_SESSION['active_tab5'];?>"><a href="#tab5" data-toggle="tab">Travel Plan List</a></li>
                    <li class="<?php echo $_SESSION['active_tab6'];?>"><a href="#tab6" data-toggle="tab">Contact Messages List</a></li>
                    <li class="<?php echo $_SESSION['active_tab7'];?>"><a href="#tab7" data-toggle="tab">Admin Profile</a></li>
 				</ul>
 				<div class="tab-content">
    				<div class="tab-pane <?php echo $_SESSION['active_tab1'];?>" id="tab1">
      					<div id="register">
                            <h3>Currently registered tourists....</h3>
                            <div id='tourist_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_tourist']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$tourist_select_query = mysql_query( "SELECT * FROM tourist" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Tourist Name </td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_tourists = mysql_fetch_array( $tourist_select_query )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="150px"><?php echo $row_tourists['name_initials']; ?></td>
                                    <td class="pull-left" width="100px">
                                        <a href="#myModal<?php echo $i; ?>" id="<?php echo $row_tourists['username']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Tourist</a>
                                    </td>
                                    <form name="tourist_delete" id="tourist_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                        <input type="hidden" id="tourist_username" name="tourist_username" value="<?php echo $row_tourists['username']; ?>">
                                        <input type="submit" id="delete_tourist" name="delete_tourist" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel"><?php echo $row_tourists['title'].". ".$row_tourists['name_initials']."'s "; ?>Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="tourist_info" id="tourist_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Title:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_tourists['title']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Name with initials:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['name_initials']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Email:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['email']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Gender:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['gender']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Address:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['address']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Telephone:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['telephone']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Nationality:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['nationality']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Country:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_tourists['country']; ?></b></td>
                                      		</tr>
                                    	</table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                        	<!-- Modal Ends -->   
                         
                        	 <?php } ?>     
            			</p>
    				</div> <!--//tab1-->
    				<div class="tab-pane <?php echo $_SESSION['active_tab2'];?>" id="tab2">
      					<div id="register">
                            <h3>Currently registered travel guides....</h3>
                            <div id='guide_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_guide']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$guides_select_query = mysql_query( "SELECT * FROM guide" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Guide Name (On Badge)</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_guides = mysql_fetch_array( $guides_select_query )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="150px"><?php echo $row_guides['name_badge']; ?></td>
                                    <td class="pull-left" width="100px">
                                        <a href="#myModal_guide<?php echo $i; ?>" id="<?php echo $row_guides['username']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Guide</a>
                                    </td>
                                    <form name="guide_delete" id="guide_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="guide_username" name="guide_username" value="<?php echo $row_guides['username']; ?>">
                                            <input type="submit" id="delete_guide" name="delete_guide" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal_guide<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel"><?php echo $row_guides['title'].". ".$row_guides['name_initials']."'s "; ?>Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="guide_info" id="guide_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Title:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_guides['title']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Name with initials:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['name_initials']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Name on badge:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['name_badge']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Gender:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['gender']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Address:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['address']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Telephone:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['telephone']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Email:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['email']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Date of birth:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['dob']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">ID number:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['id_number']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Nationality:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['nationality']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Trained institutes:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['institutes']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Qualifications:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['qualification_1']. " ". $row_guides['qualification_2']. " ". $row_guides['qualification_3']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Interested Category:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['category']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Employment type:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_guides['emp_type']; ?></b></td>
                                      		</tr>
                                    	</table>
                                        <table width="200" border="0" class="pull-right" style="margin-top:-300px">
                                        	<tr>
                                        		<td><img src="../guide_pages/profile_pics/<?php echo $row_guides['profile_pic']; ?>" /></td>
                                      		</tr>
                                    	</table>
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
                    
                    <div class="tab-pane <?php echo $_SESSION['active_tab3'];?>" id="tab3">
      					<div id="register">
                            <h3>Currently registered advertisers....</h3>
                            <div id='advertiser_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_advertiser']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$advertiser_select_query = mysql_query( "SELECT * FROM advertiser" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Advertiser Name</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_advertiser = mysql_fetch_array( $advertiser_select_query )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="150px"><?php echo $row_advertiser['name_initials']; ?></td>
                                    <td class="pull-left" width="120px">
                                        <a href="#myModal_advertiser<?php echo $i; ?>" id="<?php echo $row_advertiser['username']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Advertiser</a>
                                    </td>
                                    <form name="advertiser_delete" id="advertiser_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="advertiser_username" name="advertiser_username" value="<?php echo $row_advertiser['username']; ?>">
                                            <input type="submit" id="delete_advertiser" name="delete_advertiser" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal_advertiser<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel"><?php echo $row_advertiser['title'].". ".$row_advertiser['name_initials']."'s "; ?>Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="advertiser_info" id="advertiser_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Title:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_advertiser['title']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Name with initials:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertiser['name_initials']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Address:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertiser['address']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Telephone:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertiser['telephone']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Email:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertiser['email']; ?></b></td>
                                      		</tr>
                                    	</table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         	<!-- Modal Ends -->   
                         
                         	<?php } ?>     
            			</p>
    				</div> <!--//tab3-->
                    
                    <div class="tab-pane <?php echo $_SESSION['active_tab4'];?>" id="tab4">
      					<div id="register">
                            <h3>Currently posted advertisements....</h3>
                            <div id='advertisement_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_advertisement']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$advertisement_select_query = mysql_query( "SELECT * FROM advertisements" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Advertisement Name</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_advertisement = mysql_fetch_array( $advertisement_select_query )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="150px"><?php echo $row_advertisement['add_title']; ?></td>
                                    <td class="pull-left" width="150px">
                                        <a href="#myModal_advertisement<?php echo $i; ?>" id="<?php echo $row_advertisement['time_stamp']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Advertisement</a>
                                    </td>
                                    <form name="advertisement_delete" id="advertisement_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="advertisement_timestamp" name="advertisement_timestamp" value="<?php echo $row_advertisement['time_stamp']; ?>">
                                            <input type="submit" id="delete_advertisement" name="delete_advertisement" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal_advertisement<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel"><?php echo $row_advertisement['add_title']." advertisement "; ?>Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="advertisement_info" id="advertisement_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Title:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_advertisement['add_title']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Category:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['add_category']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Description:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['add_description']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Links:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['links']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Votes:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['votes']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Cost per item / person (Rs.):</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['cost_per_item']; ?></b></td>
                                      		</tr>
                                            <?php if(( $row_advertisement['add_category'] == 'Hotels' )||( $row_advertisement['add_category'] == 'Restaurants' )){?>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Star level:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_advertisement['star_level']; ?></b></td>
                                      		</tr>
                                            <?php } ?>
                                    	</table>
                                        <table width="200" border="0" class="pull-right" style="margin-top:-135px">
                                        	<tr>
                                        		<td><img src="../advertiser_pages/add_pics/<?php echo $row_advertisement['add_image']; ?>" /></td>
                                      		</tr>
                                    	</table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         	<!-- Modal Ends -->   
                         
                         	<?php } ?>     
            			</p>
    				</div> <!--//tab4-->
                    
                    <div class="tab-pane <?php echo $_SESSION['active_tab5'];?>" id="tab5">
      					<div id="register">
                            <h3>Currently received travel plans....</h3>
                            <div id='travel_plan_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_travel_plan']; ?></div>
                            <div id='guide_assign_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_assign_guide']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$travel_plan_select_query = mysql_query( "SELECT * FROM travel_plan" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Travel Plan ID</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_travel_plan = mysql_fetch_array( $travel_plan_select_query )) { 
                            	  $i++;
                                  $location = $row_travel_plan['destination'];
                                  $guide_list_get_query = mysql_query( "SELECT username FROM guide where address LIKE '%$location%' and availability=1") or die( mysql_error() );
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="90px"><?php echo $row_travel_plan['id']; ?></td>
                                    <td class="pull-left" width="120px">
                                        <a href="#myModal_travel_plan<?php echo $i; ?>" id="<?php echo $row_travel_plan['id']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Travel Plan</a>
                                    </td>
                                    <form name="travel_plan_delete" id="travel_plan_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="travel_plan_id" name="travel_plan_id" value="<?php echo $row_travel_plan['id']; ?>">
                                            <input type="submit" id="delete_travel_plan" name="delete_travel_plan" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal_travel_plan<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel">Travel Plan Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="travel_plan_info" id="travel_plan_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Destination:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_travel_plan['destination']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Start Date:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_travel_plan['start_date']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">End Date:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_travel_plan['end_date']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Contact Number:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_travel_plan['contact_number']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Assigned Guide:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php if($row_travel_plan['assigned_guide'] != null ){ echo $row_travel_plan['assigned_guide'];} else { ?> <b style="color:#000">Guide is not yet assigned <b><?php } ?></b></td>
                                      		</tr>
                                    	</table>
                                    </form>
<!--                                    <div style="display:inline">
                                        <form class="form-search" id="guide_search" name="guide_search" method="post">
                                        	<p class="text-left" style="display:inline"><b>Search guides by Location</b></p>
                                      		<input type="text" class="input-medium search-query" id="search_text" name="search_text" placeholder="Location name....">
                                      		<button type="submit" class="submit" id="search_guide" name="search_guide">Search</button>
                                    	</form>
                                    </div>-->
                                    <div style="display:inline">
                                        <form id="guide_assign" name="guide_assign" action="admin_centre.php" method="post">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="38%" class="pull-left">
                                                        <?php if($row_travel_plan['assigned_guide'] != null ){ ?>
                                                            <p class="text-left" style="display:inline; margin-bottom: 15px"><b>Change guide (<?php echo $row_travel_plan['destination'];?>) area</b></p>
                                                        <?php } else{ ?>
                                                            <p class="text-left" style="display:inline; margin-bottom: 15px"><b>Select a guide (<?php echo $row_travel_plan['destination'];?>) area </b></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="color:#F00" width="30%" class="pull-left">
                                                        <select class="span2" style="margin-left:30px" id="guide_list" name="guide_list">
                                                            <option value="X">Select a guide</option>
                                                            <?php while( $guide_list_array = mysql_fetch_array($guide_list_get_query) ) { ?>
                                                                <option value="<?php echo $guide_list_array['username']; ?>"><?php echo $guide_list_array['username']; ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td width="30%" class="pull-left">
                                                        <input type="hidden" id="travel_plan_id" name="travel_plan_id" value="<?php echo $row_travel_plan['id']; ?>">
                                                        <button type="submit" class="btn" id="assign_guide" name="assign_guide">Assign Guide</button>
                                                    </td>
                                                </tr>
                                            </table>
                                    	</form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         	<!-- Modal Ends -->   
                         
                         	<?php } ?>     
            			</p>
    				</div> <!--//tab 5-->
                    
                    <div class="tab-pane <?php echo $_SESSION['active_tab6'];?>" id="tab6">
      					<div id="register">
                            <h3>Currently received contact messages....</h3>
                            <div id='reply_sent_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['reply_sent_message']; ?></div>
                            <div id='contact_delete_message' style="color: yellow; font-size: 14px; font-weight: bold; padding-left: 150px; padding-top: -5px"><?php echo $_SESSION['message_delete_contact']; ?></div>
                            <!--<p>
                                Edit your advertisement detials here. But you are not allowed to change the advertisement image due to our storage limits. Sorry for inconvenience. 
                            </p>-->
                        </div> <!--//register-->
                        
                        <?php 
							$contacts_select_query = mysql_query( "SELECT * FROM contact_messages" ) or die( mysql_error() );
							$i = 0;
						?>
						<p style="text-align:left">
                			<!--<p style="text-align:left; font-weight:200; color:#0F0; font-size:15px;margin-left:16px">
                				Please delete unnecessary, expired advertisements inorder to post new ones.
                    			<br/><br/>
                			</p>-->
                			<table width="200" border="0" cellpadding="5" cellspacing="0" style="font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                				<tr>
                                    <td style="color:#F00; font-size:14px">Message ID</td>
                                    <td></td>
                                    <td></td>
                     			</tr>
                 			</table>
                			<?php while( $row_contacts = mysql_fetch_array( $contacts_select_query )) { 
                            	  $i++;
                        	?>
                    		<table width="700" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif; margin-left:40px">
                        		<tr>
                                    <td width="100px"><?php echo $row_contacts['id']; ?></td>
                                    <td class="pull-left" width="120px">
                                        <a href="#myModal_contact<?php echo $i; ?>" id="<?php echo $row_contacts['id']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">View Message</a>
                                    </td>
                                    <form name="contact_delete" id="contact_delete" action="admin_centre.php" method="post">
                                    <td class="pull-left">
                                            <input type="hidden" id="contact_id" name="contact_id" value="<?php echo $row_contacts['id']; ?>">
                                            <input type="submit" id="delete_contact" name="delete_contact" value="Delete" class="btn-danger"> 
                                    </td>
                            		</form>
                        		</tr>
                    		</table>
                        
                        	<!-- Modal -->
                            <div id="myModal_contact<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel">Contact message Details...</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="admin_centre.php" name="contact_info" id="contact_info" method="post">
                                    	<table width="100%" border="0">
                                        	<tr>
                                        		<td width="30%"><span class="label label-inverse">Sender name:</span></td>
                                        		<td style="color:#F00" width="70%"><b><?php echo $row_contacts['name']; ?></b></td>
                                      		</tr>
                                      		<tr>
                                        		<td width="30%"><span class="label label-inverse">Sender email:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_contacts['email']; ?></b></td>
                                      		</tr>
                                            <tr>
                                        		<td width="30%"><span class="label label-inverse">Message content:</span></td>
                                        		<td width="70%" style="color:#F00"><b><?php echo $row_contacts['message']; ?></b></td>
                                      		</tr>
                                    	</table>
                                    </form>
                                    <div>
                                		<button class="btn btn-info pull-left" type="button" id="reply_button<?php echo $row_contacts['id'] ?>"><i class="icon-resize-vertical"></i> Reply this message</button>
                            		</div>
                                    <script type="text/javascript">
						   				$(document).ready(function() {
							   				$('#reply<?php echo $row_contacts['id'] ?>').hide();
							   				$('#reply_button<?php echo $row_contacts['id'] ?>').click(function() {
								   				$("#reply<?php echo $row_contacts['id'] ?>").toggle("slow");
							   				});
						   				});
									</script>
                                    <div id="reply<?php echo $row_contacts['id'] ?>" style="margin-top:70px"> 
                                    	<form class="pull-left" name="reply_msg" id="reply_msg" action="admin_centre.php" method="post">
											<input type="hidden" id="contact_id" name="contact_id" value="<?php echo $row_contacts['id']; ?>">
                                            <input type="hidden" id="contact_name" name="contact_name" value="<?php echo $row_contacts['name']; ?>">
                                            <input type="hidden" id="contact_email" name="contact_email" value="<?php echo $row_contacts['email']; ?>">
                                            <textarea rows="7" class="span7" name="reply_text" id="reply_text" style="margin-left:15px" placeholder="Type your reply text here....."></textarea>
                                      		<button type="submit" class="btn btn-success" id="reply_submit" name="reply_submit" style="margin-left:15px">Submit Reply</button>
                                    	</form>
                                        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         	<!-- Modal Ends -->   
                         
                         	<?php } ?>     
            			</p>
    				</div> <!--//tab6-->
                    <div class="tab-pane <?php echo $_SESSION['active_tab7'];?>" id="tab7">
                        <div id="register">
                            <h3>Update your profile here....</h3>
                            <form class="form-horizontal" name="admin_update" id="admin_update" method="post" action="admin_centre.php">
                                <div class="control-group">
                                    <label class="control-label" for="admin_new_username">Change Username</label>
                                    <div class="controls">
                                        <input type="text" id="admin_new_username" name="admin_new_username" value="<?php echo $username;?>" onBlur="validate_new_admin_username();" onKeyDown="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="admin_new_email">Change Email</label>
                                    <div class="controls">
                                        <input type="text" id="admin_new_email" name="admin_new_email" value="<?php echo $email;?>" onBlur="validate_new_admin_email();" onKeyDown="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="admin_new_password">Change Password</label>
                                    <div class="controls">
                                        <input type="password" id="admin_new_password" name="admin_new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="admin_confirm_password">Confirm Password</label>
                                    <div class="controls">
                                        <input type="password" id="admin_confirm_password" name="admin_confirm_password" placeholder="Confirm new password" onKeyUp="validate_password_match();">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="admin_old_password">Old Password</label>
                                    <div class="controls">
                                        <input type="password" id="admin_old_password" name="admin_old_password" placeholder="Old password" onBlur="validate_old_admin_password();" onKeyDown="validate_password_match();" onKeyUp="" onMouseOut="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary" name="update_admin" id="update_admin" onMouseOver="main_validate();">Update Profile</button>
                                    </div>
                                    <div id='admin_update_message' style="color: red; font-size: 14px; font-weight: bold; padding-left: 178px; padding-top: 10px"><?php echo $_SESSION['admin_update_error']; ?></div>
                                </div>
                                
                            </form>
                        </div> <!--//register-->
                    </div> <!--//tab7-->
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