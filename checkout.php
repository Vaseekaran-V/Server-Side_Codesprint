<?php
	session_start();
	include("db.php");
	$pagename="Order Confirmation"; //Create and populate a variable called $pagename
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
	echo "<title>".$pagename."</title>"; //display name of the page as window title
	echo "<body>";
	include ("headfile.html"); //include header layout file
	include("detectlogin.php");
	echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

	$currentdatetime = date('Y-m-d H:i:s');

	$userId = $_SESSION['userid'];


	$SQL = "insert into Orders (userId, orderDateTime) values ($userId, '$currentdatetime')";

	$total = 0;
	if (mysqli_query($conn, $SQL)) {
		if(mysqli_errno($conn) == 0){
			$SQL2 = "select MAX(orderNo) as maxOrderNo from orders where userId=$userId";
			$exeSQL2 = mysqli_query($conn, $SQL2) or die (mysqli_error($conn));
			$arrayord = mysqli_fetch_array($exeSQL2);
			$orderNo = $arrayord['maxOrderNo'];
			echo "The Order has been placed successfully. Order No : $orderNo ";

			echo "<table>";
			echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Price</th>";
			echo "<th>Quantity</th>";
			echo "<th>Subtotal</th>";
			echo "</tr>";
			if (isset($_SESSION['basket']) ){
				foreach ($_SESSION['basket'] as $index => $value){
					$SQL3="select prodId, prodName, prodPrice, prodQuantity from w1742229_hometeq where prodid = '".$index."'";
					$exeSQL3=mysqli_query($conn, $SQL3) or die (mysqli_error($conn));
					$arrayb=mysqli_fetch_array($exeSQL3);
					
					echo "<tr>";
					echo "<td>".$arrayb['prodName']	 ."</td>";
					echo "<td>&pound ".$arrayb['prodPrice'] ."</td>";
					echo "<td>".$value."</td>";
					$subtotal = $value * $arrayb['prodPrice'];
					echo "<td>&pound ".number_format((float)$subtotal, 2, '.', '')."</td>";
					echo "</tr>";
					$total = $total + $subtotal;

					$SQL4 = "insert into order_line (orderNo, prodId, quantityOrdered, subTotal) values($orderNo, $index, $value, $subtotal)";
					$exeSQL4=mysqli_query($conn, $SQL4) or die (mysqli_error($conn));

					

				}
				
			}
			echo "<tr>";
			echo "<td colspan = 3>ORDER TOTAL</td>";
			echo "<td>&pound ".number_format((float)$total, 2, '.', '')."</td>";
			echo "<td></td>";
			echo "</tr>";
			echo "</table>";

			echo "<br/><a href='logout.php'>Logout</a><br/><br/>";

		}
	}
	else{
		echo "Error in placing the Order";
	}

	unset($_SESSION['basket']);
	
	include("footfile.html"); //include head layout
	echo "</body>";
?>