// start functions
function validate_advertisement_category(){
    var advertisement_category = document.add_upload.category.value;
    if (advertisement_category == "X") {
        inlineMsg('category', 'Please select category.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_title(){
    var advertisement_title = document.add_upload.add_title.value;
    if(advertisement_title == ""){
        inlineMsg('add_title', 'Invalid title.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_description(){
    var advertisement_description = document.add_upload.add_descriptiton.value;
    if(advertisement_description == ""){
        inlineMsg('add_descriptiton', 'Invalid description.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_links(){
    var advertisement_links = document.add_upload.add_links.value;
    if (advertisement_links == "") {
        inlineMsg('add_links', 'Invalid links.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_telephone(){
    var advertisement_telephone = document.add_upload.add_telephone.value;
    if (advertisement_telephone == "") {
        inlineMsg('add_telephone', 'Telephone number can\'t be empty.', 2);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
    if(advertisement_telephone.length > 12) {
      inlineMsg('add_telephone','Telephone number can\'t exceed 12 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
    if(advertisement_telephone.length < 10) {
      inlineMsg('add_telephone','Telephone number must have at least 10 characters.',2);
      /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
      return false;
    }
}

function validate_advertisement_cost(){
    var advertisement_cost = document.add_upload.cost.value;
    if(advertisement_cost == ""){
        inlineMsg('cost', 'Invalid cost.', 1);
        /*$('#member_update').submit(function (evt) {
                evt.preventDefault();
        });*/
        return false;
    }
}

function validate_advertisement_star(){
    var advertisement_category = document.add_upload.category.value;
    var advertisement_star = document.add_upload.star_level.value;
    if((advertisement_category=="Hotels")||(advertisement_category=="Restaurants")){
        if (advertisement_star == "0") {
            inlineMsg('star_level', 'Please select star level.', 1);
            /*$('#member_update').submit(function (evt) {
                    evt.preventDefault();
            });*/
            return false;
        }
    }
}

function main_validate_advertisement(){
    var advertisement_category = document.add_upload.category.value;
	var advertisement_title = document.add_upload.add_title.value;
	var advertisement_description = document.add_upload.add_descriptiton.value;
	var advertisement_links = document.add_upload.add_links.value;
	var advertisement_telephone = document.add_upload.add_telephone.value;
	var advertisement_cost = document.add_upload.cost.value;
	var advertisement_star = document.add_upload.star_level.value;
	
	if((advertisement_category=="Hotels")||(advertisement_category=="Restaurants")){
		if((advertisement_category=="X")||(advertisement_title=="")||(advertisement_description=="")||(advertisement_links=="")||(advertisement_telephone=="")||(advertisement_cost=="")||(advertisement_star=="0")){
	   
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
		if((advertisement_category=="X")||(advertisement_title=="")||(advertisement_description=="")||(advertisement_links=="")||(advertisement_telephone=="")||(advertisement_cost=="")){
	   
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



