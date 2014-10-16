<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="de"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="de"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Html5 Formular &ndash; Weblabor</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main.css">

	<script src="components/modernizr/modernizr.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">HTML5 Formular</a>
		</div>
		<div class="navbar-collapse collapse">
		</div>
		<!--/.navbar-collapse -->
	</div>
</div>

<div class="container">
	<form id="contact-form" role="form" action="mail/mailer.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
		<div id="contact-body">
			<div class="form-group required">
				<label for="inputName">Vor- und Familienname</label>
				<input type="text"
				       class="form-control"
				       id="inputName"
				       name="fromName"
				       placeholder="Vorname Nachname"
				       value="eltuctuc"
				       required="">
				<span class="help-block"></span>
			</div>
			<div class="form-group required">
				<label for="inputEmail">Email Adresse</label>
				<input type="email"
				       class="form-control"
				       id="inputEmail"
				       name="fromEmail"
				       placeholder="beispiel@gmail.com"
				       value="enrico@re-design.de"
				       required="">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label for="inputSubject">Betreff</label>
				<input type="text"
				       class="form-control"
				       id="inputSubject"
				       name="subject"
				       placeholder="Betreff"
				       value="test"
					>
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label for="inputMessage">Nachricht</label>
				<textarea
					class="form-control"
					id="inputMessage"
					name="message"
					placeholder="Deine Nachricht"
					></textarea>
				<span class="help-block"></span>
			</div>
			<div class="form-group required">
				<label for="inputCaptcha">Code-Eingabe</label>
				<input type="text" class="form-control" id="inputCaptcha" name="captcha" placeholder="Gib die Daten des Bildes ein" required="" data-captcha-script="./mail/captcha.php">

				<div id="contact-result-captcha" class="form-"></div>
			</div>
			<button id="contact-submit" type="submit" class="btn btn-default">Abschicken</button>
		</div>
		<hr>
		<div id="contact-success" class="panel panel-success">
			<div class="panel-heading">
				<p class="panel-title">Nachricht verschickt</p>
			</div>
			<div class="panel-body">
				<p>Ihre Nachricht wurde erfolgreich verschickt</p>
			</div>
		</div>
		<div id="contact-failed" class="panel panel-danger">
			<div class="panel-heading">
				<p class="panel-title">Übermittlungsfehler</p>
			</div>
			<div class="panel-body">
				<p>Es ist ein Fehler aufgetreten. Versuchen Sie es später noch einmal oder oder schreiben sie eine Mail per <a href="mailto:info@webundprintdesign.de">info@webundprintdesign.de</a>.</p>
			</div>
		</div>
	</form>

	<hr>

	<footer>
		<p>&copy; RE-Design 2014</p>
	</footer>
</div>
<!-- /container -->

<script src="components/jquery/dist/jquery.min.js"></script>
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="js/jquery-captcha.js"></script>
<script src="js/jquery-phpmailerconfig.js"></script>
<script src="js/main.js"></script>
</body>
</html>
