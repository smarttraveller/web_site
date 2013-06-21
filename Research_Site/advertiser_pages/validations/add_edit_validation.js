// start functions
function validate_advertisement_edit_category(){
    var advertisement_edit_category = document.update_add.category.value;
    if (advertisement_edit_category == "X") {
        inlineMsg('category', 'Please select category.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_edit_title(){
    var advertisement_edit_title = document.update_add.add_title.value;
    if(advertisement_edit_title == ""){
        inlineMsg('add_title', 'Invalid title.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_edit_description(){
    var advertisement_edit_description = document.update_add.add_descriptiton.value;
    if(advertisement_edit_description == ""){
        inlineMsg('add_descriptiton', 'Invalid description.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_edit_links(){
    var advertisement_edit_links = document.update_add.add_links.value;
    if (advertisement_edit_links == "") {
        inlineMsg('add_links', 'Invalid links.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_edit_telephone(){
    var advertisement_edit_telephone = document.update_add.add_telephone.value;
    if (advertisement_edit_telephone == "") {
        inlineMsg('add_telephone', 'Telephone number can\'t be empty.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    if(advertisement_edit_telephone.length > 12) {
      inlineMsg('add_telephone','Telephone number can\'t exceed 12 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
    if(advertisement_edit_telephone.length < 10) {
      inlineMsg('add_telephone','Telephone number must have at least 10 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
}

function validate_advertisement_edit_cost(){
    var advertisement_edit_cost = document.update_add.cost.value;
    if(advertisement_edit_cost == ""){
        inlineMsg('cost', 'Invalid cost.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_edit_star(){
    var advertisement_edit_star = document.update_add.star_level.value;
    if (advertisement_edit_star == "0") {
        inlineMsg('star_level', 'Please select star level.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function main_validate_edit_advertisement(){
    var advertisement_edit_category = document.update_add.category.value;
	var advertisement_edit_title = document.update_add.add_title.value;
	var advertisement_edit_description = document.update_add.add_descriptiton.value;
	var advertisement_edit_links = document.update_add.add_links.value;
	var advertisement_edit_cost = document.update_add.cost.value;
	var advertisement_edit_star = document.update_add.star_level.value;
	var advertisement_edit_telephone = document.update_add.add_telephone.value;
	
	if((advertisement_edit_category=="Hotels")||(advertisement_edit_category=="Restaurants")){
		if((advertisement_edit_category=="X")||(advertisement_edit_title=="")||(advertisement_edit_description=="")||(advertisement_edit_links=="")||(advertisement_edit_telephone=="")||(advertisement_edit_cost=="")||(advertisement_edit_star=="0")){
	   
			alert("Please fill all the fields");
			//history.back();
	//		$('input[type=submit]').attr('disabled', 'disabled');
			/*$('#add_upload').submit(function (evt) {
					evt.preventDefault();
			});*/
			return false;
		}
	}
	else{
		if((advertisement_edit_category=="X")||(advertisement_edit_title=="")||(advertisement_edit_description=="")||(advertisement_edit_links=="")||(advertisement_edit_telephone=="")||(advertisement_edit_cost=="")){
	   
			alert("Please fill all the fields");
			//history.back();
	//		$('input[type=submit]').attr('disabled', 'disabled');
			/*$('#add_upload').submit(function (evt) {
					evt.preventDefault();
			});*/
			return false;
		}
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



