<!DOCTYPE html>
<html>
<head>
	<title>Bob's Auto Parts - Customer Orders</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Customer Orders</h2>
<?php 
	@$fp=fopen("e:/web/bookmark/order.txt",'rb');
	if(!$fp){
		echo "<p><strong>No orders pending.Please try again later.</strong></p>";
		exit;
	}

	while(!feof($fp)){
		$order=fgets($fp,999);
		echo $order."<br/>";
	}
	?>
</body>
</html>