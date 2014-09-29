<?php
/**
 * Created by PhpStorm.
 * Project: Weblabor Html5 Formular
 * User: Enrico <$EMAIL>
 * Date: 29.09.2014
 */

include( '../vendor/gregwar/captcha/Gregwar/Captcha/CaptchaBuilderInterface.php' );
include( '../vendor/gregwar/captcha/Gregwar/Captcha/PhraseBuilderInterface.php' );
include( '../vendor/gregwar/captcha/Gregwar/Captcha/CaptchaBuilder.php' );
include( '../vendor/gregwar/captcha/Gregwar/Captcha/PhraseBuilder.php' );

use Gregwar\Captcha\CaptchaBuilder;

session_start();
$builder = CaptchaBuilder::create( $_SESSION['phrase'] );

if ( $builder->testPhrase( $_POST['captcha'] ) ) {
	require 'PHPMailerAutoload.php';

	$mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host       = 'smtp.re-design.de';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth   = true;                               // Enable SMTP authentication
	$mail->Username   = 'web7p3';                           // SMTP username
	$mail->Password   = 'secret';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port       = 587;                                    // TCP port to connect to

	$mail->From     = 'from@example.com';
	$mail->FromName = 'Mailer';
	$mail->setFrom( $_POST['from_email'], $_POST['from_name'] );
	$mail->addAddress( $_POST['to_email'], $_POST['to_name'] );  // Add a recipient

	$mail->WordWrap = 50;                                     // Set word wrap to 50 characters
	$mail->isHTML( true );                                      // Set email format to HTML

	$mail->Subject = $_POST['subject'];
	$mail->Body    = htmlentities( $_POST['message'] );
	$mail->AltBody = strip_tags( $_POST['message'] );

	if ( !$mail->send() ) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
} else {
	header('Location: ../');
}