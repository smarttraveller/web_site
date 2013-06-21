// start functions
function validate_destination(){
    var travel_destination = document.travel_plan_submit.destination.value;
    if (travel_destination == "") {
        inlineMsg('destination', 'Please provide the place.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_start_date(){
    var travel_start_date = document.travel_plan_submit.CalendarForm_travel_plan_start_date.value;
    if(travel_start_date == ""){
        inlineMsg('CalendarForm_travel_plan_start_date', 'Invalid start date.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}


function validate_end_date(){
    var travel_end_date = document.travel_plan_submit.CalendarForm_travel_plan_end_date.value;
    if(travel_end_date == ""){
        inlineMsg('CalendarForm_travel_plan_end_date', 'Invalid end date.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_telephone(){
    var contact_number = document.travel_plan_submit.contact_number.value;
    if (contact_number == "") {
        inlineMsg('contact_number', 'Telephone number can\'t be empty.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        document.getElementById("submit").disabled=true;
        return false;
    }
    else if(contact_number.length > 12) {
      inlineMsg('contact_number','Telephone number can\'t exceed 12 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      document.getElementById("submit").disabled=true;
      return false;
    }
    else if(contact_number.length < 10) {
      inlineMsg('contact_number','Telephone number must have at least 10 characters.',1);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      document.getElementById("submit").disabled=true;
      return false;
    }
    else{
        document.getElementById("submit").disabled=false;
        return true;
    }
}

function main_validate_travel_plan(){
    var travel_destination = document.travel_plan_submit.destination.value;
    var travel_start_date = document.travel_plan_submit.CalendarForm_travel_plan_start_date.value;
    var travel_end_date = document.travel_plan_submit.CalendarForm_travel_plan_end_date.value;
    var contact_number = document.travel_plan_submit.contact_number.value;
    
	if((travel_destination=="")||(travel_start_date=="")||(travel_end_date=="")||(contact_number=="")){
		alert("Please fill all the fields");
        //history.back();
//		$('#travel_plan_submit').submit(function (evt) {
//                evt.preventDefault();
//        });
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



