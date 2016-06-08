<?php
session_start();
include("mysql.php");
$buttonValueForFunction = $_POST['buttonValueForFunction'];
switch ($buttonValueForFunction){
	
	case 1:
		
	
	//Добавления вопроса к Факу
	case 2:
		$htmlSelectOfBrendForAddQuestion = $_POST['htmlSelectOfBrendForAddQuestion'];
		$f_a_q_question = $_POST['f_a_q_question'];
		//$f_a_q_question = mysql_real_escape_string($f_a_q_question);
		$id_user = $_SESSION['id'];
		$sqlzapros2 = mysql_query("INSERT INTO `f_a_q_question` (`id_brend`, `id_user`, `question`, `executed`) VALUES ('$htmlSelectOfBrendForAddQuestion', '$id_user', '$f_a_q_question', '0')");
		echo mysql_error();
	break;
	
	
}	
?>