<!DOCTYPE html>
<html>
<head>
	<title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
	//create short variable names
	$searchtype=$_POST['searchtype'];
	$searchterm=$_POST['searchterm'];
	if(!$searchterm||!$searchtype){
		echo "You have not entered search details.Please go back and try again.";
		exit;
	}
	//检查是否启用魔术引号，如果没有用addslashes函数格式化字符串；
	if(!get_magic_quotes_gpc()){
		//格式化字符串；
		$searchtype=addslashes($searchtype);
		$searchterm=addslashes($searchterm);
	}
	//错误抑制操作符@
	@ $db = new mysqli('localhost','root','ytzx1234','books');
	if(mysqli_connect_errno()){
		echo "Error: Could not connect to database. Please try again later.";
		exit;
	}
	$query="select * from books where ".$searchtype." like '%".$searchterm."%'";
	$result=$db->query($query);

	$num_results=$result->num_rows;

	echo "<p>Number of books find : ".$num_results."</p>";

	for($i=0;$i<$num_results;$i++){
		$row=$result->fetch_assoc();
		echo "<p><strong>".($i+1).".Title: ";
		echo htmlspecialchars(stripcslashes($row['title']));
		echo "</strong><br/>Author: ";
		echo stripcslashes($row['author']);
		echo "<br/>ISBN: ";
		echo stripcslashes($row['isbn']);
		echo "<br/>Price: ";
		echo stripcslashes($row['price']);
		echo "</p>";
	}

	$result->free();
	$db->close();
?>

</body>
</html>