<?php
session_start();
include("mysql.php");
include("function.php"); 
$userlist = $_POST['userlist'];



switch ($userlist){
	
	case 1:
	//Тут будет вся информация о пользователях и функции для редактирования личной информации,
	//	а так же удание их из БАЗЫ ДАННЫХ а так же добаление новых пользователей  
	echo "
		<!-- Тут будет вся информация о пользователях и функции для редактирования личной информации,
		а так же удание их из БАЗЫ ДАННЫХ а так же добаление новых пользователей   -->
	<div class=\"container\">
		<div class=\"row\" >
			<div class=\"col-sm-8\">
			<div style = \"text-align: center;\">
							<h1>Все пользователи</h1>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">Login
								</td>
								<td border=\"2\">Password
								</td>
								<td border=\"2\">Name
								</td>
								<td border=\"2\">LastName
								</td>
								<td border=\"2\">E-mail
								</td>
								<td border=\"2\">Телефон
								</td>
								<td border=\"2\">Привелегии
								</td>
								<td border=\"2\">Удалить
								</td>
							</tr>
	";				
							$result_set = mysql_query("SELECT * FROM users");
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
									echo "<td>".$result["login"]."</td>";
									echo "<td>".$result["pass"]."</td>";
									echo "<td>".$result["name"]."</td>";
									echo "<td>".$result["last_Name"]."</td>";
									echo "<td>".$result["e-mail"]."</td>";
									echo "<td>".$result["phone"]."</td>";
									echo "<td>".$result["privilege"]."</td>";
									echo "<td><input type=\"submit\" method=\"post\" name=\"del\" value= ".$result["id"]." /></td> ";
								echo "</tr></form>";
							}
							
							if( isset( $_POST['del'] ) )
								{
									echo $_POST['del'];
									//$id = $result["id"];
									$delete = mysql_query ("DELETE FROM `users` WHERE `id` = ".$_POST["del"]);
									echo 'Ты нажяль!';
								}
	echo "						
							</table>
                        
						</div>
			</div>
		</div>
		</div>	
	";
	break;
	
	case 2:
	//тут мы вызываем информацию об аудиториях, можно редактировать, и удалить не нужную аудиторию.	
	echo "
	<script type=\"text/javascript\">
		//Скрипт для добаления новой аудитории
			$(\"#add_room\").bind(\"click\", function (){
				
				var name_new_room = document.getElementById(\"name_new_room\").value;
				$.ajax ({
					url: \"server/functionAdmin.php\",
					type: \"POST\",
					data: ({name_new_room: name_new_room, functionAdmin: 3}),
					dataType: \"text\",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
	</script>		
	<div class=\"container\">
		<div class=\"row\" >
			<div class=\"col-sm-8\">
			<div style = \"text-align: center;\">
							<h1>Аудитории</h1>
							<div id=\"informationRoom\"> </div>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">
								<input type=\"text\" size=\"50\" id=\"name_new_room\"/>
								</td>
								<td border=\"2\">
								<button id=\"add_room\" value\"3\">Добавить</button>
								</td>
							</tr>
							<hr>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">Название аудитории
								</td>
								<td border=\"2\">Редактировать
								</td>
								<td> </td>
								<td border=\"2\">Удалить
								</td>
							</tr>
	";				
							$result_set = mysql_query("SELECT * FROM room");
							while ($result = mysql_fetch_array($result_set)) {
								echo "
								<script type=\"text/javascript\">
									
									//Скрипт для редактирования информации об аудиториях
									$(\"#button_update_position_name".$result["id"]."\").bind(\"click\", function (){
										var button_update_position_name = document.getElementById(\"button_update_position_name".$result["id"]."\").value;
										var update_position_name = document.getElementById(\"update".$result["id"]."\").value;
										$.ajax ({
											url: \"server/functionAdmin.php\",
											type: \"POST\",
											data: ({button_update_position_name: button_update_position_name , update_position_name: update_position_name, functionAdmin: 1}),
											dataType: \"text\",
											beforeSend: funcBefore,
											success: funcSuccess
										});
									});
									
									//Скрипт для удаления записи об аудитории
									$(\"#delete_posiotion_name".$result["id"]."\").bind(\"click\", function (){
										var delete_posiotion_name = document.getElementById(\"delete_posiotion_name".$result["id"]."\").value;
										$.ajax ({
												url: \"server/functionAdmin.php\",
												type: \"POST\",
												data: ({delete_posiotion_name: delete_posiotion_name, functionAdmin: 2}),
												dataType: \"text\",
												beforeSend: funcBefore,
												success: funcSuccess
										});
									});
										
								
								</script>	
									<tr>
									<td>".$result["position_name"]."</td>
									<td><input id=\"update".$result["id"]."\" type=\"text\" name=\"position_name\" size=\"30%\" autocomplete=\"off\"  placeholder=\"".$result["position_name"]."\"></td>
									<td><button  class=\"btn btn-primary btn-md\" id=\"button_update_position_name".$result["id"]."\" value= \"".$result["id"]."\">Редактировать </button></td>
									<td><button class=\"btn btn-primary btn-md\" id=\"delete_posiotion_name".$result["id"]."\" value=".$result["id"].">Удалить</button></td>
								 </tr>";
							}		
	echo "						
							</table>
                        
						</div>
			</div>
		</div>
		</div>	
	";								
	break;
	
	case 3:
	//тут мы вызываем информацию об аудиториях, можно редактировать, и удалить не нужную аудиторию.	
	echo "
	<script type=\"text/javascript\">
		//Скрипт для добаления новой аудитории
			$(\"#add_brend\").bind(\"click\", function (){
				
				var name_new_brend = document.getElementById(\"name_new_brend\").value;
				$.ajax ({
					url: \"server/functionAdmin.php\",
					type: \"POST\",
					data: ({name_new_brend: name_new_brend, functionAdmin: 6}),
					dataType: \"text\",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
	</script>
	
	<div class=\"container\">
		<div class=\"row\" >
			<div class=\"col-sm-8\">
			<div style = \"text-align: center;\">
							<h1>Производители</h1>
							<div id=\"informationBrend\"> </div>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">
								<input type=\"text\" size=\"50\" id=\"name_new_brend\"/>
								</td>
								<td border=\"2\">
								<button id=\"add_brend\" value\"3\">Добавить</button>
								</td>
							</tr>
							<hr>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">Название производителя
								</td>
								<td border=\"2\">Редактировать
								</td>
								<td border=\"2\">Удалить
								</td>
							</tr>
	";				
							$result_set = mysql_query("SELECT * FROM brend");
							while ($result = mysql_fetch_array($result_set)) {
								echo "
								<script type=\"text/javascript\">
									//Скрипт для редактирования информации об производителя
									$(\"#button_update_brend".$result["id"]."\").bind(\"click\", function (){
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
									//Скрипт для удаления записи об аудитории
									$(\"#delete_brend".$result["id"]."\").bind(\"click\", function (){
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
									<tr>
									<!--<td>".$result["title"]."</td>-->
									<td><input id=\"update".$result["id"]."\" type=\"text\" name=\"position_name\" size=\"30%\" autocomplete=\"off\"  placeholder=\"".$result["title"]."\"></td>
									<td><button  class=\"btn btn-primary btn-md\" id=\"button_update_brend".$result["id"]."\" value= \"".$result["id"]."\">Редактировать </button></td>
									<td><button class=\"btn btn-primary btn-md\" id=\"delete_brend".$result["id"]."\" value=".$result["id"].">Удалить</button></td>
								 </tr>";
							}		
	echo "						
							</table>
                        
						</div>
			</div>
		</div>
		</div>	
	";	
	
	break;
	
	case 7:
	//Выводим feedback от пользователей для админа.
	//  
	echo "
	<div class=\"container\">
		<div class=\"row\" >
			<div class=\"col-sm-8\">
			<div style = \"text-align: center;\">
							<h1>Отзывы</h1>
							<table border=\"1\" style=\"margin: 0 auto;\" width=\"50%\">
							<tr>
								<td border=\"2\">Имя
								</td>
								<td border=\"2\">отзывы
								</td>
							</tr>
	";				
							/*$user_id_array = Array();
							$sqlZaprosIdUser = mysql_query("SELECT id_user FROM feedback");
							while ($result_$sqlZaprosIdUser = mysql_fetch_array($sqlZaprosIdUser)) {
								$user_id_array[] = $result_$sqlZaprosIdUser['id_user'];
							}*/
							$sqlZaprosFeedBack = mysql_query("SELECT * FROM feedback");
							while ($result_sqlZaprosFeedBack = mysql_fetch_array($sqlZaprosFeedBack)) {
								echo "<tr><form method=\"POST\">";
									echo "<td>".$result_sqlZaprosFeedBack["id_user"]."</td>";
									echo "<td>".$result_sqlZaprosFeedBack["text_feedback"]."</td>";
									echo "<td><input type=\"submit\" method=\"post\" name=\"del\" value= ".$result_sqlZaprosFeedBack["id"]." /></td> ";
								echo "</tr></form>";
							}
							
							
	echo "						
							</table>
                        
						</div>
			</div>
		</div>
		</div>	
	";
	break;
}	
?>