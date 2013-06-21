function validate_email_admin(){
    
    var send_details_email_admin = document.getElementById('send_details_email_admin').value;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if((send_details_email_admin == "")||(!send_details_email_admin.match(emailRegex))) {
        document.getElementById('send_details_error_message_admin').innerHTML = 'Invalid Email';
        document.getElementById("send_details_admin_submit").disabled=true;
        return false;
    }
    else{
        document.getElementById('send_details_error_message_admin').innerHTML = '&nbsp';
        document.getElementById("send_details_admin_submit").disabled=false;
        return true;
    }

}


