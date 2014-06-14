<?php
$adminemail = "## INSERT YOUR EMAIL HERE (MUST BE SAME DOMAIN) ";

if ($_GET['send'] == 'comments')
{
                        
    $_name = $_POST['name'];
    $_email = $_POST['email'];

    $_subject =   $_POST['subject'];
    $_message  =   stripslashes($_POST['message']);

                        
                        
    $email_check = '';
    $return_arr = array();

    if(($_name=="" || $_name=="Name") || ($_email=="" || $_email=="Email") || ($_subject=="") || ($_message=="" || $_message=="Message"))
    {
        $return_arr["frm_check"] = 'error';
        $return_arr["msg"] = "Please fill in all fields.";
    } 
    else if(filter_var($_email, FILTER_VALIDATE_EMAIL)) 
    {
    
    $to = $adminemail;
    $from = $_email;
    $subject = "New Message from the Web: " .$_subject;
    $message = "This is an inquiry from the website.<br /><br /> Reply-To:<br /> " . $from . " (" . $_name . ") <br /> Hitting 'reply' on this e-mail will automatically load 'reply-to' address (Only while using desktop email client)." . "<br /><br />" . "Message:" . "<br />" . $_message ;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "Content-Transfer-Encoding: 7bit\r\n";
    $headers .= "From: " . $adminemail . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";

    @mail($to, $subject, $message, $headers);   
    
    } else {
   
   
    $return_arr["frm_check"] = 'error';
    $return_arr["msg"] = "Please enter a valid email address.";


}

echo json_encode($return_arr);
}

?>