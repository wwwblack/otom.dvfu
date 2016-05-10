<?php
session_start();
include("mysql.php");
$buttonValueForFunction = $_POST['buttonValueForFunction'];

switch ($buttonValueForFunction){
	
	case 2:
	$f_a_q_question = $_POST['f_a_q_question'];
	$f_a_q_question = mysql_real_escape_string($f_a_q_question);
	$id_user = $_SESSION['id'];
	$sqlzapros3 = mysql_query("INSERT INTO `f_a_q_question` (`id_item`, `id_user`, `question`, `executed`) VALUES ('0', '$id_user', '$f_a_q_question', '0')");
	echo mysql_error();
	echo "i am add vopros";
	break;
}	
?>