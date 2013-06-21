<?php require_once('../Connections/smart_traveller.php'); ?>
<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$username = $_SESSION['User_Username'];
$acess_forbidden = '../index.php';
/*if((($_SESSION['User_Username'])=="")&&(($_SESSION['User_UserGroup'])!="2")){*/
	/*echo("<script>location.href = 'index.php';</script>");*/
/*	header("Location: " . $acess_forbidden );
}*/
mysql_select_db("smart_traveller") or die(mysql_error()); 

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

if (isset($_POST['submit'])) {

	$add_category = $_POST['category'];	
	$add_title = $_POST['add_title'];	
	$add_descriptiton = $_POST['add_descriptiton'];
	$add_links = $_POST['add_links'];
	
	$MM_redirectLoginSuccess = "add_upload2.php";
 	$MM_redirectLoginFailed = "add_upload2.php";
  	$MM_redirecttoReferrer = true;
  	mysql_select_db($database_smart_traveller, $smart_traveller);
	
	$data2 = mysql_query("SELECT password FROM user WHERE username='$username'") or die(mysql_error());
  	$info2 = mysql_fetch_array( $data2 );

	$time_stamp = $_SESSION['time_stamp'];
	
	$add_post_query = "update advertisements set username = '$username', add_category = '$add_category', add_title = '$add_title', add_description = '$add_descriptiton', links = '$add_links' where time_stamp = '$time_stamp'";
	
  	$add_post = mysql_query($add_post_query, $smart_traveller) or die(mysql_error());

    if ($add_post) {
		/*$_SESSION['User_add_category'] = add_category;
		$_SESSION['User_add_title'] = $add_title;
		$_SESSION['User_add_description'] = $add_descriptiton;
		$_SESSION['User_add_links'] = $add_links;
		*/
		unset($_SESSION['time_stamp']);
		echo("<script>window.alert('You have successfully posted your add');location.href = 'add_upload2.php';</script>");
      //header("Location: " . $MM_redirectLoginSuccess );
 	}
    else {
		echo("<script>window.alert('Error..Update failed..');location.href = 'add_upload2.php';</script>");
      //header("Location: ". $MM_redirectLoginFailed );
  	}
}

if(isset($_POST['update_add'])){
	
	$add_category = $_POST['category'];	
	$add_title = $_POST['add_title'];	
	$add_descriptiton = $_POST['add_descriptiton'];
	$add_links = $_POST['add_links'];
	$time_stamp = $_POST['time_stamp'];
	$_SESSION['time_stamp'] = $time_stamp;
	
	$add_update_query = "update advertisements set add_category = '$add_category', add_title = '$add_title', add_description = '$add_descriptiton', links = '$add_links' where time_stamp = '$time_stamp'";
	
  	$add_update = mysql_query($add_update_query, $smart_traveller) or die(mysql_error());

    if ($add_update) {
		/*$_SESSION['User_add_category'] = add_category;
		$_SESSION['User_add_title'] = $add_title;
		$_SESSION['User_add_description'] = $add_descriptiton;
		$_SESSION['User_add_links'] = $add_links;
		*/
		unset($_SESSION['time_stamp']);
		echo("<script>window.alert('You have successfully updated your add');location.href = 'add_upload2.php';</script>");
      //header("Location: " . $MM_redirectLoginSuccess );
 	}
    else {
		echo("<script>window.alert('Error..Update failed..');location.href = 'add_upload2.php';</script>");
      //header("Location: ". $MM_redirectLoginFailed );
  	}
}

if(isset($_POST['delete_add'])){
	
	$time_stamp_delete = $_POST['time_stamp_delete'];
	$add_delete_query = "delete from advertisements where time_stamp = '$time_stamp_delete'";
	
	$add_delete = mysql_query($add_delete_query, $smart_traveller) or die(mysql_error());

    if ($add_delete) {
		/*$_SESSION['User_add_category'] = add_category;
		$_SESSION['User_add_title'] = $add_title;
		$_SESSION['User_add_description'] = $add_descriptiton;
		$_SESSION['User_add_links'] = $add_links;
		*/
		unset($_SESSION['time_stamp']);
		echo("<script>window.alert('You have successfully deleted your add');location.href = 'add_upload2.php';</script>");
      //header("Location: " . $MM_redirectLoginSuccess );
 	}
    else {
		echo("<script>window.alert('Error..Delete failed..');location.href = 'add_upload2.php';</script>");
      //header("Location: ". $MM_redirectLoginFailed );
  	}
}


?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact - Tailor Shop Website Template</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
</head>
<body>
	<div id="header">
		<div>
			<a href="../index.html" id="logo"><img src="../images/logo.png" alt="Logo"></a>
			<ul>
				<li>
					<a href="../index.html">Home</a>
				</li>
				<li>
					<a href="../product.html">Product</a>
				</li>
				<li>
					<a href="../services.html">Services</a>
				</li>
				<li>
					<a href="../blog.html">Blog</a>
				</li>
				<li>
					<a href="../about.html">About</a>
				</li>
				<li class="current">
					<a href="../contact.html">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="body">
		<div id="featured">
			<h3>This is just a place holder, so you can see what the site would look like. You can replace all this text with your own text.</h3>
		</div>
		<div id="content">
			<div id="register">
				<p>
					This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
				</p>
				<div>
				  <form action="add_upload2.php" name="add_upload" id="add_upload" method="post">
				    <h3>Post a new advertisement</h3>
              		<label for="add_category"><span>Add Category:</span>
                        <select name="category" id="category">
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
                        <label for="add_title"><span>Add Title:</span>
							<input type="text" id="add_title" name="add_title" value="">
						</label>
                        <label for="add_descriptiton"><span class="institute">Add Description:</span>
						  <textarea name="add_descriptiton" id="add_descriptiton" cols="20" rows="10"></textarea>
						</label>
                        <label for="#myModal"><span>Add Image:</span>
							<a href="#myModal" role="button" class="btn" data-toggle="modal">Clik here to select image</a>
						</label>
                        <label for="add_links"><span>Add Lnks:</span>
							<input type="text" id="add_links" name="add_links" value="">
						</label>
						<!--<label for="message"><span class="message">Message:</span>
							<textarea name="message" id="message" cols="30" rows="10"></textarea>
						</label>-->
						<input type="submit" id="submit" name="submit" value="Post Add">
				  </form>
			  </div>
			</div>
            <?php 
				$ads = mysql_query( "SELECT username, add_category, add_title, add_description, add_image, links, time_stamp FROM advertisements where username = '$username'" ) or die( mysql_error() );
				$i = 0;
			?>
			<p style="padding-left:300px; text-align:left">
				<hr style="margin-left:200px; margin-right:200px">
                <p style="padding-left:250px; text-align:left; font-weight:200; color:#0F0; font-size:15px">
                	Your advertisements are listed below. Maximum 5 allowed. Please delete unnecessary, expired advertisements inorder to post new ones.
                    <br/><br/>
                </p>
                <table width="200" border="0" cellpadding="5" cellspacing="5" style="margin-left:300px; font-size:15px; color:#FF0; font:Georgia, 'Times New Roman', Times, serif">
                        <tr>
                            <td style="color:#F00; font-size:14px">Add Title</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php while( $row_ads = mysql_fetch_array( $ads )) { 
                              $i++;
                        ?>
                        <tr>
                            <td><?php echo $row_ads['add_title']; ?></td>
                            <td><a href="#myModal<?php echo $i; ?>" id="<?php echo $row_ads['time_stamp']; ?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">Edit</a></td>
                            <td>
                            	<form name="add_list" id="delete" name="delete" action="add_upload2.php" method="post">
                                	<input type="submit" id="delete_add" name="delete_add" value="Delete" class="btn-danger">
                                    <input type="hidden" id="time_stamp_delete" name="time_stamp_delete" value="<?php echo $row_ads['time_stamp']; ?>">
                                </form>
                            </td>
                        </tr>
                        <!-- Modal -->
                            <div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:600px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    <h3 id="myModalLabel">Edit your advertisement here....</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="add_upload2.php" name="update_add" id="update_add" method="post">
                                        <label for="add_category"><span>Change Category:</span>
                                            <select name="category" id="category" style="margin-left:30px">
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
                                        <label for="add_title"><span>Change Title:</span>
                                            <input type="text" id="add_title" name="add_title" value="<?php echo $row_ads['add_title']; ?>" style="margin-left:60px">
                                        </label>
                                        <label for="add_descriptiton"><span class="institute">Change Description:</span>
                                             <textarea name="add_descriptiton" id="add_descriptiton" cols="30" rows="10" style="margin-left:15px; width:370px" ><?php echo $row_ads['add_description']; ?></textarea>
                                        </label>
                                        <label for="current_image"><span>Current Image:</span>
                                        <img src="add_pics/<?php echo $row_ads['add_image']; ?>" style="margin-left:50px"/>
                                        </label>
                                        <label for="#myModal_update"><span>Change Image:</span>
                                            <a href="#myModal_update" role="button" class="btn" data-toggle="modal" style="margin-left:48px">Clik here to select image</a>
                                        </label>
                                        <label for="add_links"><span>Change Lnks:</span>
                                            <input type="text" id="add_links" name="add_links" value="<?php echo $row_ads['links']; ?>" style="margin-left:55px">
                                        </label>
                                        <label for="hidden_field">
                                            <input type="hidden" id="time_stamp" name="time_stamp" value="<?php echo $row_ads['time_stamp']; ?>" style="margin-left:55px">
                                        </label>
                                        <input type="submit" id="update_add" name="update_add" value="Update Add" style="margin-left:145px" class="btn-success">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>  
                         <!-- Modal Ends --> 
                        <?php } ?>
                </table>
            </p>
		</div>
	</div>

	<div id="footer">
		<div>
			<div class="first">
				<h4>Services</h4>
				<p>
					This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
				</p>
			</div>
			<div class="last">
				<h4>Social</h4>
				<div>
					<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
					<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
					<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google&#43;</a>
				</div>
				<h4>Newsletter</h4>
				<form action="../index.html">
					<input type="text" id="newsletter" value="Enter Email Address">
					<input type="submit" id="go" value="go">
				</form>
			</div>
		</div>
		<p class="footnote">
			&copy; Copyright 2012. All rights reserved.
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