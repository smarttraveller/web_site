// start functions
function validate_new_admin_username(){
    var admin_new_username = document.admin_update.admin_new_username.value;
    if (admin_new_username == "") {
        inlineMsg('admin_new_username', 'Username is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_new_admin_email(){
    var admin_new_email = document.admin_update.admin_new_email.value;
    if(admin_new_email == ""){
        inlineMsg('admin_new_email', 'Email is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_new_admin_password(){
    var admin_new_password = document.admin_update.admin_new_password.value;
    if(admin_new_password == ""){
        inlineMsg('admin_new_password', 'Password is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_confirm_admin_password(){
    var admin_confirm_password = document.admin_update.admin_confirm_password.value;
    if(admin_confirm_password == ""){
        inlineMsg('admin_confirm_password', 'Please confirm your password.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_old_admin_password(){
    var admin_old_password = document.admin_update.admin_old_password.value;
    if(admin_old_password == ""){
        inlineMsg('admin_old_password', 'Old password is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_password_match(){
	var admin_new_password = document.admin_update.admin_new_password.value;
    var admin_confirm_password = document.admin_update.admin_confirm_password.value;
	
	if(admin_new_password != admin_confirm_password){
        
        if(admin_new_password==""){
            inlineMsg('admin_new_password', 'Passwords do not match.', 1);
            return false;
        }
        else{
            inlineMsg('admin_confirm_password', 'Passwords do not match.', 1);
            return false;
        }
    }
}

function main_validate(){
    
    var admin_new_username = document.admin_update.admin_new_username.value;
    var admin_new_email = document.admin_update.admin_new_email.value;
    var admin_new_password = document.admin_update.admin_new_password.value;
    var admin_confirm_password = document.admin_update.admin_confirm_password.value;
	var admin_old_password = document.admin_update.admin_old_password.value;
    
	//validate_password_match();
	
    if((admin_new_username == "")||(admin_new_email == "")||(admin_old_password == "")){
        inlineMsg('update_admin', 'Please fill all the details.', 1);
        //document.getElementById("update_admin").disabled = true; 
//		$('#admin_update').submit(function (evt) {
//                evt.preventDefault();
//        });
        return false;
    }
//	else{
//		//document.forms["admin_update"].submit();
//		$(this).unbind('admin_update').submit()
//	}
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



