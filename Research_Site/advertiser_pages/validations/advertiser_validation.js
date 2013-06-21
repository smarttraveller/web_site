// start functions
function validate_title(){
    var advertiser_title = document.advertiser_update.title.value;
    if (advertiser_title == "X") {
        inlineMsg('title', 'Please select your title.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_name(){
    var advertiser_name = document.advertiser_update.name.value;
    if(advertiser_name == ""){
        inlineMsg('name', 'Invalid name.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_address(){
    var advertiser_address = document.advertiser_update.address.value;
    if(advertiser_address == ""){
        inlineMsg('address', 'Invalid address.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_telephone(){
    var advertiser_telephone = document.advertiser_update.telephone.value;
    if (advertiser_telephone == "") {
        inlineMsg('telephone', 'Telephone number can\'t be empty.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    if(advertiser_telephone.length > 12) {
      inlineMsg('telephone','Telephone number can\'t exceed 12 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
    if(advertiser_telephone.length < 10) {
      inlineMsg('telephone','Telephone number must have at least 10 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
}

function validate_email(){
    var advertiser_email = document.advertiser_update.email.value;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if((advertiser_email == "")||(!advertiser_email.match(emailRegex))) {
        inlineMsg('email', 'Invalid email.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_username(){
    var advertiser_username = document.advertiser_update.username.value;
    if(advertiser_username == ""){
        inlineMsg('username', 'Invalid username.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_old_password(){
    var advertiser_old_password = document.advertiser_update.old_password.value;
    if(advertiser_old_password == ""){
        inlineMsg('old_password', 'Old password is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_password_match(){
	var advertiser_new_password = document.advertiser_update.new_password.value;
    var advertiser_confirm_password = document.advertiser_update.confirm_new_password.value;
    
	if(advertiser_new_password != advertiser_confirm_password){
        
        if(advertiser_new_password==""){
            inlineMsg('new_password', 'Passwords do not match.', 1);
            return false;
        }
        else{
            inlineMsg('confirm_new_password', 'Passwords do not match.', 1);
            $("#modal_advertiser").modal('hide');
            $("#old_password").val("");
            return false;
        }
    }
}

function main_validate(){
    var advertiser_title = document.advertiser_update.title.value;
	var advertiser_name = document.advertiser_update.name.value;
	var advertiser_address = document.advertiser_update.address.value;
	var advertiser_telephone = document.advertiser_update.telephone.value;
	var advertiser_email = document.advertiser_update.email.value;
    var advertiser_username = document.advertiser_update.username.value;
	
	if((advertiser_title=="X")||(advertiser_name=="")||(advertiser_address=="")||(advertiser_telephone=="")||
       (advertiser_email=="")||(advertiser_username=="")){
   
		alert("Please fill all the fields");
        //history.back();
//		$('input[type=submit]').attr('disabled', 'disabled');
		$('#advertiser_update').submit(function (evt) {
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



