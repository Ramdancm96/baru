<?php
if (basename($_SERVER["SCRIPT_NAME"]) != 'index.php') die(basename($_SERVER["SCRIPT_NAME"]));
nav('Footer Pages');
if (!$step) {
	c('<i>Not available in Community Edition</i>');
}