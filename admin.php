<?php
session_start();
include("/server/mysql.php");
include("/server/function.php"); 
mysql_query("SET NAMES 'utf8';");
if( isset( $_POST['del'] ) )
								{
									echo $_POST['del'];
									//$id = $result["id"];
									$delete = mysql_query ("DELETE FROM `feedback` WHERE `id` = ".$_POST["del"]);
									echo 'Ты нажяль!';
								}
?>
<html>
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/demo.css">
        <!-- Pushy CSS -->
        <link rel="stylesheet" href="../css/pushy.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>		
		function funcBefore(){
			$("#content").html("<hr> Ожидайте ответа...");
		}
	
		function funcSuccess (data){
			$("#content").html (data);
		
		}
		
		$(document).ready (function (){
			$("#enter").bind("click", function (){
				var login = document.getElementById("login").value;
				$.ajax ({
					url: "server/login.php",
					type: "POST",
					contentType: false, // важно - убираем форматирование данных по умолчанию
					processData: false, // важно - убираем преобразование строк по умолчанию
					data: ({login: login}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			// Скрипт для вывода списка пользователей
			$("#userlist").bind("click", function (){
				var userlist;
				$.ajax ({
					url: "server/functionAdminViewContent.php",
					type: "POST",
					
					data: ({userlist: 1}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//Скрипт для вывода редактирования информации об аудиториях
			$("#room").bind("click", function (){
				var userlist;
				$.ajax ({
					url: "server/functionAdminViewContent.php",
					type: "POST",
					
					data: ({userlist: 2}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//Скрипт для вывода таблицы производителей
			$("#brend").bind("click", function (){
				var userlist;
				$.ajax ({
					url: "server/functionAdminViewContent.php",
					type: "POST",
					
					data: ({userlist: 3}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//Скрипт для вывода таблицы feedback.
			$("#feedback").bind("click", function (){
				var userlist;
				$.ajax ({
					url: "server/functionAdminViewContent.php",
					type: "POST",
					
					data: ({userlist: 7}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
		});
		
		
	</script>
	<title>Админ панель</title>
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
					<?php 
					
						if (isset($_SESSION['login'])){
							echo  "<li class=\"active\"><a href=\"..\profile.php\">".$_SESSION['login']."</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}	
					?>
					<li><a href="#">Обо мне</a></li>
				</ul>
			</div>	
		</div>	
	</nav>
	
    <div class="site-overlay"> </div>

	<div class="container" >
		<div class="row" >
			<div class="col-sm-2 ">
			<button  id="userlist" type="submit">Список пользователей</button>
			<br>
			<br>
			<button id="room" type="submit">Список аудиторий</button>
			<br>
			<br>
			<button id="brend" type="submit">Производители</button>
			<br>
			<br>
			<button id="" type="submit">Типы оборудования</button>
			<br>
			<br>
			<button id="" type="submit">FAQ</button>
			<br>
			<br>
			<button id="" type="submit">Manuals</button>
			<br>
			<br>
			<button id="feedback" type="submit">Просмотр отзывов</button>
			</div>
			<div class="col-sm-10">
				<div id="content">
						
				</div>
			</div>
		</div>
	</div>
		
		<!-- Тут будет вся информация о пользователях и функции для редактирования личной информации,
		а так же удание их из БАЗЫ ДАННЫХ а так же добаление новых пользователей   -->
		


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	 <script src="../js/pushy.min.js"></script>
	</body>
</html>