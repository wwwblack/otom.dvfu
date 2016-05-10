<?php
include("mysql.php");

	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	$sql="SELECT description_item FROM item WHERE description_item LIKE '%$my_data%' ORDER BY description_item";
	$result = mysql_query($sql) or die(mysql_error());
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			echo $row['description_item']."\n";
		}
	}
?>