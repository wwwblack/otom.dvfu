<?php
session_start();
include("/server/mysql.php");
include("/server/function.php"); 
mysql_query("SET NAMES 'utf8';");

?>
<html>
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/demo.css">
     
	<script src="js/jquery.min.js"></script>
	<!--
	------------------------------------------------------------------------------------------------------------------------------------	
	-->
	<script type="text/javascript">
	// Функция для спойлеров!!!
	$(function(){
		$('.panel > .title').click(function(){
			$(this).next('.inner').stop().slideToggle();
		});
	});
	</script>
	<!--
	------------------------------------------------------------------------------------------------------------------------------------	
	-->
	<title>Профиль</title>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<a class="navbar-brand" href="../main.php">КВЦ Склад</a>	
			
			<div class="navbar-collapse collapse">

				<ul class="nav navbar-nav navbar-right">
				
					<li ><a href="main.php">Каталог</a></li>
					<li><a href="f_a_q.php">FAQ</a></li>
					<li><a  href="manuals.php">Мануал</a></li>
					<?php 
					if ($_SESSION['id_role_of_user'] == 1 ){
						echo "<li><a href=\"admin.php\">Админочка</a></li>";
					}
					else{
						if (isset($_SESSION['login'])){
							echo  "<li class=\"active\"><a href=\"..\profile.php\">".$_SESSION['login']."</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}
					}	
						?>
					<li><a href="feedback.php">Feedback</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>
	
    <div class="site-overlay"> </div>
	<div class="container">
		<div class="row" >
			<div class="col-sm-2" >		
			<?php
				$id_user = $_SESSION['id'];
				
				$sql1 = mysql_query("SELECT * FROM users WHERE id = '$id_user'");
				$user_data = mysql_fetch_array($sql1);
			?>	
			<form action="handler.php" method="post" id="my_form" enctype="multipart/form-data">              
			<img src="<?php echo $user_data['img'];?>" height="100"><br>
			<button type=button class="btn btn-xs btn-success">Сменить фото</button>
			</form>
			</div>
			<div class="col-sm-4">
				<div style="font-size: 250%;">
						<?php echo $user_data['first_name'];
								echo " ";
							  echo $user_data['last_name'];?>
				</div>
				<br>
				<div style="font-size: 200%;">
					<?php if ($_SESSION['id_role_of_user'] == 1 ){
						echo " Права: Администратор";
					};
							?>
				</div>
			</div>	
			
			
			<div class="col-sm-6">
				<form method="POST">
					Мобильный телефон<br>
					<input type="text" name="phone" size="30%" autocomplete="off" placeholder="<?php echo $user_data['phone'];?>">     <button name="updateMobilePhone" type=\"submit\"  type=button class="btn btn-md btn-success">Редактировать</button>
				</form>
				<hr>
				Електронный адрес<br>
				<form method="POST">
				<input type="text" name="mail" size="30%" autocomplete="off" placeholder="<?php echo $user_data['e-mail'];?>">    <button name="updateEmail" type=\"submit\" type=button class="btn btn-md btn-success">Редактировать</button>
				</form>
			</div>
			
		</div>
		<hr>
	</div><!-- Это очень крутой бутстрапный спойлер!!!! Не забуть его добавить

                Пункт Группы Свертывания #1
            
    
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>	-->
<?php


// интерфейс для админа
switch ($_SESSION['privilege']){
	
	case 1:
	// Производим запрос всех сотрудников для спойлеров
	$sqlZaprosForDirector = mysql_query("SELECT * FROM users");
	while ($result_sqlZaprosForDirector = mysql_fetch_array($sqlZaprosForDirector)) {
		$id_user_result_sqlZaprosForDirector = $result_sqlZaprosForDirector['id'];
		$sqlZaprosForDirectorSpoilerStatistic = mysql_query("SELECT count(*) FROM user_item WHERE id_user = $id_user_result_sqlZaprosForDirector");
		$result_sqlZaprosForDirectorSpoilerStatistic = mysql_fetch_array($sqlZaprosForDirectorSpoilerStatistic);
		$total = $result_sqlZaprosForDirectorSpoilerStatistic[0];
		echo "<div class=\"container\">	
				<div class=\"row\"  >
				<div class=\"panel-group\" id=\"accordion\">
					<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<h4 class=\"panel-title\">
								<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#".$result_sqlZaprosForDirector['name']."\">
									".$result_sqlZaprosForDirector['name']." ".$result_sqlZaprosForDirector['last_Name']." | Задолженость = ".$total."
								</a>
							</h4>
						</div>	
						<div id=\"".$result_sqlZaprosForDirector['name']."\" class=\"panel-collapse collapse\">
							<div class=\"panel-body\">
								<div class=\"row\" >	
									<div class=\"col-sm-2\">		
										<img src=\"".$result_sqlZaprosForDirector['img']."\" height=\"50\">
									</div>
									<div class=\"col-sm-4\">
										<div style=\" font-size: 250%; \">
											".$result_sqlZaprosForDirector['name']." ".$result_sqlZaprosForDirector['last_Name']."
										</div>
									</div>	
									<div class=\"col-sm-3\">
										Номер телефона
										<br>
										<input type=\"text\" name=\"phone\" size=\"30%\" autocomplete=\"off\" placeholder=\"".$result_sqlZaprosForDirector['phone']."\">
									</div>
									<div class=\"col-sm-3\">
										Електронный адрес<br>
										<input type=\"text\" name=\"phone\" size=\"30%\" autocomplete=\"off\" placeholder=\"".$result_sqlZaprosForDirector['e-mail']."\">
									</div>
								</div>
								
		";
		
		// тут кончается профильная информация и начинается код вывода оборудования которое числиться за определённым человеком
		
		$item_id_Array = Array();
		$sql3 = mysql_query("SELECT * FROM user_item WHERE id_user = $id_user_result_sqlZaprosForDirector");
		while ($result3 = mysql_fetch_array($sql3)) {
			$item_id_Array[] = $result3["id_item"];	
		}
	// используя фоич начинаем использовать значения для отобржения отдельного item
		foreach ($item_id_Array as $item_iddd){
			$result_set = mysql_query("SELECT * FROM item WHERE `id` = '$item_iddd'");
			while ($result = mysql_fetch_array($result_set)){
				//По айди item получаем данные, из-за граблей и моей криворукости пришлось танцевать с бубном. В общем обращаемся к каждой таблице по отдельности 
				//чтобы вытащить нужные значения.
				//------------------------------------------------------------------
				$id_brendForZapros = $result["id_brend"];
				$sqlzapros1 = mysql_query("SELECT title FROM brend WHERE `id` = '$id_brendForZapros'");
				$result_titleBrend = mysql_fetch_array($sqlzapros1);
				//------------------------------------------------------------------
				$id_positionForZapros = $result["id_position"];
				$sqlzapros2 = mysql_query("SELECT position_name FROM room WHERE `id` = '$id_positionForZapros'");
				$result_id_positionForZapros = mysql_fetch_array($sqlzapros2);
				//------------------------------------------------------------------
				$id_type_itemForZapros = $result['id_type_item'];
				$sqlzapros3 = mysql_query("SELECT name_type_item FROM type_item WHERE `id` = '$id_type_itemForZapros'");	
				$result_id_type_itemForZapros = mysql_fetch_array($sqlzapros3);
				//------------------------------------------------------------------
				//Этот запрос в таблицу ЮЗЕР ИТЕМ! имей ввиду
				$id_itemForZapros = $item_iddd;
				$sqlzapros4 = mysql_query("SELECT id, time, dead_Time FROM user_item WHERE `id_item` = '$id_itemForZapros'");	
				$result_id_itemForZapros = mysql_fetch_array($sqlzapros4);
				//------------------------------------------------------------------
				//тут производим проверку на дату возврата. если сегодняшняя дата больше чем дата возврата то забиваем в переменную 
				$now=date("Y-m-d H:i:s");
				$dead_time  = $result_id_itemForZapros['dead_Time'];
				if ($now > $dead_time) {
				  $prosrochka = 'background-color: red;';
				  
				}
				else{
					$prosrochka = " ";
				}
				echo "
					<div class=\"row\">
					<hr color=\"black\">
						<div class=\"col-sm-2\" >
							<img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"100\" height=\"100\">
						</div>
						<div class=\"col-sm-3\">
							<br><label for=\"recipient-name\" class=\"control-label\">Производитель - </label>". $result_titleBrend["title"]."
							<br><label for=\"recipient-name\" class=\"control-label\">Тип - </label>". $result_id_type_itemForZapros["name_type_item"]."
							<br><label for=\"recipient-name\" class=\"control-label\">Исходное расположение - </label>". $result_id_positionForZapros['position_name']."
							<br><label for=\"recipient-name\" class=\"control-label\">Описание - </label>". $result["description_item"]."
						</div>	
						<div class=\"col-sm-3\">
							<br>Дата вручения - ".$result_id_itemForZapros['time']."
							<br><div style = \"".$prosrochka."\">Дата возврата - ".$result_id_itemForZapros['dead_Time']."</div>
						</div>
						<div class=\"col-sm-4\">
							<form  method=\"POST\">";
								switch ($_SESSION['privilege']){
											case 1:
												echo ("<br><br><button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Возврат</button>");
												break;
											case 2:
												echo ("<br><br><button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Возврат</button>");
												break;
								}		
									
				echo "	
							</form>
						</div>
					</div>
				";
				
			}
		}
	
		echo "</div>
			
		</div>
		</div>
		</div>
		</div>
		</div>
		";	
	}

break;
// интерфейс для директора
case 2:
	// Производим запрос всех сотрудников для спойлеров
	$sqlZaprosForDirector = mysql_query("SELECT * FROM users");
	while ($result_sqlZaprosForDirector = mysql_fetch_array($sqlZaprosForDirector)) {
		$id_user_result_sqlZaprosForDirector = $result_sqlZaprosForDirector['id'];
		$sqlZaprosForDirectorSpoilerStatistic = mysql_query("SELECT count(*) FROM user_item WHERE id_user = $id_user_result_sqlZaprosForDirector");
		$result_sqlZaprosForDirectorSpoilerStatistic = mysql_fetch_array($sqlZaprosForDirectorSpoilerStatistic);
		$total = $result_sqlZaprosForDirectorSpoilerStatistic[0];
				echo "<div class=\"container\">	
				<div class=\"row\"  >
				<div class=\"panel-group\" id=\"accordion\">
					<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<h4 class=\"panel-title\">
								<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#".$result_sqlZaprosForDirector['name']."\">
									".$result_sqlZaprosForDirector['name']." ".$result_sqlZaprosForDirector['last_Name']." | Задолженость = ".$total."
								</a>
							</h4>
						</div>	
						<div id=\"".$result_sqlZaprosForDirector['name']."\" class=\"panel-collapse collapse\">
							<div class=\"panel-body\">
								<div class=\"row\" >	
									<div class=\"col-sm-2\">		
										<img src=\"".$result_sqlZaprosForDirector['img']."\" height=\"50\">
									</div>
									<div class=\"col-sm-4\">
										<div style=\" font-size: 250%; \">
											".$result_sqlZaprosForDirector['name']." ".$result_sqlZaprosForDirector['last_Name']."
										</div>
									</div>	
									<div class=\"col-sm-3\">
										Номер телефона
										<br>
										<input type=\"text\" name=\"phone\" size=\"30%\" autocomplete=\"off\" placeholder=\"".$result_sqlZaprosForDirector['phone']."\">
									</div>
									<div class=\"col-sm-3\">
										Електронный адрес<br>
										<input type=\"text\" name=\"phone\" size=\"30%\" autocomplete=\"off\" placeholder=\"".$result_sqlZaprosForDirector['e-mail']."\">
									</div>
								</div>
								
		";
		
		// тут кончается профильная информация и начинается код вывода оборудования которое числиться за определённым человеком
		
		$item_id_Array = Array();
		$sql3 = mysql_query("SELECT * FROM user_item WHERE id_user = $id_user_result_sqlZaprosForDirector");
		while ($result3 = mysql_fetch_array($sql3)) {
			$item_id_Array[] = $result3["id_item"];	
		}
	// используя фоич начинаем использовать значения для отобржения отдельного item
		foreach ($item_id_Array as $item_iddd){
			$result_set = mysql_query("SELECT * FROM item WHERE `id` = '$item_iddd'");
			while ($result = mysql_fetch_array($result_set)){
				//По айди item получаем данные, из-за граблей и моей криворукости пришлось танцевать с бубном. В общем обращаемся к каждой таблице по отдельности 
				//чтобы вытащить нужные значения.
				//------------------------------------------------------------------
				$id_brendForZapros = $result["id_brend"];
				$sqlzapros1 = mysql_query("SELECT title FROM brend WHERE `id` = '$id_brendForZapros'");
				$result_titleBrend = mysql_fetch_array($sqlzapros1);
				//------------------------------------------------------------------
				$id_positionForZapros = $result["id_position"];
				$sqlzapros2 = mysql_query("SELECT position_name FROM room WHERE `id` = '$id_positionForZapros'");
				$result_id_positionForZapros = mysql_fetch_array($sqlzapros2);
				//------------------------------------------------------------------
				$id_type_itemForZapros = $result['id_type_item'];
				$sqlzapros3 = mysql_query("SELECT name_type_item FROM type_item WHERE `id` = '$id_type_itemForZapros'");	
				$result_id_type_itemForZapros = mysql_fetch_array($sqlzapros3);
				//------------------------------------------------------------------
				//Этот запрос в таблицу ЮЗЕР ИТЕМ! имей ввиду
				$id_itemForZapros = $item_iddd;
				$sqlzapros4 = mysql_query("SELECT id, time, dead_Time FROM user_item WHERE `id_item` = '$id_itemForZapros'");	
				$result_id_itemForZapros = mysql_fetch_array($sqlzapros4);
				//------------------------------------------------------------------
				//тут производим проверку на дату возврата. если сегодняшняя дата больше чем дата возврата то забиваем в переменную 
				$now=date("Y-m-d H:i:s");
				$dead_time  = $result_id_itemForZapros['dead_Time'];
				if ($now > $dead_time) {
				  $prosrochka = 'background-color: red;';
				  
				}
				else{
					$prosrochka = " ";
				}
				echo "
					<div class=\"row\">
					<hr color=\"black\">
						<div class=\"col-sm-2\" >
							<img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"100\" height=\"100\">
						</div>
						<div class=\"col-sm-3\">
							<br><label for=\"recipient-name\" class=\"control-label\">Производитель - </label>". $result_titleBrend["title"]."
							<br><label for=\"recipient-name\" class=\"control-label\">Тип - </label>". $result_id_type_itemForZapros["name_type_item"]."
							<br><label for=\"recipient-name\" class=\"control-label\">Исходное расположение - </label>". $result_id_positionForZapros['position_name']."
							<br><label for=\"recipient-name\" class=\"control-label\">Описание - </label>". $result["description_item"]."
						</div>	
						<div class=\"col-sm-3\">
							<br>Дата вручения - ".$result_id_itemForZapros['time']."
							<br><div style = \"".$prosrochka."\">Дата возврата - ".$result_id_itemForZapros['dead_Time']."</div>
						</div>
						<div class=\"col-sm-4\">
							<form  method=\"POST\">";
								switch ($_SESSION['privilege']){
											case 1:
												echo ("<br><br><button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Возврат</button>");
												break;
											case 2:
												echo ("<br><br><button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Возврат</button>");
												break;
								}		
									
				echo "	
							</form>
						</div>
					</div>
				";
				
			}
		}
	
		echo "</div>
			
		</div>
		</div>
		</div>
		</div>
		</div>
		";
	}

break;
//----------------------------------------------------------------------------------------------------------------------------------------------------
// Если это не Директор (Privilege не равно 2 или 1) то есть для обычных холопов
////выдающий список
case 3;
	//функция вывода взятого в использования оборудования
	//------------------------------------------------------------------
	// По айди пользователя получаем строки с содержанием его айди_item. И из этих строк вытаскиваем значения айдишников item. 
	//для того чтобы потом отоброзить именно нужные 
		$item_id_Array = Array();
		$sql3 = mysql_query("SELECT * FROM user_item WHERE id_user = $id_user");
		while ($result3 = mysql_fetch_array($sql3)) {
			$item_id_Array[] = $result3["id_item"];	
		}
	// используя фоич начинаем использовать значения для отобржения отдельного item
		foreach ($item_id_Array as $item_iddd){
			$result_set = mysql_query("SELECT * FROM item WHERE `id` = '$item_iddd'");
			while ($result = mysql_fetch_array($result_set)){
				//По айди item получаем данные, из-за граблей и моей криворукости пришлось танцевать с бубном. В общем обращаемся к каждой таблице по отдельности 
				//чтобы вытащить нужные значения.
				//------------------------------------------------------------------
				$id_brendForZapros = $result["id_brend"];
				$sqlzapros1 = mysql_query("SELECT title FROM brend WHERE `id` = '$id_brendForZapros'");
				$result_titleBrend = mysql_fetch_array($sqlzapros1);
				//------------------------------------------------------------------
				$id_positionForZapros = $result["id_position"];
				$sqlzapros2 = mysql_query("SELECT position_name FROM room WHERE `id` = '$id_positionForZapros'");
				$result_id_positionForZapros = mysql_fetch_array($sqlzapros2);
				//------------------------------------------------------------------
				$id_type_itemForZapros = $result['id_type_item'];
				$sqlzapros3 = mysql_query("SELECT name_type_item FROM type_item WHERE `id` = '$id_type_itemForZapros'");	
				$result_id_type_itemForZapros = mysql_fetch_array($sqlzapros3);
				//------------------------------------------------------------------
				//Этот запрос в таблицу ЮЗЕР ИТЕМ! имей ввиду
				$id_itemForZapros = $item_iddd;
				$sqlzapros4 = mysql_query("SELECT id, time, dead_Time FROM user_item WHERE `id_item` = '$id_itemForZapros'");	
				$result_id_itemForZapros = mysql_fetch_array($sqlzapros4);
				//------------------------------------------------------------------
				//тут производим проверку на дату возврата. если сегодняшняя дата больше чем дата возврата то забиваем в переменную 
				$now=date("Y-m-d H:i:s");
				$dead_time  = $result_id_itemForZapros['dead_Time'];
				if ($now > $dead_time) {
				  $prosrochka = 'background-color: red;';
				  
				}
				else{
					$prosrochka = " ";
				}
				echo "
				<hr>
				<div class=\"container\" style=\"background-color: #F8E0E0;\" >	
				<div class=\"row\">";
				echo "
				<div class=\"col-sm-2\" >";
				echo "
					<img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"150\" height=\"150\">
				</div>
				<div class=\"col-sm-6\" style=\"background-color: #F8E0E0;\" >
					Название - ".$result_titleBrend["title"]."<br>
					Тип - ".$result_id_type_itemForZapros["name_type_item"]."<br>
					Дата вручения - ".$result_id_itemForZapros['time']."<br>
					<div style = \"".$prosrochka."\">Дата возврата - ".$result_id_itemForZapros['dead_Time']."</div>
				"; 
				echo "	
					Местоположение - ".$result_id_positionForZapros['position_name']."<br>";
				echo "
					описание - ".$result["description_item"]."<br>
				";
				echo "
				</div>
				<div class=\"col-sm-4\" style=\"background-color: #F8E0E0; style=\"margin-left: 80%\">
					<form  method=\"POST\">";
				switch ($_SESSION['privilege']){
							case 1:
								echo ("<button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Вернуть</button>");
								break;
							case 2:
								echo ("<button name=\"deleteItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id'].":".$result_id_itemForZapros["id"]."\" >Вернуть</button>");
								break;
				}		
					
				echo "	
					</form>
				</div>
			</div>
			</div>
			<hr>
				";
				
			}
		}
	break;
}
?>		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
	 <script src="js/pushy.min.js"></script>
	</body>
</html>