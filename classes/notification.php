<?php
class Notification{
public function Send_Mail($from, $password,$receivers,$body )
{
  $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;smtp-relay.gmail.com;aspmx.l.google.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $from;                 // SMTP username
$mail->Password = $password;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($from, 'File intrusion detection system');
foreach ($receivers as $email=>$phone)
{
$mail->addAddress($email);     // Add a recipient
}
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Intusion Alert';
$mail->Body    = $body;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}

public function send_sms($receivers,$msg){

foreach($receivers as $email=>$phone){
$surl ="http://www.smslive247.com/http/index.aspx?cmd=login&owneremail=".urlencode("contactus@gloryiconlimited.com")."&"
        . "subacct=".urlencode("FIDS")."&subacctpwd=".urlencode("@fids$");
if ($f = @fopen($surl, "r")):
$answer = fgets($f, 255);
$session_id = substr($answer, 3);
$send ="FIDS";
  $rar = str_split($phone);
  $phone = ($rar[0]=='0') ? $phone : '0'.$phone;
$srl="http://www.smslive247.com/http/index.aspx?cmd=sendmsg&sessionid=".str_replace("+", "", urlencode($session_id))."&"
        . "message=".urlencode($msg)."&sender=".urlencode($send)."&sendto=".urldecode($phone)."&msgtype=0";
if ($s = @fopen($srl, "r"))
{$answer = fgets($s, 255);}

endif;
}
}

}
