<?
	error_reporting(0);
	$uri=$_GET[uri];
	$myfile = fopen($uri, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($uri));
	fclose($myfile);
?>