<?php
require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$name = 'Admin';
$email = 'info@goldplatedjewellery.com';
$subject = 'My Own Account';
$toemail = 'salam.pustcse@gmail.com'; // Your Email Address
$toname = 'Md.Abdus Salam'; // Your Name
$mail->SetFrom($email, '');
$mail->AddAddress($toemail, '');
$mail->Subject = $subject;
$Step = '<p>To access your track my visitor trial, please 
						<a target="_blank" href="' . $SiteBaseUrl . 'complete-registration.php?first_name=' . $FirstName . '&last_name=' . $LastName . '&email=' . $EmailAddress . '&companyid=' . $lastCompanyId . '">register</a> and get started right away</p><br><br>';

$referrer = '-track my visitor Team';
$body = "$Step $referrer";
$mail->MsgHTML($body);
$sendEmail = $mail->Send();
?>