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
			var add_id = $("#add_id"+temp).val();	
			//alert(guide_id);
			alert("Thank you for your valuable vote");
			$.post("add_list.php", { link: add_id});
			var dataString = 'add_id='+ add_id;			
				$.ajax({
					type: "POST",
					url: "add_list.php",
					data: dataString,
					success: function(){	   
				    }
		  
				});	
				<!--$('.error').fadeOut(200).hide();-->
				$('.success'+temp).fadeIn(200).show();
				setTimeout(function(){
                	$('.success'+temp).hide();
                }, 1000);		
			return false;
			});
		});
	</script>
    
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
                      document.getElementById('add_list').innerHTML = "";
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
        <script>
//		$('#form2').submit(function () {
// sendContactForm();
// return false;
//});
        </script>

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
$add_id = $_POST['link'];
$_SESSION['add_id'] = $add_id; 
$_SESSION['add_category'] = $_POST['add_category'];

if(isset($_SESSION['add_id'])){

mysql_query("UPDATE advertisements SET votes = votes + 1 WHERE time_stamp = '$add_id'") or die(mysql_error());
}
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
    				<li><a href="advertiser_update.php">Profile</a></li>
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
					Our system can predict and show you the best advertisement among the advertisements that are currently posted on Smart Traveller according to your preferences. Please use different combinations according to your preferences to sort out the best advertisement. Please be kind enough to inform us about any advertisement that is harassing you or any community.
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
						$search_by_votes = $_POST['search_by_votes'];
						$top_list = $_POST['top_list'];
						$top_list_int = intval($top_list);
						$start_budget = intval($_POST['start_budget']);
						$end_budget = intval($_POST['end_budget']);
						//$_SESSION['category'] = $category;
						$i=0;
                        if( $category != "X" ){
                            $best_add_query = mysql_query("SELECT * FROM advertisements where add_category='$category' order by votes desc, cost_per_item asc, star_level desc limit 1 ") or die(mysql_error());
                            $row_best_add_id = mysql_fetch_array($best_add_query);
                            $best_add_id = $row_best_add_id['time_stamp'];
                            $_SESSION['best_add_id'] = $best_add_id;
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category' and time_stamp != '$best_add_id'") or die(mysql_error());    
						}
//						if( $category != "X" ){
//							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category'") or die(mysql_error());
//                            $best_add_query = mysql_query("SELECT * FROM advertisements where add_category='$category' order by votes desc, cost_per_item asc, star_level desc limit 1 ") or die(mysql_error());
//						}
						if( $search_by_votes == "vote" ){
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements order by votes desc") or die(mysql_error());
						}
						if( $top_list != "X" ){
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $search_by_votes == "vote" )){
                            $best_add_id = $_SESSION['best_add_id'];
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category' and time_stamp != '$best_add_id' order by votes desc") or die(mysql_error());
						}
						//////////////////////////////////////////
						if( ( $category != "X" ) && ( $top_list != "X" )){
                            $best_add_id = $_SESSION['best_add_id'];
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category' and time_stamp != '$best_add_id' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $top_list != "X" ) && ( $search_by_votes == "vote" )){
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category != "X" ) && ( $top_list != "X" ) && ( $search_by_votes == "vote" )){
                            $best_add_id = $_SESSION['best_add_id'];
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category' and time_stamp != '$best_add_id' order by votes desc limit ". $top_list_int ) or die(mysql_error());
						}
						if( ( $category == "X" ) && ( $top_list == "X" ) && ( $search_by_votes == "" )){
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_category='$category'") or die(mysql_error());
						}
						/////////////////////////////////////////
						if( isset( $search_by_name )){
							$data = mysql_query("SELECT add_category, add_title, add_description, add_image, links, votes, time_stamp, cost_per_item, star_level FROM advertisements where add_title LIKE '%$search_by_name%'") or die(mysql_error());
						}
						$total_ads = mysql_num_rows( $data );
						if( $best_add_query != "" ){
							$is_best_add = mysql_num_rows( $best_add_query );
						}
						else{
							$is_best_add = 0;
						}
						if( ( $total_ads == 0 ) && ( $is_best_add == 0 ) ){
						?>
                        <div class="row-fluid">
                        	<h5>No predicted advertisements to view. Please Select a different Category for predictions ....</h5>
                        </div>
                        <?php } ?>
                        <?php if( ($category != "X") && ( mysql_num_rows($best_add_query) != 0 ) ){ ?>
                        <div class="row-fluid">
                            <ul class="thumbnails">                                                        
                              <div class="span12">
                              <li>
                                <div id="guide_list" class="thumbnail pull-left span12">
                                  <img src="add_pics/<?php echo $row_best_add_id['add_image']; ?>" class="pull-left"/>
                                  <div class="row-fluid" style="background-image:url(imgs/top-rated-logo.jpg)">
                                      <div class="caption pull-left span6">
                                        <!--<h3>Thumbnail label</h3>-->
                                        <p><b>Title: </b><?php echo $row_best_add_id['add_title']; ?></p>
                                    	<p><b>Category: </b><?php echo $row_best_add_id['add_category']; ?></p>
                                    	<p><b>Description: </b><?php echo substr($row_best_add_id['add_description'], 0, 20)." <br/> <b style='color:blue'>To read more... click details... </b>"; ?></p>
                                    	<p><b>Links: </b><?php echo wordwrap($row_best_add_id['links'], 36, "<br />\n", true); ?></p>
                                        <p><a href="#myModalbest_add<?php echo $i; ?>" id="<?php echo $row_best_add_id['time_stamp']; ?>" role="button" class="btn btn-primary" data-toggle="modal">Details</a></p>
                                      </div>
                                  </div>
                                </div>
                              </li>
                              <br/>
                              </div>                                                                                     
                            </ul>
          				</div>
                        
                        <!-- Best Add Modal -->
						<div id="myModalbest_add<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px">
  							<div class="modal-header">
    							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   								 <h3 id="myModalLabel"><?php echo $row_best_add_id['add_title']; ?> Details</h3>
  							</div>
  							<div class="modal-body">
    						<!--<iframe src="image_upload3/upload_crop_v1.2.php" scrolling="no" width="800px" height="500px" frameborder="0"></iframe>-->
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Title:</span></td>
                                        <td style="color:#F00" width="70%"><b><?php echo $row_best_add_id['add_title']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Category:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row_best_add_id['add_category']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Description:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo wordwrap($row_best_add_id['add_description'], 35, "<br />\n"); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Links:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo wordwrap($row_best_add_id['links'], 35, "<br />\n", true); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Cost per item / person:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row_best_add_id['cost_per_item']; ?></b></td>
                                    </tr>
                                    <?php if(( $row_best_add_id['add_category'] == 'Hotels' )||( $row_best_add_id['add_category'] == 'Restaurants' )){?>
                                        <tr>
                                            <td width="30%"><span class="label label-inverse">Star Level:</span></td>
                                            <td width="70%" style="color:#F00"><b><?php echo $row_best_add_id['star_level']; ?></b></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Total Votes:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row_best_add_id['votes']; ?></b></td>
                                    </tr>
                                </table>
                                <table width="200" border="0" class="pull-right" style="margin-top:-165px">
                                    <tr>
                                        <td><img src="add_pics/<?php echo $row_best_add_id['add_image']; ?>" /></td>
                                    </tr>
                                </table>
                                <br/><br/>
                                <form autocomplete="off" enctype="multipart/form-data" method="post"  name="form_add_id<?php echo $i; ?>" id="form_add_id<?php echo $i; ?>">
                                <input id="add_id<?php echo 'submit'.$i; ?>" name="add_id<?php echo 'submit'.$i; ?>" type="hidden" class="add_id"  value="<?php echo $row_best_add_id['time_stamp']; ?>" tabindex="1" />
                                <input  type="submit" value="Vote for <?php echo $row_best_add_id['add_title']; ?>"  class="submit btn btn-success" id="submit<?php echo $i; ?>" name="submit<?php echo $i; ?>"/><span id="span<?php echo $i; ?>"  class="success<?php echo 'submit'.$i; ?>" style="display:none"> Your vote sucessfully sent for advertisement <?php echo $row_best_add_id['add_title']; ?> </span>
                                </form>
 							 </div>
  							 <div class="modal-footer">
    							<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    							<!--<button class="btn btn-primary">Save changes</button>-->
  							 </div>
						</div>
                        <?php } ?>
                        <?php
						
							  while($row = mysql_fetch_array($data)) { 
							  $i++;
                        ?>
      					<div class="row-fluid">
                            <ul class="thumbnails">                                                        
                              <div class="span12">
                              <li>
                                <div id="guide_list" class="thumbnail pull-left span12">
                                  <img src="add_pics/<?php echo $row['add_image']; ?>" class="pull-left"/>
                                  <div class="caption pull-left">
                                    <!--<h3>Thumbnail label</h3>-->
                                    <p><b>Title: </b><?php echo $row['add_title']; ?></p>
                                    <p><b>Category: </b><?php echo $row['add_category']; ?></p>
                                    <p><b>Description: </b><?php echo substr($row['add_description'], 0, 20)." <br/> <b style='color:blue'>To read more... click details... </b>"; ?></p>
                                    <p><b>Links: </b><?php echo wordwrap($row['links'], 36, "<br />\n", true); ?></p>
                                    <p><a href="#myModal<?php echo $i; ?>" id="<?php echo $row['time_stamp']; ?>" role="button" class="btn btn-primary" data-toggle="modal" onClick="submitform2();">Details</a></p>
                                  </div>
                                </div>
                              </li>
                              <br/>
                              </div>                                                                                     
                            </ul>
          				</div>
                        <!-- Modal -->
						<div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px">
  							<div class="modal-header">
    							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   								 <h3 id="myModalLabel"><?php echo $row['add_title']; ?> Details</h3>
  							</div>
  							<div class="modal-body">
    						<!--<iframe src="image_upload3/upload_crop_v1.2.php" scrolling="no" width="800px" height="500px" frameborder="0"></iframe>-->
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Title:</span></td>
                                        <td style="color:#F00" width="70%"><b><?php echo $row['add_title']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Category:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['add_category']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Description:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo wordwrap($row['add_description'], 35, "<br />\n"); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Links:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo wordwrap($row['links'], 35, "<br />\n", true); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Cost per item / person:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['cost_per_item']; ?></b></td>
                                    </tr>
                                    <?php if(( $row['add_category'] == 'Hotels' )||( $row['add_category'] == 'Restaurants' )){?>
                                        <tr>
                                            <td width="30%"><span class="label label-inverse">Star Level:</span></td>
                                            <td width="70%" style="color:#F00"><b><?php echo $row['star_level']; ?></b></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td width="30%"><span class="label label-inverse">Total Votes:</span></td>
                                        <td width="70%" style="color:#F00"><b><?php echo $row['votes']; ?></b></td>
                                    </tr>
                                </table>
                                <table width="200" border="0" class="pull-right" style="margin-top:-30%">
                                    <tr>
                                        <td><img src="add_pics/<?php echo $row['add_image']; ?>" /></td>
                                    </tr>
                                </table>
                                <br/><br/>
                                <form autocomplete="off" enctype="multipart/form-data" method="post"  name="form_add_id<?php echo $i; ?>" id="form_add_id<?php echo $i; ?>">
                                <input id="add_id<?php echo 'submit'.$i; ?>" name="add_id<?php echo 'submit'.$i; ?>" type="hidden" class="add_id"  value="<?php echo $row['time_stamp']; ?>" tabindex="1" />
                                <input  type="submit" value="Vote for <?php echo $row['add_title']; ?>"  class="submit btn btn-success" id="submit<?php echo $i; ?>" name="submit<?php echo $i; ?>"/><span id="span<?php echo $i; ?>"  class="success<?php echo 'submit'.$i; ?>" style="display:none"> Your vote sucessfully sent for advertisement <?php echo $row['add_title']; ?> </span>
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
                                <p class="text-left">Predict by category</p>
                                <form action="add_list.php" method="POST" name="select_categoty" id="select_categoty">
                                    <select class="span12" name="category" id="category" onChange="ajaxFunction(); submitform();">
                                        <option value="X">Select Category</option>
                                        <option value="Clothing" <?php if($_POST['category']=="Clothing"){?> selected <?php } ?> >Clothing</option>
                                        <option value="Antiques" <?php if($_POST['category']=="Antiques"){?> selected <?php } ?> >Antiques</option>
                                        <option value="Books" <?php if($_POST['category']=="Books"){?> selected <?php } ?> >Books</option>
                                        <option value="Travel & Hospitality" <?php if($_POST['category']=="Travel & Hospitality"){?> selected <?php } ?> >Travel & Hospitality</option>
                                        <option value="Beauty & Healthcare" <?php if($_POST['category']=="Beauty & Healthcare"){?> selected <?php } ?> >Beauty & Healthcare</option>
                                        <option value="Immigration" <?php if($_POST['category']=="Immigration"){?> selected <?php } ?> >Immigration</option>
                                        <option value="Medical" <?php if($_POST['category']=="Medical"){?> selected <?php } ?> >Medical</option>
                                        <option value="Transport" <?php if($_POST['category']=="Transport"){?> selected <?php } ?> >Transport</option>
                                        <option value="Sports" <?php if($_POST['category']=="Sports"){?> selected <?php } ?> >Sports</option>
                                        <option value="Elephants and Wild Life Safari" <?php if($_POST['category']=="Elephants and Wild Life Safari"){?> selected <?php } ?> >IT & Computing</option>
                                        <option value="Entertainment" <?php if($_POST['category']=="Entertainment"){?> selected <?php } ?> >Entertainment</option>
                                        <option value="Hotels" <?php if($_POST['category']=="Hotels"){?> selected <?php } ?> >Hotels</option>
                                        <option value="Restaurants" <?php if($_POST['category']=="Restaurants"){?> selected <?php } ?> >Restaurants</option>
                                        <option value="Photography/Vediography" <?php if($_POST['category']=="Photography/Vediography"){?> selected <?php } ?> >Photography/Vediography</option>
                                        <option value="Vehicle Renting" <?php if($_POST['category']=="Vehicle Renting"){?> selected <?php } ?> >Vehicle Renting</option>
                                        <option value="other" <?php if($_POST['category']=="other"){?> selected <?php } ?> >Other</option>
                                    </select>
                                    <label class="checkbox">
                                        <input type="checkbox" name="search_by_votes" id="search_by_votes" value="vote" onClick="submitform();" <?php if($_POST['search_by_votes']=="vote"){?> checked <?php } ?> >Predict by votes
                                    </label>
                                    <p class="text-left">Top List</p>
                                    <select class="span12" name="top_list" id="top_list" onChange="submitform();">
                                        <option value="X" selected>Select list</option>
                                        <option value="0" onChange="submitform();" <?php if($_POST['top_list']=="0"){?> selected <?php } ?> > Top 5 </option>
                                        <option value="1" onChange="submitform();" <?php if($_POST['top_list']=="1"){?> selected <?php } ?> > Top 10 </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span12 well">
                                <form action="add_list.php" method="POST" name="searchByName" id="searchByName">
                                <p class="text-left">Predict by Addvertisement name</p>
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