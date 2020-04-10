<?php
session_start();
include ("db.php");


$pagename = "Choices of Food"; //create and populate a variable called $pagename
echo "<link rel = \"stylesheet\" type = \"text/css\" href = \"mystylesheet.css\">"; //call in stylesheet

echo "<title>".$pagename."</title>"; //display the name of the page as window title

echo "<body>";
include ("headfile.html");   //include header layout file
include ("detectlogin.php");

echo "<h4>".$pagename."</h4>";  //display the name of the page on the webpage

//create a sql variable and populate it with a sql statement that gets the product details
$SQL = "SELECT * from food";
//run SQL query for connected DB or exit and display error message
$exeSQL = mysqli_query($conn, $SQL) or die;

echo "<table style = 'border: 0px'>";

//create an array of records and populate the arrays with the records got from the SQL
//iterate through the array until the end is reached.

while($arrayp = mysqli_fetch_array($exeSQL)){
    echo "<tr>";
    echo "<td style = 'border: 0px'>";
    //display the small image name which is in the db/array
    echo "<a href = orderfood.php?u_food_id=".$arrayp['foodId'].">";
    echo "<img src = images/".$arrayp['foodPicSmall']." height = 180 width = 220>";
    echo "</a>";
    echo "</td>";
    echo "<td style = 'border : 0px'>";
    echo "<p><h5>".$arrayp['foodName']."</h5>"; //displaying the product name as in the array
    echo "<p>".$arrayp['foodDescriptionShort']."</p>"; // displaying the small description
    echo "<b> Rs ".$arrayp['foodPrice']."</b>";
    echo "</td>";
    echo "</tr>";

}
echo "</table>";

include ("footfile.html"); //include footer layout
echo "</body>";
?>