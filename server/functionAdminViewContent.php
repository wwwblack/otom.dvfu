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
	function funcBefore(){
			$(\"#informationRoom\").html(\"<hr> Ожидайте ответа...\");
		}
	
		function funcSuccess (data){
			$(\"#informationRoom\").html (data);
		
		}
	$(document).ready (function (){
			//Скрипт для редактирования информации об аудиториях
			$(\"#button_update_position_name\").bind(\"click\", function (){
				
				var update_position_name = document.getElementById(\"update_position_name\").value;
				var button_update_position_name = document.getElementById(\"button_update_position_name\").value;
				$.ajax ({
					url: \"server/functionAdmin.php\",
					type: \"POST\",
					data: ({button_update_position_name: button_update_position_name , update_position_name: update_position_name}),
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
					data: ({name_new_room: name_new_room, functionAdminDelete: 3}),
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
									echo "<td><button id=\"button_update_position_name\" value= \"1:".$result["id"]."\">Редактировать </button></td>";
									echo "<td><button id=\"delete_posiotion_name \" value=".$result["id"].">Удалить</button></td> ";
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
	/*<div class="row" >
			<p>	Добавление нового оборудования </p>
			<div class="col-sm-8" style="background-color: #808080;">
			<form name="addItem" enctype="multipart/form-data" action="" method="POST">
				<select name="htmlSelectOfBrend" size="1">
									<?php
									//Не забуть это переделать в ajax
									//через селект вытаскиваем тип по айди
										$sqlZaprosBrend = mysql_query("SELECT * FROM brend");
										while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
											echo "<option select value =".$result_sqlZaprosBrend ["id"].">".$result_sqlZaprosBrend['title']."";	
										}
									?>
				</select><br/>
				<select name="htmlSelectOfRoom" size="1">
									<?php
									//Не забуть это переделать в ajax
									//через селект вытаскиваем тип по айди
										$sqlZaprosRoom = mysql_query("SELECT * FROM room");
										while ($result_sqlZaprosRoom = mysql_fetch_array($sqlZaprosRoom)) {
											echo "<option select value =".$result_sqlZaprosRoom["id"].">".$result_sqlZaprosRoom['position_name']."";	
										}
									?>
				</select><br/>
				<select name="htmlSelectOfType_item" size="1">
									<?php
									//Не забуть это переделать в ajax
									//через селект вытаскиваем тип по айди
										$sqlZaprosType_item = mysql_query("SELECT * FROM type_item");
										while ($result_sqlZaprosType_item = mysql_fetch_array($sqlZaprosType_item)) {
											echo "<option select value =".$result_sqlZaprosType_item["id"].">".$result_sqlZaprosType_item['name_type_item']."";	
										}
									?>
				</select><br/>
				<textarea name="descriptionOfItem" style="width:300px; background-color:#FDF5E6; margin-top:1%; height:100px; margin-left:2%; min-height:10px;resize:none"></textarea>
				<form enctype="multipart/form-data" method="POST">
					<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
					<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
					<!-- Название элемента input определяет имя в массиве $_FILES -->
					Отправить этот файл: <input name="userfile" type="file" /><br>
					<button type="submit" id="enter" />Отправить файл</button>
				</form>
				
				<div id="information"></div>
				
			</form>
			</div>		
		</div>
		<hr>*/
}	
?>