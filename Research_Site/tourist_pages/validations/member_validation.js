// start functions
function validate_title(){
    var member_title = document.member_update.title.value;
    if (member_title == "X") {
        inlineMsg('title', 'Please select your title.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_name(){
    var member_name = document.member_update.name.value;
    if(member_name == ""){
        inlineMsg('name', 'Invalid name.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_gender(){
    var gender = "";
    var len = document.member_update.gender.length;

    for (i = 0; i < len; i++) {
        if (document.member_update.gender[i].checked) {
            gender = document.member_update.gender[i].value;
            break;
        }
    }
    if (gender == "") {
        inlineMsg('gender_error', 'Please select your gender.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_address(){
    var member_address = document.member_update.address.value;
    if(member_address == ""){
        inlineMsg('address', 'Invalid address.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_country(){
    var member_country = document.member_update.country.value;
    if (member_country == "X") {
        inlineMsg('country', 'Please select your tcountry.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_telephone(){
    var member_telephone = document.member_update.telephone.value;
    if (member_telephone == "") {
        inlineMsg('telephone', 'Telephone number can\'t be empty.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    if(member_telephone.length > 12) {
      inlineMsg('telephone','Telephone number can\'t exceed 12 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
    if(member_telephone.length < 10) {
      inlineMsg('telephone','Telephone number must have at least 10 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
}

function validate_nationality(){
    var member_nationality = document.member_update.nationality.value;
    if(member_nationality == ""){
        inlineMsg('nationality', 'Invalid nationality.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_email(){
    var member_email = document.member_update.email.value;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if((member_email == "")||(!member_email.match(emailRegex))) {
        inlineMsg('email', 'Invalid email.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_username(){
    var member_username = document.member_update.username.value;
    if(member_username == ""){
        inlineMsg('username', 'Invalid username.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_old_password(){
    var member_old_password = document.member_update.old_password.value;
    if(member_old_password == ""){
        inlineMsg('old_password', 'Old password is required.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_password_match(){
	var tourist_new_password = document.member_update.new_password.value;
    var tourist_confirm_password = document.member_update.confirm_new_password.value;
    
	if(tourist_new_password != tourist_confirm_password){
        
        if(tourist_new_password==""){
            inlineMsg('new_password', 'Passwords do not match.', 1);
            return false;
        }
        else{
            inlineMsg('confirm_new_password', 'Passwords do not match.', 1);
            $("#modal_tourist").modal('hide');
            $("#old_password").val("");
            return false;
        }
    }
}

function main_validate(){
    var member_title = document.member_update.title.value;
    var member_name = document.member_update.name.value;
    var gender = "";
    var len = document.member_update.gender.length;
	for (i = 0; i < len; i++) {
        if (document.member_update.gender[i].checked) {
            gender = document.member_update.gender[i].value;
            break;
        }
    }
    var member_address = document.member_update.address.value;
    var member_country = document.member_update.country.value;
    var member_telephone = document.member_update.telephone.value;
    var member_nationality = document.member_update.nationality.value;
    var member_email = document.member_update.email.value;
    var member_username = document.member_update.username.value;
//    var member_old_password = document.member_update.old_password.value;
    
	if((member_title=="X")||(member_name=="")||(gender=="")||(member_address=="")||(member_country=="X")||(member_telephone=="")||(member_nationality=="")||(member_email=="")||(member_username=="")){
		alert("Please fill all the fields");
        //history.back();
		$('#member_update').submit(function (evt) {
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



