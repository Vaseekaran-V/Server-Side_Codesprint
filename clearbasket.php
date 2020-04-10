<?php
	session_start();
	include("db.php");
	$pagename="Template"; //Create and populate a variable called $pagename
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
	echo "<title>".$pagename."</title>"; //display name of the page as window title
	echo "<body>";
	include ("headfile.html"); //include header layout file
	echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

	unset($_SESSION['basket']); // To clear the session array

	echo "Your basket has been cleared ! ";

	
	//display random text
	include("footfile.html"); //include head layout
	echo "</body>";
?>