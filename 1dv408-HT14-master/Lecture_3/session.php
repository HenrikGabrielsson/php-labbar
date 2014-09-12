<?php

session_start();

if (isset($_SESSION["pagereload"]) == false) {
	$_SESSION["pagereload"] = 1;
	echo "Welcome! First reload";
} else {
	$_SESSION["pagereload"]++;

	echo "Welcome! num reloads : " . $_SESSION["pagereload"];
}