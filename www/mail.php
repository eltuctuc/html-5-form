<?php
/**
 * Created by PhpStorm.
 * User: Enrico Reinsdorf
 * Date: 16.08.2014
 * Time: 23:33
 */

// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
$trenner = ":\t"; // Doppelpunkt + Tabulator

/**
 * Ende Konfiguration
 */

/*
if ($_SERVER['REQUEST_METHOD'] === "POST") {

	$header = array();
	$header[] = "From: ".mb_encode_mimeheader($absendername, "utf-8", "Q")." <".$absenderadresse.">";
	$header[] = "MIME-Version: 1.0";
	$header[] = "Content-type: text/plain; charset=utf-8";
	$header[] = "Content-transfer-encoding: 8bit";

	$mailtext = "";

	foreach ($_POST as $name => $wert) {
		if (is_array($wert)) {
			foreach ($wert as $einzelwert) {
				$mailtext .= $name.$trenner.$einzelwert."\n";
			}
		} else {
			$mailtext .= $name.$trenner.$wert."\n";
		}
	}

	mail(
		$zieladresse,
		mb_encode_mimeheader($betreff, "utf-8", "Q"),
		$mailtext,
		implode("\n", $header)
	) or die("Die Mail konnte nicht versendet werden.");
	header("Location: $urlDankeSeite");
	exit;
}

header("Content-type: text/html; charset=utf-8");*/

$json = [
	'test' => 42
];

header('Content-type: application/json; charset=utf-8');
echo json_encode($json);