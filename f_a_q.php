<?php
session_start();
include("/server/mysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8';");
?>
<html>
	<head>
	<title>F.A.Q.</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/easydropdown.metro.css" type="text/css"/>
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="js/jquery.easydropdown.js" type="text/javascript"></script>
		<script>		
		function funcBefore(){
			$("#content").html("<hr><img src=\"img/download.gif\" alt=\"Пример\" width=\"150\" height=\"150\">");
		}
	
		function funcSuccess (data){
			$("#content").html (data);
		
		}
		
		$(document).ready (function (){
			$("#find").bind("click", function (){
			//	var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
			//	var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrend").value;
			//	var htmlSelectOfRoom = document.getElementById("htmlSelectOfRoom").value;
			//htmlSelectOfType_item: htmlSelectOfType_item, htmlSelectOfBrend: htmlSelectOfBrend, htmlSelectOfRoom:htmlSelectOfRoom, 
				var buttonValueForFunction = document.getElementById("find").value;
				$.ajax ({
					url: "server/functionfaq.php",
					type: "POST",
					data: ({buttonValueForFunction: buttonValueForFunction}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//-------------------------------------------------------------
			//Добавление вопроса 
			$("#enter").bind("click", function (){
				var buttonValueForFunction = document.getElementById("enter").value;
				var f_a_q_question = document.getElementById("question").value;
				$.ajax ({
					url: "server/functionfaq.php",
					type: "POST",
					data: ({f_a_q_question: f_a_q_question, buttonValueForFunction: buttonValueForFunction}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
				document.getElementById('question').value='';
				alert ("Ваш вопрос успешно добавлен");
			});
			
		});
	</script>
	<title>login</title>
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
				
					<li><a href="main.php">Каталог</a></li>
					<li class="active"><a  href="f_a_q.php">F.A.Q.</a></li>
					<?php 
						if (isset($_SESSION['login'])){
							echo  "<li ><a href=\"..\profile.php\">Профиль</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}
						?>
					<li><a href="#">Обо мне</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>

	<div class="container">
	<!-- Строка фильтров -->
		<div class="row">
			<div class=\"col-sm-12\" style=\"background-color: #BDC2E8; box-shadow: 0 0 5px; border-radius: 20px; border-left: 1px solid black; border-right: 1px solid black;\">
				
			</div>		
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-6" style=" box-shadow: 0 0 5px; border-radius: 5px; border-left: 1px solid black; border-right: 1px solid black;">
					<hr>
						<div id="content">
						
						</div>
					</div>
					<div  class="col-sm-6 fixed" style=" box-shadow: 0 0 5px; border-radius: 5px; border-left: 1px solid black; border-right: 1px solid black;">
					<br>					
				<select id="htmlSelectOfType_item" name="htmlSelectOfType_item">
							<option value="" class="label">Тип Оборудования</option>

									<?php
									//Не забуть это переделать в ajax
									//через селект вытаскиваем тип по айди
										$sqlZaprosType_item = mysql_query("SELECT * FROM type_item ORDER BY name_type_item");
										while ($result_sqlZaprosType_item = mysql_fetch_array($sqlZaprosType_item)) {
											echo "<option select value =".$result_sqlZaprosType_item["id"].">".$result_sqlZaprosType_item['name_type_item']."";	
										}
									?>
				</select>
				<select id="htmlSelectOfBrend" name="htmlSelectOfBrend" >
					<option value="" class="label">Производитель</option>
									<?php
									//Не забуть это переделать в ajax
									//через селект вытаскиваем тип по айди
										$sqlZaprosBrend = mysql_query("SELECT * FROM brend ORDER BY title ");
										while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
											echo "<option select value =".$result_sqlZaprosBrend ["id"].">".$result_sqlZaprosBrend['title']."";	
										}
									?>
				</select>
				<button id="find" value="1" type="submit">Поиск</button>
				<br>
				<hr>
				<p>Задать вопрос:</p>
				<textarea id="question" name="question" style="width:100%; background-color:#FDF5E6; margin-top:1%;height:150px; margin-left:2%; min-height:10px;resize:none;"></textarea>
				<br>
				<button id="enter"  style="margin-left:77%;" value="2" type="submit">Потвердить</button>
					</div>
				</div>	
			</div>
		</div>	
	<br>
	
	</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	 <script src="../js/pushy.min.js"></script>
	</body>
</html>