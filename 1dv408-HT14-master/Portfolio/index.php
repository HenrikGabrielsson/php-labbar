<?php



require_once("../common/HTMLView.php");
require_once("src/controller/Portfolio.php");
	
$view = new HTMLView();

$vpc = new \controller\Portfolio();

$htmlBody = $vpc->selectPortfolio();

$view->echoHTML($htmlBody);
