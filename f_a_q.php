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
			var functionValue = document.getElementById("find").value;	
			var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrend").value;
			$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, htmlSelectOfBrend: htmlSelectOfBrend}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//-------------------------------------------------------------
			//Добавление вопроса 
			$("#enter").bind("click", function (){
				var functionValue = document.getElementById("enter").value;
				var htmlSelectOfBrendForAddQuestion = document.getElementById("htmlSelectOfBrendForAddQuestion").value;
				var f_a_q_question = document.getElementById("question").value;
				$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, f_a_q_question: f_a_q_question,  htmlSelectOfBrendForAddQuestion:htmlSelectOfBrendForAddQuestion}),
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
							echo "<li><a href=\"index.php\">Вход</a></li>";
						}
						?>
					<li><a href="feedback.php">Feedback</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>
	<div class="container">
	
		<div class="row">
			<div class="col-sm-4" style=\"background-color: #BDC2E8; box-shadow: 0 0 5px; border-radius: 20px; border-left: 1px solid black; border-right: 1px solid black;\">
				<!--СПОЙЛЕР ФАЗАФАКА! -->
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								   Поиск вопросов
								  </a>
								</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse">
							<div class="panel-body">
								Производитель &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;         Решённость<br>
								<select style="  width: 150px;"  id="htmlSelectOfBrend" name="htmlSelectOfBrend" >
										<option value="" class="label">Все</option>
														<?php
														//Не забуть это переделать в ajax
														//через селект вытаскиваем тип по айди
															$sqlZaprosBrend = mysql_query("SELECT * FROM brend ORDER BY title ");
															while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
																echo "<option select value =".$result_sqlZaprosBrend ["id"].">".$result_sqlZaprosBrend['title']."";	
															}
														?>
								</select>
								        
								<select style="  width: 150px;"  id="htmlSelectOfBrend" name="htmlSelectOfBrend" >
										<option value="" class="label">Все</option>
										<option select value="0" >Ответ найден</option>
										<option select value="1" >Ответ не найден</option>
								</select>
								<button class="btn btn-primary btn-md" id="find" value="6" type="submit">Поиск</button>
							</div>
						</div>
					</div>
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>
			<div class="col-sm-4" style=\"background-color: #BDC2E8; box-shadow: 0 0 5px; border-radius: 20px; border-left: 1px solid black; border-right: 1px solid black;\">
				<!--СПОЙЛЕР ФАЗАФАКА! -->
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								   Поиск мануалов
								  </a>
								</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
								Производитель<br>
								<select style="  width: 150px;"  id="htmlSelectOfBrend" name="htmlSelectOfBrend" >
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
								<button class="btn btn-primary btn-md" id="find" value="10" type="submit">Поиск</button>
							</div>
						</div>
					</div>
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>	
			<div class="col-sm-4" >
				<!--СПОЙЛЕР ФАЗАФАКА! -->
					<div class="panel panel-default" >
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Задать вопрос
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<select style=" width: 150px;"  id="htmlSelectOfBrendForAddQuestion" name="htmlSelectOfBrendForAddQuestion" >
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
								<p>Задать вопрос:</p>
								<textarea id="question" name="question" style="width:90%; background-color:#FDF5E6; height:50px;  min-height:10px;resize:none;"></textarea>
								<br>
								<button id="enter" class="btn btn-primary btn-md"  style="" value="7" type="submit">Потвердить</button>
							</div>
						</div>
					</div>
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>
	
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="content">
						
				</div>
			</div>
		</div>	
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	 <script src="../js/pushy.min.js"></script>
	</body>
</html>