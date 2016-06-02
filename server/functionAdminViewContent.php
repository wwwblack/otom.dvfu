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
	<script>

	$(document).ready (function (){
			//Скрипт для редактирования информации об аудиториях
			$(\"#button_update_position_name\").bind(\"click\", function (){
				
				var update_position_name = document.getElementById(\"update_position_name\").value;
				var button_update_position_name = document.getElementById(\"button_update_position_name\").value;
				$.ajax ({
					url: \"server/functionAdmin.php\",
					type: \"POST\",
					data: ({button_update_position_name: button_update_position_name , update_position_name: update_position_name, functionAdmin: 1}),
					dataType: \"text\",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
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
			//Скрипт для удаления записи об аудитории
			$(\"#delete_posiotion_name\").bind(\"click\", function (){
				var delete_posiotion_name = document.getElementById(\"delete_posiotion_name\").value;
				$.ajax ({
					url: \"server/functionAdmin.php\",
					type: \"POST\",
					data: ({delete_posiotion_name: delete_posiotion_name, functionAdmin: 2}),
					dataType: \"text\",
					beforeSend: funcBefore,
					success: funcSuccess
				});
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
								echo "<tr><form method=\"POST\">";
									echo "<td>".$result["position_name"]."</td>";
									echo "<td><input id=\"update_position_name\" type=\"text\" name=\"position_name\" size=\"30%\" autocomplete=\"off\"  placeholder=\"".$result["position_name"]."\"></td>";
									echo "<td><button id=\"button_update_position_name\" value= \"".$result["id"]."\">Редактировать </button></td>";
									echo "<td><button id=\"delete_posiotion_name\" value=".$result["id"].">Удалить</button></td> ";
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
								<td border=\"2\">Фамилия
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