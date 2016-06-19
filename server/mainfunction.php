<?php
session_start();
include("mysql.php");
mysql_query("SET NAMES 'utf8';");


//функция отвечающая за вывод списка оборудования на страницу main.php  выволняется кнопкой номер 1.
function funcionViewContentOnMainPage() {
	
	$htmlSelectOfType_item = $_POST['htmlSelectOfType_item'];
	$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
	$htmlSelectOfRoom = $_POST['htmlSelectOfRoom'];
	$htmlButtonValue= $_POST['htmlButtonValue'];
        $textSearch = $_POST['textSearch'];
	
	$sqlZaprosForViewContent = "SELECT item.id, item.id_type_item, item.id_brend, item.id_position, item.Containerboard_number  ,item.description_item, item.img_item, item.given, brend.title as titleOfBrend, room.position_name as nameOfPosition, type_item.name_type_item as itemTypeName   FROM item 
										JOIN brend ON (brend.id=item.id_brend)
										JOIN room ON (room.id=item.id_position)
										JOIN type_item ON (type_item.id=item.id_type_item)
										WHERE `item`.`given` = '0' ";
										echo mysql_error();	
										if ($htmlSelectOfType_item){
											$sqlZaprosForViewContent .= " AND `item`.`id_type_item` = $htmlSelectOfType_item";
											echo mysql_error();	
										}
										if ($htmlSelectOfBrend){
											$sqlZaprosForViewContent .= " AND `item`.`id_brend` = $htmlSelectOfBrend";
											echo mysql_error();	
										}
										if ($htmlSelectOfRoom){
											$sqlZaprosForViewContent .= " AND `item`.`id_position` = $htmlSelectOfRoom";
											echo mysql_error();	
										}
                                                                             /*   if ($textSearch){
											$sqlZaprosForViewContent .= "A LIKE $textSearch";
											echo mysql_error();	
										}*/
	//Подсчёт строк
	//----------------------------------------------------------
	
	//----------------------------------------------------------
			
				echo mysql_error();
				$result_set = mysql_query($sqlZaprosForViewContent);
				$result = mysql_fetch_array($result_set);
				//Проверяем на пустоту массива.
				if (empty($result)) {
					echo '';
				}
				else {
					//через уайл загружаем имеющиеся объекты
					$i = 0;
					while ($result = mysql_fetch_array($result_set)){
						// Мой паповер вывод картинки
						$i++;
						echo "
						<div class =\"".$result['id']."\">
							<div class=\"row\"  style=\"margin-top: 2px;\" >
							<div class=\"col-sm-1 hidden-xs hidden-sm\">
							".$i."
							</div>
								<div class=\"col-sm-1\"  >
									<button type=\"button\" class=\"btn btn-primary\" id=\"myPopover\" data-toggle=\"popover\" data-contentwrapper=\"#mypopover_".$result['id']."\">IMG</button>
									<div id=\"mypopover_".$result['id']."\" style=\"display: none;\">
									  <div class=\"alert alert-danger\"><img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"150\" height=\"150\"></div>
									</div>
								</div>
						";
				
						echo "	
								<div class=\"col-sm-2\">
									".$result['nameOfPosition']."
								</div>
								
							";	
						
						echo "
								<div class=\"col-sm-3\"style=\"border-left: 1px solid black;\">
									".$result["description_item"]."
								</div>
                                <div class=\"col-sm-2\"style=\"border-left: 1px solid black;\">
									".$result["Containerboard_number"]."
								</div>
						";
						//В батон записываем айди item и логин пользователя и отправляем для дальнейшей обработки	
						echo "	<form method=\"POST\">
								<div class=\"col-sm-2\"style=\"border-left: 1px solid black;\">	
									<input type=\"date\" id=\"dataname".$result["id"]."\" style=\"\" name=\"days\" class=\"form-control\"/>
								</div>
								<div class=\"col-sm-1\" style=\"border-left: 1px solid black;\">
									<div>
									
									<button name=\"addItem\" type=\"submit\" class=\"btn btn-md btn-primary\" value=\"".$result["id"].":".$_SESSION['id']."\" >Взять</button>
									</form>
									</div>
								</div>
								<div class=\"col-sm-3\" style=\"border-left: 1px solid black; \"></div>
						</div>
						</div>
						<div class=\"hidden-md hidden-lg\"><hr></div>
						";
					}
				}	
				echo "
						<script type=\"text/javascript\">
							$(function () {
							  $('[data-toggle=\"popover\"]').popover({
								html:'true',
								trigger: 'hover',
								placement: 'right',
								content: function() {  return $($(this).data('contentwrapper')).html(); }
							  })
							 
							})
						</script>
						
					";
}
//Функция отвечающая за вывод информации на страницу ФАКА. 
function functionViewContentOnFAQPage(){
	$i = 20;
		$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
		$sqlzapros1 = mysql_query("SELECT * FROM f_a_q_question");
		echo mysql_error();
			while ($resultFAQ = mysql_fetch_array($sqlzapros1)){
				
				//данная переменная для вложенного while
				$idVopros = $resultFAQ['id'];
				
				$i++;
				echo "
				<div class =\"".$resultFAQ['id']."\">
					<div class=\"row\" style=\" box-shadow: 0 0 5px;\" >
						<div class=\"row\">
							<div class=\"col-sm-10\">
								".$resultFAQ['question']."
							</div>
							
							
							
				";	
					$a = $resultFAQ['id_user'];
						$c = $resultFAQ['executed'];
						$b = $_SESSION['id'];	
					if ($c==1){
							echo"<div class=\"col-sm-1\"></div><div class=\"col-sm-1\"><img src=\"img/sucsses.jpg\" height=\"30\"></div>";
						}
					elseif( $a==$b ){
							echo " <script type=\"text/javascript\">
									//Скрипт для добавления  ответа
									$(\"#questionExecuted".$resultFAQ['id']."\").bind(\"click\", function (){
										var questionExecuted = document.getElementById(\"questionExecuted".$resultFAQ['id']."\").value;
										$.ajax ({
											url: \"server/functionAjax.php\",
											type: \"POST\",
											data: ({questionExecuted: questionExecuted, functionAdmin: 13}),
											dataType: \"text\",
											beforeSend: funcBefore,
											success: funcSuccess
										});
									});
									</script>
									<div class=\"col-sm-2\">
									<button class=\"btn btn-success btn-sm\"  id=\"questionExecuted".$resultFAQ['id']."\" value=\"".$resultFAQ['id']."\" type=\"submit\">
										Разрешён
									</button>
									</div>
							";
						
					}
			
				echo "				
							
						</div>
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
					";					
										$idUser_Array = Array();
										$sql90 = mysql_query("SELECT f_a_q_answer.answer, users.name as nameOfUser
															  FROM f_a_q_answer 
															  JOIN users ON (users.id = f_a_q_answer.id_user) 
															  WHERE id_question = $idVopros");
										while ($result3 = mysql_fetch_array($sql90)) {
											echo "
												<div>".$result3["answer"]."</div><br>
												<div>".$result3["nameOfUser"]."</div>
											";	
										}
										/*foreach ($idVopros_Array as $vopros_iddd){
											$idUser_Array[] = $result3["id_user"];
										}
											Для того чтобы решить эту проблему, попробуй нажать на кнопку старт. А так же проверь комутацию. куда идёт in и  out. 
											<br>
											<a>Егор</a>
										*/
					echo "				</div>
									</div>
								</div>
							<div class=\"row\"><div class=\"col-sm-6\">Напишите свой вариант решения проблемы</div></div>	
							<div class=\"row\">
								<script type=\"text/javascript\">
									//Скрипт для добавления  ответа
									$(\"#addAnswer".$resultFAQ['id']."\").bind(\"click\", function (){
										var button_update_brend = document.getElementById(\"button_update_brend".$result["id"]."\").value;
										var update_brend = document.getElementById(\"update".$result["id"]."\").value;
										$.ajax ({
											url: \"server/functionAdmin.php\",
											type: \"POST\",
											data: ({button_update_brend: button_update_brend, update_brend: update_brend, functionAdmin: 4}),
											dataType: \"text\",
											beforeSend: funcBefore,
											success: funcSuccess
										});
									});
									//Скрипт для кнопочка разрешён
									$(\"#Answer".$resultFAQ['id']."\").bind(\"click\", function (){
										var delete_posiotion_name = document.getElementById(\"delete_brend".$result["id"]."\").value;
										$.ajax ({
												url: \"server/functionAdmin.php\",
												type: \"POST\",
												data: ({delete_brend: delete_brend, functionAdmin: 2}),
												dataType: \"text\",
												beforeSend: funcBefore,
												success: funcSuccess
										});
									});
										
								
								</script>
								<div class=\"col-sm-6\">
								<textarea id=\"Answer".$resultFAQ['id']."\" name=\"Answer".$resultFAQ['id']."\" style=\"width:100%; background-color:#FDF5E6; margin-top:1%;height:50px; margin-left:2%; min-height:10px;resize:none;\"></textarea>
								</div>
								<div class=\"col-sm-6\"><br>
									<button class=\"btn btn-primary btn-md\"  id=\"addAnswer".$resultFAQ['id']."\" value=\"3\" type=\"submit\">Подтвердить</button>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<hr>
				";
			}
}
//функция отвечающая за добавление новоо вопроса в FAQ
function functionAddNewQuestion(){
	$htmlSelectOfBrendForAddQuestion = $_POST['htmlSelectOfBrendForAddQuestion'];
		$f_a_q_question = $_POST['f_a_q_question'];
		$id_user = $_SESSION['id'];
		$sqlzapros2 = mysql_query("INSERT INTO `f_a_q_question` (`id_brend`, `id_user`, `question`, `executed`) VALUES ('$htmlSelectOfBrendForAddQuestion', '$id_user', '$f_a_q_question', '0')");
		echo mysql_error();
		
}

function functionAddNewUrlManual(){
    $urlManual = $_POST['urlManual'];
    $descriptionManual = $_POST['descriptionManual'];
    $htmlSelectOfBrendForManual = $_POST['htmlSelectOfBrendForAddManual'];
    $idUser = $_SESSION['id'];
    $sqlzapros29 = mysql_query("INSERT INTO `manuals` (`id_brend`, `description`, `url`, `id_user`) VALUES ('$htmlSelectOfBrendForManual', '$descriptionManual', '$urlManual', '$idUser')");
	echo "<script type=\"text/javascript\">
			alert(\"URL для мануала успешно добавлена\");
		  </script>	
	";
    echo mysql_error();
}

function functionFindManual(){
    
    $htmlSelectOfBrendForFindManual = $_POST['htmlSelectOfBrendForFindManual'];
    $sqlzapros09 = "SELECT * FROM manuals";
                                                    if ($htmlSelectOfBrendForFindManual){
                      					$sqlzapros09 .= " WHERE `id_brend` = '$htmlSelectOfBrendForFindManual'";
                                                        echo mysql_error();	
                                                    }
    $result_setsqlzapros09 = mysql_query($sqlzapros09);
    while ($resultFindManuals = mysql_fetch_array($result_setsqlzapros09)){
				echo "
				<div class =\"".$resultFindManuals['id']."\">
					<div class=\"row\" style=\" box-shadow: 0 0 5px; border-left: 1px solid black; border-right: 1px solid black;\" >
                                            <div class=\"col-sm-2\">
                                            </div>
                                            <div class=\"col-sm-6\">
                                            	<label for=\"recipient-name\" class=\"control-label\">Ссылка</label>
						<br>
                                                <a href=\"".$resultFindManuals['url']."\" rel=\"external\">".$resultFindManuals['url']."</a></br>
                                                <label for=\"recipient-name\" class=\"control-label\">Дополнительное описание</label>    
						<p>".$resultFindManuals['description']."</p>														
                                            </div>
                                            <div class=\"col-sm-4\">
                                            </div>
					</div>
				</div>
				<hr>
				";
    }
}

//Обновление 
function functionQuestionExecuted(){
	$sqlzapros1 = mysql_query("UPDATE `room` SET  `position_name` = '$update_position_name' WHERE `id` = '$id_position_name'");
	echo mysql_error();
	echo "Название аудитории обновлено";
}

?>