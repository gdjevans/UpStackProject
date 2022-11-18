<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/SMTP.php';
require '../../config/config.php';

if(isset($_POST["email"])) {
    
    $emailTo = $_POST["email"];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'gdjevans@hotmail.com';                     //SMTP username
        $mail->Password   = ''; //'vytvingulvuoguxk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('gdjevans@hotmail.com', 'UpStack');
        $mail->addAddress($emailTo);     //Add a recipient
        $mail->addReplyTo('no_reply@upstack.com', 'No reply');
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Reset password link has been sent to your email address';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
}

?>

<form method="POST">

    <input type="text" name="email" placeholder="Email" autocomplete="off"/>
    <br />
    <input type="submit" name="submit" value="Reset Email" />

</form>