<?php
require 'mailer/PHPMailerAutoload.php';
include_once "classes/notification.php";
include_once "classes/watcher.php";

$path = "files";
$watcher =  new Watcher();
$notifier = new Notification();
$watcher->watchPath($path);

$sender_email = "avoseh.pedetin@gmail.com";
$sender_password = "25031994";

$admins = array("avoseh.pedetin@gmail.com"=> "07032148388", "timotewpeters@gmail.com" => "08035387514");


$note = function() use ($notifier, $admins, $sender_email, $sender_password) {
$arguments = func_get_args();
$file = $arguments[0][0];

//lock the files
chmod($file, 0644);
$date = date("d-m-y h:i:s",time());
//send Notification
$body = "Dear Admin,\n there has been and intrusion in the file system. File {$file} has been modifed on {$date}.\n
The file permission has been set to 0644 to prevent further mofications. ";
$notifier->send_sms($admins,$body);

$notifier->Send_Mail($sender_email,$sender_password,$admins, $body);

};

$watcher->addListener($note);
$watcher->watch();
