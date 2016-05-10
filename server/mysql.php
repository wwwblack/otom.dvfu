<?
	$server = "localhost";
	$user = "egor";
	$passer = "48916349";
	$db = "kvs";
	
	mysql_connect($server,$user,$passer) or die("всё пипец");
	mysql_select_db($db) or die("не пашет база");
	?>