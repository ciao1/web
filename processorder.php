<?php
	//create short variable names
	$tireqty=$_POST['tireqty'];
	$oilqty=$_POST['oilqty'];
	$sparkqty=$_POST['sparkqty'];
	$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
	$date=date('H:i,jS F Y');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bob's Auto Parks - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php 
	echo "<p>Order processed at ".date('H:i, jS F Y').".</p>";
	echo "<p>Your order is as follows:</p>";
	$totalqty=0;
	$totalqty=$tireqty+$oilqty+$sparkqty;
	if($totalqty==0){
		echo '<p style="color:red">You did not order anything on the previous page!</p>';
	}else{
		echo $tireqty. ' tires<br/>';
		echo $oilqty. " bottles of oil<br/>";
		echo $sparkqty. ' spark plugs<br />';
	}
	echo "Items ordered: ".$totalqty."<br/>";
	$totalamount=0;

	define('TIREPRICE', 100);
	define('OILPRICE',10);
	define('SPARTPRICE',4);

	$totalamount=$tireqty*TIREPRICE+$oilqty*OILPRICE+$sparkqty*SPARTPRICE;

	echo "Subtotal: ".number_format($totalamount,2)."<br/>";

	$taxrate=0.10;
	$totalamount=$totalamount*(1+$taxrate);
	echo "Total including tax: $ ".number_format($totalamount,2)."<br/>";
	echo '<hr/>';

	/*检测变量是否存在
	echo "isset($tireqty):".isset($tireqty)."<br/>";
	echo 'isset($nothere):'.isset($nothere).'<br/>';
	echo 'empty($tireqty):'.empty($tireqty)."<br/>";
	*/

	$outputstring=$date."\t".$tireqty." tires \t".$oilqty." oil\t"
					.$sparkqty." spark plugs\t\$".$totalamount."\t"."\n";

	//open file for appending
	@ $fp=fopen("e:/web/bookmark/order.txt",'ab');
	if(!$fp){
		echo "<p><strong> Your orde could not be processed at this time.
				please try again later.</strong></p></body></html>";
		exit;
	}

	fwrite($fp,$outputstring,strlen($outputstring));
	flock($fp,LOCK_UN);
	fclose($fp);
	echo "<p>Order written.</p>";
?>
</body>
</html>