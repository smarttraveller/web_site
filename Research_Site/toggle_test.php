<html>
    <head>
        <script src="js/jquery-1.9.1.js"></script>
        <script>
            $(document).ready(function() {
                $("#clicker_user").click(function() {
                    $("#popup-wrapper_user").toggle("slow");
                });
            });
        </script>  
    </head>
    <body>
        <div id="clicker_user" class="lost-pwd">Lost your password?</div>
        <div id="popup-wrapper_user" style="background-color: #ccc; width: 360px; height: 90px; display: none">
            <br/>
            <form id="send_details_user" name="send_details_user" action="contact.php" method="post">
                <table>
                    <tr>
                        <td style="color: black">
                            Email
                        </td>
                        <td>
                            <input type="text" id="send_details_email_user" name="send_details_email_user" style="width: 200px; padding-left: 10px;" onkeyup="validate_email();" onkeydown="validate_email();">
                        </td>
                        <td>
                            <input type="submit" id="send_details_user_submit" name="send_details_user_submit" value="send_details" style="background-color: #08c; color: black" onmouseover="return validate_email();">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
