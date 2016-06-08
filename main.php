<?php
session_start();
include("/server/mysql.php");
mysql_query("SET NAMES 'utf8';");
include("/server/function.php");
?>
<html>
	<head>
	<title>Главная</title>
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
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easydropdown.js" ></script>
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
		<script>

		// AJAX Функции --------------------------------------------------------------------------------------------------------------------------------	
		function funcBefore(){
			$("#content").html("<hr><img align=\"middle\" src=\"img/download.gif\" alt=\"Пример\" width=\"150\" height=\"150\">");
		}
	
		function funcSuccess (data){
			$("#content").html (data);
			
		}
		
		$(document).ready (function (){
			$("#enter").bind("click", function (){
				var functionValue = document.getElementById("enter").value; 
				var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
				var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrend").value;
				var htmlSelectOfRoom = document.getElementById("htmlSelectOfRoom").value;
				$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, htmlSelectOfType_item: htmlSelectOfType_item, htmlSelectOfBrend: htmlSelectOfBrend, htmlSelectOfRoom:htmlSelectOfRoom}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
		
		function addUserItem(formId) {
			alert (formId);
			
		}
		});
		// Конец AJAX Функции --------------------------------------------------------------------------------------------------------------------------------	
		
		//Функции для динамических селектов
		//--------------------------------------------------
		function dinamicSelectHtmlSelectOfType_item(){
			var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
			alert (htmlSelectOfType_item);
		}
		//--------------------------------------------------
		function del(id){
			var sel = window.document.getElementById(id);
			var opts = sel.options;
			while(opts.length > 0){
				opts[opts.length-1] = null;
			}
		}

		
		//Плавное всплытие изображений-----------------------------------------------------------------------------------------------------------------------
		
	/*	$("#addItem").bind("click", function (){
				var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
				var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrend").value;
				var htmlSelectOfRoom = document.getElementById("htmlSelectOfRoom").value;
				$.ajax ({
					url: "server/addItem.php",
					type: "POST",
					data: ({htmlSelectOfType_item: htmlSelectOfType_item, htmlSelectOfBrend: htmlSelectOfBrend, htmlSelectOfRoom:htmlSelectOfRoom}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			*/
	/*	$(document).ready(function(){
			 $("#tag").autocomplete("server/autocomplete.php", {
					selectFirst: true
				});
		});
			*/
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
			
				
			
			<div class="navbar-collapse collapse">
			
				<ul class="nav navbar-nav navbar-right">
				
					<li class="active"><a href="#">Каталог</a></li>
					<li><a href="f_a_q.php">FAQ</a></li>
					<?php 
						if (isset($_SESSION['login'])){
							echo  "	
							<li ><a href=\"profile.php\">Профиль</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}
						?>
					<li><a href="FeedBack.php">FeedBack</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>

	<div class="container">
	<!-- Строка фильтров -->
		<div class="row">
		<div  class="col-sm-2">
		
		</div>	
			<h1>Выберите критерии поиска</h1>
				<div  class="col-sm-2">			
					Тип оборудования<br>	
                    <select style="  width: 150px;" id="htmlSelectOfType_item" onchange="dinamicSelectHtmlSelectOfType_item();" name="htmlSelectOfType_item">
						<option value="" class="label">Все</option>

										<?php
										//Не забуть это переделать в ajax
										//через селект вытаскиваем тип по айди
											$sqlZaprosType_item = mysql_query("SELECT * FROM type_item ORDER BY name_type_item");
											while ($result_sqlZaprosType_item = mysql_fetch_array($sqlZaprosType_item)) {
												echo "<option select value =".$result_sqlZaprosType_item["id"].">".$result_sqlZaprosType_item['name_type_item']."";	
											}
										?>
					</select>
				</div>	
				<div  class="col-sm-2" >	
					Производитель<br>
					<select style="  width: 150px;" id="htmlSelectOfBrend" name="htmlSelectOfBrend" >
						<option value="" class="label">Все</option>
										<?php
										//Не забуть это переделать в ajax
										//через селект вытаскиваем тип по айди
											$sqlZaprosBrend = mysql_query("SELECT * FROM brend ORDER BY title" );
											while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
												echo "<option select value =".$result_sqlZaprosBrend ["id"].">".$result_sqlZaprosBrend['title']."";	
											}
										?>
					</select>
				</div>	
				<div  class="col-sm-2" >	
					Местоположение<br>
					<select style="  width: 150px;" id="htmlSelectOfRoom" name="htmlSelectOfRoom">
						<option value=""  class="label">Все</option>
											<?php
											//Не забуть это переделать в ajax
											//через селект вытаскиваем тип по айди
												$sqlZaprosRoom = mysql_query("SELECT * FROM room");
												while ($result_sqlZaprosRoom = mysql_fetch_array($sqlZaprosRoom)) {
													echo "<option select value =".$result_sqlZaprosRoom["id"].">".$result_sqlZaprosRoom['position_name']."";	
												}
											?>
					</select>
				</div>	
				<div  class="col-sm-2" style=" margin-bottom: 3px;">
					Введите слово
					<input name="tag" type="text" id="tag" placeholder="Поиск" size="20"/>
				</div>
						
				<div  class="col-sm-1" style=" margin-top: 10px;" >
					<button value="1" class="btn btn-primary btn-md" id="enter" type="submit">Поиск</button>						
				</div>	
			</div>
                    
                    
	</div>
        <hr>
	<div class="container">	
		<div class="row hidden-xs hidden-sm" style=" box-shadow: 0 0 1px;  border-left: 1px solid black; ">
		
							<div class="col-sm-1" style="">Номер</div>
							<div class="col-sm-1" style=" border-left: 1px solid black; ">IMG</div>
							<div class="col-sm-2" style=" border-left: 1px solid black;">
							Местоположение
							</div>
							<div class="col-sm-3" style=" border-left: 1px solid black;">
							Описание
							</div>
							<div class="col-sm-2" style=" border-left: 1px solid black; border-right: 1px solid black;">
							Тарный номер
							</div>
							<div class="col-sm-2" style="  border-right: 1px solid black;">
							Дата возврата
							</div>
							<div class="col-sm-2" style=" border-left: 1px solid black;">
							</div>
		</div>
	</div>	
<div class="container">			
							<div id="content" >
							
							</div>
						
						
					
		
						
	</div>		
							
	
	<nav class="navbar navbar-default  navbar-fixed-bottom" role="navigation">  </nav>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	 <script src="../js/pushy.min.js"></script>
	</body>
</html>