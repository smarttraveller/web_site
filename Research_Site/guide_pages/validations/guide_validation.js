// start functions
function validate_title(){
    var guide_title = document.guide_update.title.value;
    if (guide_title == "X") {
        inlineMsg('title', 'Please select your title.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_name(){
    var guide_name = document.guide_update.name.value;
    if(guide_name == ""){
        inlineMsg('name', 'Invalid name.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_name_on_badge(){
    var guide_name_badge = document.guide_update.badge.value;
    if(guide_name_badge == ""){
        inlineMsg('badge', 'Invalid name for badge.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_gender(){
    var gender = "";
    var len = document.guide_update.gender.length;

    for (i = 0; i < len; i++) {
        if (document.guide_update.gender[i].checked) {
            gender = document.guide_update.gender[i].value;
            break;
        }
    }
    if (gender == "") {
        inlineMsg('gender_error', 'Please select your gender.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_address(){
    var guide_address = document.guide_update.address.value;
    if(guide_address == ""){
        inlineMsg('address', 'Invalid address.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_telephone(){
    var guide_telephone = document.guide_update.telephone.value;
    if (guide_telephone == "") {
        inlineMsg('telephone', 'Telephone number can\'t be empty.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    if(guide_telephone.length > 12) {
      inlineMsg('telephone','Telephone number can\'t exceed 12 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
    if(guide_telephone.length < 10) {
      inlineMsg('telephone','Telephone number must have at least 10 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
}

function validate_email(){
    var guide_email = document.guide_update.email.value;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if((guide_email == "")||(!guide_email.match(emailRegex))) {
        inlineMsg('email', 'Invalid email.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_dob(){
    var guide_dob = document.guide_update.dob.value;
    if(guide_dob == ""){
        inlineMsg('dob', 'Invalid birth date.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_id_number(){
    
    var guide_id = document.guide_update.id.value;
    if(guide_id == ""){
        inlineMsg('id', 'ID number is required.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    
    if((guide_id.length) != 10){
        inlineMsg('id', 'ID number must have only 10 characters.', 2);
        return false;
    }
    
    var id_numbers = guide_id.substring(0,9);
    if(isNaN(id_numbers)){
        inlineMsg('id','First 9 Digits must be numbers in ID number.',2);
        return false;
    }
    
    if(((guide_id.charAt(guide_id.length-1)).toUpperCase()) != "V"){
        inlineMsg('id','Your ID number must be end with V.',2);
        return false;
    }
}

function validate_nationality(){
    var guide_nationality = document.guide_update.nationality.value;
    if(guide_nationality == ""){
        inlineMsg('nationality', 'Invalid nationality.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_category(){
    var guide_category = document.guide_update.category.value;
    if (guide_category == "X") {
        inlineMsg('category', 'Please select your category.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_emp_type(){
    var emp = "";
    var len = document.guide_update.employment.length;

    for (i = 0; i < len; i++) {
        if (document.guide_update.employment[i].checked) {
            emp = document.guide_update.employment[i].value;
            break;
        }
    }
    if (emp == "") {
        inlineMsg('emp_error', 'Please select your employment type.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_username(){
    var guide_username = document.guide_update.username.value;
    if(guide_username == ""){
        inlineMsg('username', 'Invalid username.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_old_password(){
    var guide_old_password = document.guide_update.old_password.value;
    if(guide_old_password == ""){
        inlineMsg('old_password', 'Old password is required.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_password_match(){
	var guide_new_password = document.guide_update.new_password.value;
    var guide_confirm_password = document.guide_update.confirm_new_password.value;
    
	if(guide_new_password != guide_confirm_password){
        
        if(guide_new_password==""){
            inlineMsg('new_password', 'Passwords do not match.', 1);
            return false;
        }
        else{
            inlineMsg('confirm_new_password', 'Passwords do not match.', 1);
            $("#modal_guide").modal('hide');
            $("#old_password").val("");
            return false;
        }
    }
}

function main_validate(){
    var guide_title = document.guide_update.title.value;
    var guide_name = document.guide_update.name.value;
    var guide_name_badge = document.guide_update.badge.value;
    var gender = "";
    var len = document.guide_update.gender.length;

    for (i = 0; i < len; i++) {
        if (document.guide_update.gender[i].checked) {
            gender = document.guide_update.gender[i].value;
            break;
        }
    }
    var guide_address = document.guide_update.address.value;
    var guide_telephone = document.guide_update.telephone.value;
    var guide_email = document.guide_update.email.value;
    var guide_dob = document.guide_update.dob.value;
    var guide_id = document.guide_update.id.value;
    var guide_nationality = document.guide_update.nationality.value;
    var guide_category = document.guide_update.category.value;
    var emp = "";
    var len = document.guide_update.employment.length;

    for (i = 0; i < len; i++) {
        if (document.guide_update.employment[i].checked) {
            emp = document.guide_update.employment[i].value;
            break;
        }
    }
    var guide_username = document.guide_update.username.value;
//    var guide_old_password = document.guide_update.old_password.value;
    
	if((guide_title=="X")||(guide_name=="")||(guide_name_badge=="")||(gender=="")||(guide_address=="X")||
       (guide_telephone=="")||(guide_email=="")||(guide_dob=="")||(guide_id=="")||(guide_nationality=="")||
       (guide_category=="X")||(emp=="")||(guide_username=="")){
   
		alert("Please fill all the fields");
        //history.back();
//		$('input[type=submit]').attr('disabled', 'disabled');
		$('#guide_update').submit(function (evt) {
                evt.preventDefault();
        });
        return false;
	}
	//window.alert('You have successfully Updated your details.Please Signin Again...');
	//document.getElementById( 'success_msg' ).innerHTML = "Updated Sucessfully";
	//document.forms["member_update"].submit();
	//location.reload();
	
}

// START OF MESSAGE SCRIPT //

var MSGTIMER = 20;
var MSGSPEED = 5;
var MSGOFFSET = 3;
var MSGHIDE = 3;

// build out the divs, set attributes and call the fade function //
function inlineMsg(target,string,autohide) {
  var msg;
  var msgcontent;
  if(!document.getElementById('msg')) {
    msg = document.createElement('div');
    msg.id = 'msg';
    msgcontent = document.createElement('div');
    msgcontent.id = 'msgcontent';
    document.body.appendChild(msg);
    msg.appendChild(msgcontent);
    msg.style.filter = 'alpha(opacity=0)';
    msg.style.opacity = 0;
    msg.alpha = 0;
  } else {
    msg = document.getElementById('msg');
    msgcontent = document.getElementById('msgcontent');
  }
  msgcontent.innerHTML = string;
  msg.style.display = 'block';
  var msgheight = msg.offsetHeight;
  var targetdiv = document.getElementById(target);
  targetdiv.focus();
  var targetheight = targetdiv.offsetHeight;
  var targetwidth = targetdiv.offsetWidth;
  var topposition = topPosition(targetdiv) - ((msgheight - targetheight) / 2);
  var leftposition = leftPosition(targetdiv) + targetwidth + MSGOFFSET;
  msg.style.top = topposition + 'px';
  msg.style.left = leftposition + 'px';
  clearInterval(msg.timer);
  msg.timer = setInterval("fadeMsg(1)", MSGTIMER);
  if(!autohide) {
    autohide = MSGHIDE;  
  }
  window.setTimeout("hideMsg()", (autohide * 1000));
}

// hide the form alert //
function hideMsg(msg) {
  var msg = document.getElementById('msg');
  if(!msg.timer) {
    msg.timer = setInterval("fadeMsg(0)", MSGTIMER);
  }
}

// face the message box //
function fadeMsg(flag) {
  if(flag == null) {
    flag = 1;
  }
  var msg = document.getElementById('msg');
  var value;
  if(flag == 1) {
    value = msg.alpha + MSGSPEED;
  } else {
    value = msg.alpha - MSGSPEED;
  }
  msg.alpha = value;
  msg.style.opacity = (value / 100);
  msg.style.filter = 'alpha(opacity=' + value + ')';
  if(value >= 99) {
    clearInterval(msg.timer);
    msg.timer = null;
  } else if(value <= 1) {
    msg.style.display = "none";
    clearInterval(msg.timer);
  }
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
  var left = 0;
  if(target.offsetParent) {
    while(1) {
      left += target.offsetLeft;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.x) {
    left += target.x;
  }
  return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
  var top = 0;
  if(target.offsetParent) {
    while(1) {
      top += target.offsetTop;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.y) {
    top += target.y;
  }
  return top;
}

// preload the arrow //
if(document.images) {
  arrow = new Image(7,80); 
  arrow.src = "images/msg_arrow.gif"; 
}



