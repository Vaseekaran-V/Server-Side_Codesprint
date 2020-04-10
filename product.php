<?php

    session_start();
    include("db.php");
    $pagename="Meals"; //Create and populate a variable called $pagename
    echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
    echo "<title>".$pagename."</title>"; //display name of the page as window title
    echo "<body>";
    include ("headfile.html"); //include header layout file
    include("detectlogin.php");
    echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
    //retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
    //applied to the query string u_prod_id
    //store the value in a local variable called $prodid
    $foodId=$_GET['u_prod_id'];
    $_SESSION['foodID'] = $foodId;
    //display the value of the product id, for debugging purposes
    // echo "<p>Selected Food Id: ".$foodId;
    //display random text
    $SQL="select foodId, foodName, foodPicLarge, foodDescriptionLong, foodPrice, foodQuantity from food where foodId = '".$foodId."'";
    //run SQL query for connected DB or exit and display error message
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp=mysqli_fetch_array($exeSQL))
    {
    echo "<tr>";
    echo "<td style='border: 0px'>";
    //display the small image whose name is contained in the array
    echo "<a href=product.php?u_prod_id=".$arrayp['foodId'].">";
    echo "<img src=images/".$arrayp['foodPicLarge']." height=200 width=200>";
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    echo "<p><h5>".$arrayp['foodName']."</h5>"; //display product name as contained in the array
    echo "<p><h6>".$arrayp['foodDescriptionLong']."</h6>"; //display product name as contained in the array
    echo "<p><h5>&pound ".$arrayp['foodPrice']."</h5>"; //display product name as contained in the array
    // echo "<p><h5> Number left in stock : ".$arrayp['prodQuantity']."</h5>"; //display no of items left as contained in the array
    echo "<p>Number to be purchased: ";
    //create form made of one text field and one button for user to enter quantity
    //the value entered in the form will be posted to the basket.php to be processed
    echo "<form action=basket.php method=post>";
    echo "<select name='p_quantity' >";
    for ($x = 1; $x <= $arrayp['foodQuantity'] ; $x++) {
            echo "<option value='$x'>$x</option>";
    }
    echo "</select>";
    echo "<input type=submit value='ADD TO BASKET'>";
    //pass the product id to the next page basket.php as a hidden value
    echo "<input type=hidden name=h_foodid value=".$foodId.">";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
    include("footfile.html"); //include head layout
    echo "</body>";

?>