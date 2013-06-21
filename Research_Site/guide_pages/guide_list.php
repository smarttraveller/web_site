<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
mysql_select_db($database_smart_traveller) or die(mysql_error()); 
$username = $_SESSION['User_Username'];
$user_group = $_SESSION['User_UserGroup'];

$acess_forbidden = '../index.php';
if((($_SESSION['User_UserGroup'])!="1")&&(($_SESSION['User_UserGroup'])!="2")&&(($_SESSION['User_UserGroup'])!="3")&&(($_SESSION['User_UserGroup'])!="4")){
	echo("<script>location.href = '../index.php';</script>");
	header("Location: " . $acess_forbidden );
}

/*$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category FROM guide") or die(mysql_error());*/
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
    <script type="text/javascript" src="../ajax_form/js/jquery.min.js"></script>
	<script type="text/javascript" src="../ajax_form/js/9lessons.js"></script>
    
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
		$(function() {
		$("input[id^='submit']").click(function() {
			//alert($(this).attr("id"));
			var temp = $(this).attr("id");
			var guide_id = $("#guide_id"+temp).val();	
			//alert(guide_id);
			alert("Thank you for your valuable vote");
			$.post("guide_list.php", { link: guide_id});
			var dataString = 'guide_id='+ guide_id;			
				$.ajax({
					type: "POST",
					url: "guide_list.php",
					data: dataString,
					success: function(){	   
				    }
		  
				});	
				$('.success'+temp).fadeIn(200).show();
				setTimeout(function(){
                	$('.success'+temp).hide();
                }, 1000);	
			return false;
			});
		});
	</script>
    <!--<script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
<!--    <script>
	$('#select_categoty').submit(function() { // catch the form's submit event
    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(response) { // on success..
            $('#guide_list').html(response); // update the DIV
        }
    });
    return false; // cancel original event to prevent form submitting
	});
    </script>-->
    
          <script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
            function ajaxFunction() {
                var ajaxRequest;  // The variable that makes Ajax possible!

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function() {
                    if (ajaxRequest.readyState == 4) {
                       if (document.select_categoty.category.value == "X") {
                            document.getElementById('guide_list').innerHTML = "";
                        }
                    }
                }
                ajaxRequest.open("GET", "", true);
                ajaxRequest.send(null);
            }

//-->
        </script>
       	<script type="text/javascript">
            function submitform()
            {
                document.select_categoty.submit();
            }
			
			function submitformsearchByName()
            {
                document.searchByName.submit();
            }	
        </script>  
<!--        <script>
        $('#form2').submit(function () {
            sendContactForm();
            return false;
        });
        </script>-->
        
        <!--    sponsors rotate begins-->
        <link rel="stylesheet" type="text/css" href="../css/sponsors_css">
        <!--    sponsors rotate ends-->
        
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
    
<?php 
//if(isset($_POST['submit'.$i])){
$guide_id = $_POST['link'];
$_SESSION['guide_id'] = $guide_id; 
$_SESSION['category'] = $_POST['category'];
$last_category = $_POST['category'];
if(isset($_SESSION['category'])){
	mysql_query("UPDATE tourist SET last_view_category = '$last_category' WHERE username = '$username'") or die(mysql_error());
}

if(isset($_SESSION['guide_id'])){
/*$data = mysql_query("SELECT votes FROM guide WHERE id_number='$name'") or die(mysql_error());
$count = mysql_fetch_array($data);
$vote = (int) $count;*/
//$vote = $vote + 1;
	mysql_query("UPDATE guide SET votes = votes + 1 WHERE id_number = '$guide_id'") or die(mysql_error());
}
/*$data = mysql_query("SELECT votes FROM guide WHERE id_number='$name'") or die(mysql_error());
$vote = intval($data);
$vote = $vote - 1;
$LoginRS__query_2 = "UPDATE guide SET votes = '$vote' WHERE id_number = '$name'";
$LoginRS_2 = mysql_query($LoginRS__query_2, $smart_traveller) or die(mysql_error());*/
//}
?>
	<?php if ($_SESSION['User_Username'] != "") { ?>

    <!-- Panel -->
    <div id="toppanel">
    	<!-- The tab on top -->	
      <div class="tab">
    	<ul class="login">
    			<li class="left">&nbsp;</li>
    			<li style="padding-top:10px;">Hello <?php echo(ucwords($_SESSION['User_Username'])); ?></li>
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
    			<li style="padding-top:10px;">Hello Guest!</li>
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
    				<li><a href="guide_update.php">Profile</a></li>
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
			<div id="register">
				<p>
					Our system can predict and show you the best travel guide among the guides who are currently registered on Smart Traveller according to your preferences. Please use different combinations according to your preferences to sort out the best travel guide. Please be kind ennough to give a vote for the guides who are best fit for you. So they can come up across the lists and can be easily top rated.
				</p>
                <br/>
				<div>
   
			    </div>
			</div>
            <div class="container">
  				<div class="row-fluid">
    				<div class="span8 well">
                    <?php 
						$category=$_POST['category'];
						$search_by_name = $_POST['search_by_name'];
						$location_name = $_POST['search_by_location'];
						$search_by_votes = $_POST['search_by_votes'];
						$top_list = $_POST['top_list'];
						$top_list_int = intval($top_list);
						//$_SESSION['category'] = $category;
						$i=0;
						if( $category != "X" ){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category'") or die(mysql_error());
						}
						if( $location_name != " " ){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where address LIKE '%$location_name%'") or die(mysql_error());
						}
						if( $search_by_votes == "vote" ){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide order by votes desc") or die(mysql_error());
						}
						if( $top_list != "X" ){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $location_name != " " )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' and address LIKE '%$location_name%'") or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' order by votes desc") or die(mysql_error());
						}
						if( ( $location_name != " " ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where address LIKE '%$location_name%' order by votes desc") or die(mysql_error());
						}
						//////////////////////////////////////////
						if( ( $category != "X" ) && ( $top_list != "X" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $location_name != " " ) && ( $top_list != "X" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where address LIKE '%$location_name%' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $top_list != "X" ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $top_list != "X" ) && ( $location_name != " " )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' and address LIKE '%$location_name%' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $top_list != "X" ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $top_list != "X" ) && ( $location_name != " " ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where address LIKE '%$location_name%' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						
						/////////////////////////////////////////
						if( ( $category != "X" ) && ( $location_name != " " ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' and address LIKE '%$location_name%' order by votes desc") or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $location_name != " " ) && ( $search_by_votes == "vote" ) && ( $top_list != "X" ) ){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where category='$category' and address LIKE '%$location_name%' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( isset( $search_by_name )){
							$data = mysql_query("SELECT title, name_badge, gender, address, telephone, email, id_number, nationality, category, profile_pic, name_initials, dob, institutes, qualification_1, qualification_2, qualification_3, votes, availability FROM guide where name_badge LIKE '%$search_by_name%'") or die(mysql_error());
						}
						$total_ads = mysql_num_rows($data);
						if( $total_ads == 0 ){
						?>
                        <div class="row-fluid">
                        	<h5>No guides to view. Please Select a different Category....</h5>
                        </div>
                        <?php
						}
							  while($row = mysql_fetch_array($data)) { 
							  $i++;
					?>
                   		<!--fake guide list begins-->
                    	<?php /*?><div id="guide_list_fake" class="thumbnail pull-left span12" style="visibility:hidden; display:none">
                        	<img src="profile_pics/<?php echo $row['profile_pic']; ?>" class="pull-left"/>
                        	<div class="caption pull-left">
                                    <p><?php echo $row['title'].". ".$row['name_badge']; ?></p>
                                    <p><?php echo $row['gender']; ?></p>
                                    <p><?php echo $row['address']; ?></p>
                                    <p><?php echo $row['telephone']; ?></p>
                                    <p><?php echo $row['email']; ?></p>
                                    <p><?php echo $row['id_number']; ?></p>
                                    <p><?php echo $row['nationality']; ?></p>
                                    <p><?php echo $row['category']; ?></p>
                                    <p><a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Details</a></p>
                            </div>
                         </div><?php */?>
                         <!--fake guide list ends-->
      					<div class="row-fluid">
                            <ul class="thumbnails">                                                        
                              <div class="span12">
                              <li>
                                <div id="guide_list" class="thumbnail pull-left span12">
                                  <img src="profile_pics/<?php echo $row['profile_pic']; ?>" class="pull-left"/>
                                  <div class="caption pull-left">
                                    <!--<h3>Thumbnail label</h3>-->
                                    <p><b>Name: </b><?php echo $row['title'].". ".$row['name_badge']; ?></p>
                                    <p><b>Gender: </b><?php echo $row['gender']; ?></p>
                                    <p><b>Address: </b><?php echo $row['address']; ?></p>
                                    <p><b>Telephone: </b><?php echo $row['telephone']; ?></p>
                                    <p><b>Email: </b><?php echo $row['email']; ?></p>
                                    <p><b>ID Number: </b><?php echo $row['id_number']; ?></p>
                                    <p><b>Nationality: </b><?php echo $row['nationality']; ?></p>
                                    <p><b>Category: </b><?php echo wordwrap($row['category'],34,"<br>\n"); ?></p>
                                    <p><a href="#myModal<?php echo $i; ?>" id="<?php echo $row['id_number']; ?>" role="button" class="btn btn-primary" data-toggle="modal" onClick="submitform2();">Details</a></p>
                                  </div>
                                </div>
                              </li>
                              <br/>
                              </div>                                                                                     
                            </ul>
          				</div>
                        <!-- Modal -->
						<div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  							<div class="modal-header">
    							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   								 <h3 id="myModalLabel"><?php echo $row['title'].". ".$row['name_initials']."'s Details"; ?></h3>
  							</div>
  							<div class="modal-body">
    						<!--<iframe src="image_upload3/upload_crop_v1.2.php" scrolling="no" width="800px" height="500px" frameborder="0"></iframe>-->
    							<?php // echo $row['id_number']; ?>
                                <?php /*?><p>
                                	<form name="form2" id="form2" action="" method="POST">
                                    <input type="hidden" id="get_id" name="get_id" value="<?php echo $row['id_number']; ?>">
                                    <input name="submit" id="submit" type="submit" value="Details" class="btn btn-primary" >
                                    </form>
                                </p><?php */?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Name:</span></td>
                                        <td style="color:#F00" width="70%"><b><?php echo $row['title'].". ".$row['name_initials']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Name on badge:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['name_badge']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Category:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['category']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Gender:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['gender']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Address:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['address']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Telephone:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['telephone']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Email:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['email']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Date of Birth:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['dob']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">ID Number:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['id_number']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Nationality:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['nationality']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Trained Institutes:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['institutes']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Qualifications:</span></td>
                                        <td width="70%" style="color:#F00">
                                            <b>
                                                <?php echo $row['qualification_1']; ?>
                                                <?php if($row['qualification_2'] != null) echo ",<b style='color:#0000ff'>".$row['qualification_2']."</b>";?>
                                                <?php if($row['qualification_3'] != null) echo ",<b style='color:magenta'> ".$row['qualification_3']."</b>";?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Total Votes:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['votes']; ?></b></td>
                                    </tr>
                                </table>
                                <table width="200" border="0" class="pull-right" style="margin-top:-165px">
                                    <tr>
                                        <td><img src="profile_pics/<?php echo $row['profile_pic']; ?>" /></td>
                                    </tr>
                                </table>
                                <form autocomplete="off" enctype="multipart/form-data" method="post"  name="form_guide_id<?php echo $i; ?>" id="form_guide_id<?php echo $i; ?>">
                                <br/><br/>
                                <input id="guide_id<?php echo 'submit'.$i; ?>" name="guide_id<?php echo 'submit'.$i; ?>" type="hidden" class="guide_id"  value="<?php echo $row['id_number']; ?>" tabindex="1" />
                                <input  type="submit" value="Vote for <?php echo $row['title'].". ".$row['name_badge']; ?>"  class="submit btn btn-success" id="submit<?php echo $i; ?>" name="submit<?php echo $i; ?>"/><span id="span<?php echo $i; ?>"  class="success<?php echo 'submit'.$i; ?>" style="display:none"> Your vote sucessfully sent for <?php echo $row['title'].". ".$row['name_badge']; ?> </span>
                                </form>
 							 </div>
  							 <div class="modal-footer">
    							<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    							<!--<button class="btn btn-primary">Save changes</button>-->
  							 </div>
						</div>          
                    <?php }?> 
                        
    				</div>
    				<div class="span4 well">
      				<!--Body content-->
                    	<div class="row-fluid">
                            <div class="span12 well">
                                <p class="text-left">Search by category</p>
                                <form action="guide_list.php" method="POST" name="select_categoty" id="select_categoty">
                                    <select class="span12" name="category" id="category" onChange="ajaxFunction(); submitform();">
                                        <option value="X" selected>Select a Category</option>
                                        <option value="Culture, Heritage and Nature Tours" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Culture, Heritage and Nature Tours"){?> selected <?php } ?> >Culture, Heritage and Nature Tours </option>
                                        <option value="Recreation, Nature and Wild Life Tours" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Recreation, Nature and Wild Life Tours"){?> selected <?php } ?> >Recreation, Nature and Wild Life Tours</option>
                                        <option value="Culture, Nature and Wild Life" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Culture, Nature and Wild Life"){?> selected <?php } ?> >Culture, Nature and Wild Life</option>
                                        <option value="Nature and Wild Life Safaris" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Nature and Wild Life Safaris"){?> selected <?php } ?> >Nature and Wild Life Safaris</option>
                                        <option value="Sea and Wild Life" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Sea and Wild Life"){?> selected <?php } ?> >Sea and Wild Life</option>
                                        <option value="East Coast Sea" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="East Coast Sea"){?> selected <?php } ?> >East Coast Sea</option>
                                        <option value="Sports, Recreations and Adventure" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Sports, Recreations and Adventure"){?> selected <?php } ?> >Sports, Recreations and Adventure </option>
                                        <option value="Elephants and Wild Life Safari" onChange="ajaxFunction(); submitform();" <?php if($_POST['category']=="Elephants and Wild Life Safari"){?> selected <?php } ?> >Elephants and Wild Life Safari </option>
                                    </select>
                                    <label class="checkbox">
                                        <input type="checkbox" name="search_by_votes" id="search_by_votes" value="vote" onClick="submitform();" <?php if($_POST['search_by_votes']=="vote"){?> checked <?php } ?> >Search by votes
                                    </label>
                                    <p class="text-left">Search by Location</p>
                                    <input class="span10 search-query" type="text" name="search_by_location" id="search_by_location" onBlur="submitform();" value="<?php echo $_POST['search_by_location']; ?>" placeholder="Location name ....">
                                    <br/><br/>
                                    <p class="text-left">Top List</p>
                                    <select class="span12" name="top_list" id="top_list" onChange="submitform();">
                                        <option value="X" selected>Select list</option>
                                        <option value="2" onChange="submitform();" <?php if($_POST['top_list']=="2"){?> selected <?php } ?> > Top 5 </option>
                                        <option value="3" onChange="submitform();" <?php if($_POST['top_list']=="3"){?> selected <?php } ?> > Top 10 </option>
                                    </select>
                                    <button type="submit" class="btn">Submit</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span12 well">
                                <form action="guide_list.php" method="POST" name="searchByName" id="searchByName">
                                <p class="text-left">Search by Guide name</p>
                                <input class="span10 search-query" type="text" name="search_by_name" id="search_by_name" onBlur="submitformsearchByName();" value="<?php echo $_POST['search_by_name']; ?>" placeholder="Guide name ....">
                                </form>
                            </div>
                        </div>
    				</div>
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
    
</body>
</html>