<?php
/**
 * Created by PhpStorm.
 * Project: Weblabor Html5 Formular
 * User: Enrico <$EMAIL>
 * Date: 29.09.2014
 */
include('../vendor/gregwar/captcha/Gregwar/Captcha/CaptchaBuilderInterface.php');
include('../vendor/gregwar/captcha/Gregwar/Captcha/PhraseBuilderInterface.php');
include('../vendor/gregwar/captcha/Gregwar/Captcha/CaptchaBuilder.php');
include('../vendor/gregwar/captcha/Gregwar/Captcha/PhraseBuilder.php');

use Gregwar\Captcha\CaptchaBuilder;
session_start();

header('Content-type: image/jpeg');

$builder = CaptchaBuilder::create();
$builder->build();

// Example: storing the phrase in the session to test for the user
// input later
$_SESSION['phrase'] = $builder->getPhrase();

$builder->output();