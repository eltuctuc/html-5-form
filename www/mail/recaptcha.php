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

function isAjax() {
	return ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest';
}

if ( isAjax() ) {
	session_start();
	$builder = CaptchaBuilder::create( $_SESSION['phrase'] );

	echo $builder->getPhrase();

	if ( $builder->testPhrase( $_POST['captcha'] ) ) {
		$result = true;
	} else {
		$result = false;;
	}
	echo json_encode(
		array(
			'result' => $result
		)
	);
} else {
	header( 'Location: ../' );
}

