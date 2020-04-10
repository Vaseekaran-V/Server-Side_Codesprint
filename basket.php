<?php
	include("db.php");
	session_start();
	$total = 0.0;
	$pagename="Meal Cart"; //Create and populate a variable called $pagename
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
	echo "<title>".$pagename."</title>"; //display name of the page as window title
	echo "<body>";
	include ("headfile.html"); //include header layout file
	include("detectlogin.php");
	echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

	if (isset($_POST['delfoodid'])){
		$delprodid = $_POST['delfoodid'];
		unset($_SESSION['basket'][$delfoodid]); // To clear that specific product session array
		echo "<p>1 Item removed</p>";

	}

	if (isset($_POST['f_quantity']) &&  isset($_POST['h_foodid']) ){

		
		$newprodid = $_POST['h_foodid'];
		$requantity = $_POST['f_quantity'];
		
		//create a new cell in the basket session array. Index this cell with the new product id.
		//Inside the cell store the required product quantity
		$_SESSION['basket'][$newfoodid]=$requantity;
		
		//echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];
		echo "<p>1 Item added";

		
	}
	else{
		echo "Current Basket Unchanged";
	}
	
	echo "<form method='POST' action='basket.php'>";
	echo "<table>";
		echo "<tr>";
		echo "<th>Food</th>";
		echo "<th>Price</th>";
		echo "<th>Quantity</th>";
		echo "<th>Subtotal</th>";
		echo "<th></th>";
		echo "</tr>";
		if (isset($_SESSION['basket']) ){
			foreach ($_SESSION['basket'] as $index => $value){
				$SQL="select foodId, foodName, foodPrice, foodQuantity from food where prodid = '".$index."'";
				$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
				$arrayf=mysqli_fetch_array($exeSQL);
				
				echo "<tr>";
				echo "<td>".$arrayf['foodName']	 ."</td>";
				echo "<td>&pound ".$arrayf['foodPrice'] ."</td>";
				echo "<td>".$value."</td>";
				$subtotal = $value * $arrayf['foodPrice'];
				echo "<td>Rs. ".number_format((float)$subtotal, 2, '.', '')."</td>";
				echo "<td><input type='submit' value='Remove'/></td>";
				echo "<input type=hidden name='delprodid' value=".$index.">";
				echo "</tr>";
				$total = $total + $subtotal;
			}
			
		}
		echo "<tr>";
		echo "<td colspan = 3>Total</td>";
		echo "<td>&pound ".number_format((float)$total, 2, '.', '')."</td>";
		echo "<td></td>";
		echo "</tr>";
		echo "</table>";
		echo "</form>";
	//display random text
		echo "<br/><a href='clearbasket.php'>Clear Basket</a><br/><br/>";

		if(isset($_SESSION['userid'])){
			echo "<p>To finalise your order: <a href='checkout.php'>Checkout</a></p>";
		}
		else{
			echo "New Meal Lite Customers: ";
			echo "<a href='signup.php'>Sign up</a><br/>";
			echo "Returning Meal Lite Customers: ";
			echo "<a href='login.php'>Login</a>";
		}

	
	include("footfile.html"); //include head layout
	echo "</body>";
?>