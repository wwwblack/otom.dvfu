<?php
session_start();
include("mysql.php");
$buttonValueForFunction = $_POST['buttonValueForFunction'];
echo $buttonValueForFunction;
switch ($buttonValueForFunction){
	
	case 1:
		$sqlzapros1 = mysql_query("SELECT * FROM f_a_q_question ");
		$resultFAQ = mysql_fetch_array($sqlzapros1);
		if (empty($resultFAQ)) {
			echo '$var или 0, или пусто, или вообще не определена';
		}
		else {
			while ($resultFAQ){
				echo "
				<div class =\"".$resultFAQ['id']."\">
					<div class=\"row\" >
						<div class=\"col-sm-12\">
							".$resultFAQ['question']."	
						</div>
					</div>
					<div class=\"row\" >
						<div class=\"col-sm-12\">
						Ответить</br>
						<textarea id=\"question\" name=\"question\" style=\"width:100%; background-color:#FDF5E6; margin-top:1%;height:150px; margin-left:2%; min-height:10px;resize:none;\"></textarea></br>
						<button id=\"addAnswer\"  style=\"margin-left:77%;\" value=\"3\" type=\"submit\">
							Потвердить
						</button>	
						</div>
					</div>
				</div>
				";
			}
		}
	break;
	
	//Добавления вопроса к Факу
	case 2:
		$f_a_q_question = $_POST['f_a_q_question'];
		$f_a_q_question = mysql_real_escape_string($f_a_q_question);
		$id_user = $_SESSION['id'];
		$sqlzapros2 = mysql_query("INSERT INTO `f_a_q_question` (`id_item`, `id_user`, `question`, `executed`) VALUES ('0', '$id_user', '$f_a_q_question', '0')");
		echo mysql_error();
		echo "i am add vopros";
	break;
	
	
}	
?>