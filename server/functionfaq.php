<?php
session_start();
include("mysql.php");
$buttonValueForFunction = $_POST['buttonValueForFunction'];
switch ($buttonValueForFunction){
	
	case 1:
		$i = 20;
		$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
		$sqlzapros1 = mysql_query("SELECT * FROM f_a_q_question WHERE `id_brend` = '$htmlSelectOfBrend' ");
			while ($resultFAQ = mysql_fetch_array($sqlzapros1)){
				$i++;
				echo "
				<div class =\"".$resultFAQ['id']."\">
					<div class=\"row\" style=\" box-shadow: 0 0 5px; border-left: 1px solid black; border-right: 1px solid black;\" >
						<div class=\"col-sm-12\">
							".$resultFAQ['question']."	
							<button class=\"btn btn-success btn-md\"  id=\"questionExecuted\"  style=\"margin-left:92%;\" value=\"4\" type=\"submit\">
								Разрешён
							</button>
							<br>
							Ответить
							<br>
							<textarea id=\"question\" name=\"question\" style=\"width:90%; background-color:#FDF5E6; margin-top:1%;height:50px; margin-left:2%; min-height:10px;resize:none;\"></textarea></br>
							<button class=\"btn btn-primary btn-md\"  id=\"addAnswer\"  style=\"margin-left:83%;\" value=\"3\" type=\"submit\">
								Потвердить
							</button>
							
									<div class=\"panel panel-default\" >
										<div class=\"panel-heading\">
											<h4 class=\"panel-title\">
												<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#".$i."\">
													Посмотреть ответы
												</a>
											</h4>
										</div>
										<div id=\"".$i."\" class=\"panel-collapse collapse\">
											<div class=\"panel-body\">
											Для того чтобы решить эту проблему, попробуй нажать на кнопку старт. А так же проверь комутацию. куда идёт in и  out. 
											<br>
											<a>Егор</a>
											</div>
										</div>
									</div>								
						</div>
					</div>
				</div>
				<hr>
				";
			}
	break;
	
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