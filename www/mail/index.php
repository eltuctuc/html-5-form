<?php
/**
 * Mail-Klasse
 * Author: Enrico Reinsdorf
 * Datum (erstellt): 16.08.2014
 * Beispiel aus http://www.sanwebe.com/2011/12/making-simple-jquery-ajax-contact-form
 */

use mail\Mail;

header('Content-type: application/json; charset=utf-8');

$output = array();
$output[] = array( //create JSON data
	'get'=>$_GET,
	'post' => $_POST,
	'request' => $_REQUEST
);

if($_POST)
{
	$to_email       = "myemail@gmail.com"; //Recipient email, Replace with own email here
	$to_name        = "Enrico Reinsdorf"; //Recipient email, Replace with own email here

	//check if its an ajax request, exit if not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

		$output[] = array( //create JSON data
			'type'=>'error',
			'text' => 'Sorry Request must be Ajax POST'
		);
		die(json_encode($output)); //exit script outputting json data
	}

	//Sanitize input data using PHP filter_var().
	$user_name      = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
	$user_email     = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
	$subject        = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
	$message        = filter_var($_POST["msg"], FILTER_SANITIZE_STRING);

	//additional php validation
	if(strlen($user_name)<4){ // If length is less than 4 it will output JSON error.
		$output[] = array('type'=>'error', 'text' => 'Name is too short or empty!');
		die(json_encode($output));
	}
	if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
		$output[] = array('type'=>'error', 'text' => 'Please enter a valid email!');
		die(json_encode($output));
	}
	if(strlen($subject)<3){ //check emtpy subject
		$output[] = array('type'=>'error', 'text' => 'Subject is required');
		die(json_encode($output));
	}
	if(strlen($message)<3){ //check emtpy message
		$output[] = array('type'=>'error', 'text' => 'Too short message! Please enter something.');
		die(json_encode($output));
	}

	$mail = new Mail(array(
		'to_email' => $to_email,
		'to_name' => $to_name,
		'from_email' => $user_email,
		'from_name' => $user_name,
		'subject' => $subject,
		'message' => $message,
		'fields' => array()
	));


	if(!$mail->send())
	{
		//If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
		$output[] = array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.');
		die(json_encode($output));
	}else{
		$output[] = array('type'=>'message', 'text' => 'Hi '.$user_name .' Thank you for your email');
		die(json_encode($output));
	}
} else {
	$output[] = array('type'=>'message', 'text' => 'Kein Post empfangen');
	die(json_encode($output));
}