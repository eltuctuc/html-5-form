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

include( '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php' );

use Gregwar\Captcha\CaptchaBuilder;

session_start();
if(!array_key_exists('phrase', $_SESSION)) {
	http_response_code(400);
	echo json_encode('Session nicht gesetzt');
	exit;
}

if( count( $_POST ) === 0 ) {
	http_response_code(400);
	echo json_encode('Keine Daten gefunden');
	exit;
}

$builder = CaptchaBuilder::create( $_SESSION['phrase'] );
if(!$builder->testPhrase($_POST['captcha'])) {
	http_response_code(400);
	echo json_encode('Captcha falsch', $_POST['captcha'], $_SESSION['phrase']);
	exit;
}

$fields = [];
foreach($_POST as $key => $value) {
	$fields['{{{'.strtoupper($key).'}}}'] = nl2br(strip_tags($value));
}

$message = file_get_contents( 'templates/email.phtml' );
$message = preg_replace(array_keys($fields), array_values($fields), $message);

$mail = new PHPMailer();
//$mail->SMTPDebug = 3;                                       // Enable verbose debug output

$mail->isSMTP();                                              // Set mailer to use SMTP
$mail->Host       = 'smtp.re-design.de';                      // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                     // Enable SMTP authentication
$mail->Username   = 'web7p3';                                 // SMTP username
$mail->Password   = '3YdTKN6e';                                       // SMTP password
$mail->SMTPSecure = 'tls';                                    // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 587;                                      // TCP port to connect to

$mail->setFrom( $_POST['fromEmail'], $_POST['fromName'] );
$mail->addAddress( $_POST['toEmail'], $_POST['toName'] );  // Add a recipient

$mail->WordWrap = 50;                                        // Set word wrap to 50 characters
$mail->isHTML( true );                                       // Set email format to HTML

$mail->Subject = $_POST['subject'];
$mail->Body    = $message;
$mail->AltBody = strip_tags( $message );

if ( !$mail->send() ) {
	http_response_code(400);
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	http_response_code(200);
	echo 'Message has been sent';
}
