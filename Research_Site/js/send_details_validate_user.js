function validate_email(){
    
    var send_details_email_user = document.getElementById('send_details_email_user').value;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if((send_details_email_user == "")||(!send_details_email_user.match(emailRegex))) {
        document.getElementById('send_details_error_message_user').innerHTML = 'Invalid Email';
        document.getElementById("send_details_user_submit").disabled=true;
        return false;
    }
    else{
        document.getElementById('send_details_error_message_user').innerHTML = '&nbsp';
        document.getElementById("send_details_user_submit").disabled=false;
        return true;
    }

}


