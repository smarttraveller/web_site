
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Submit  Form with out refreshing page Tutorial</title>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- CSS -->
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />

<!-- JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/9lessons.js"></script>
<script type="text/javascript">
$(function() {
$(".submit").click(function() {

    var name = $("#name").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var gender = $("#gender").val();	     
	
    var dataString = 'name='+ name + '&username=' + username + '&password=' + password + '&gender=' + gender;			
	if(name=='' || username=='' || password=='' || gender=='')
	{
$('.success').fadeOut(200).hide();
	$('.error').fadeIn(200).show();	
	}	
	else
	{
	$.ajax({
	type: "POST",
    url: "join.php",
    data: dataString,
    success: function(){	   
   }
  
});

$('.error').fadeOut(200).hide();
 $('.success').fadeIn(200).show();
	}		
    return false;
	});
});
</script>
<style type="text/css">
body{
background:url(http://s3.amazonaws.com/twitter_production/profile_background_images/6250979/bgtwitter.jpg) no-repeat;
}
.error{	
	color:#d12f19;
	font-size:12px;		
	}
	.success{	
	color:#006600;
	font-size:12px;			
	}
</style>
</head>
<body id="public">
	<div style="height:30px"></div>
	<div id="container">
		<div style="height:30px"></div>
			<form autocomplete="off" enctype="multipart/form-data" method="post"  name="form">
				<div class="info" style="padding-left:20px">
					<h2>Submit Form Values with jQuery and Ajax</h2>
					<div>More tutorials <a href="http://9lessons.blogspot.com" style="color:#0066CC; font-weight:bold">http://9lessons.blogspot.com				</a> </div>
				</div>
				<ul>
					<li id="foli1" 	class="   ">
						<label class="desc" id="title1" for="Field1">Full Name</label>
		<div>
		<input id="name" name="name" type="text" class="field text medium"  value="" maxlength="255" tabindex="1" />
	</div>
	</li>
	<li id="foli3" class="   ">
	<label class="desc" id="title3" for="Field3">
		User-ID			</label>
	<div>
		<input id="username" 			name="username" 			type="text" 			class="field text medium" 			value="" 			maxlength="255" 			tabindex="3" 						/>
		</div>
	</li>


<li id="foli4" 		class="   ">
	<label class="desc" id="title4" for="Field4">
		Password			</label>
	<div>
		<input id="password" 			name="password" 			type="password" 			class="field text medium" 			value="" 			maxlength="255" 			tabindex="4" 						/>
		</div>
	</li>


<li id="foli6" 		class="   ">
	<label class="desc" id="title6" for="Field6">
		Gender			</label>
	<div>
		<select id="gender" 			name="gender" 			class="field select medium" 			tabindex="5"> 
						<option value="">Gender</option><option value="1">Male</option><option value="2">Female</option>
		  </select>
	</div>
	</li>







	
</ul>
<div class="buttons">
				<input  type="submit" value="Submit" style=" background:#0060a1; color:#FFFFFF; font-size:14px; border:1px solid #0060a1; margin-left:12px" class="submit"/><span class="error" style="display:none"> Please Enter Valid Data</span><span  class="success" style="display:none"> Registration Successfully.......... Click To <a href="http://9lessons.blogspot.com" style="color:#0066CC; font-weight:bold">http://9lessons.blogspot.com</a></span>
	  </div>
</form>
<div style="height:20px"></div>
</div><!--container--> <!--<iframe src="counter.html" frameborder="0" scrolling="no" height="0"></iframe>-->
</body>
</html>