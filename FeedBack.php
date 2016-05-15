<html>
	<head>
	<title>FeedBack</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<script type="text/javascript">	
	// Плавное всплытие картинки при загрузки
	$(document).ready(function() {
		setTimeout ("$('.window_show').show('drop');", 100);
		//setTimeout ("$('.window_show').hide('drop');", 5000);
	});
	
		function funcBefore(){
			$("#information").html("<hr> Ожидайте ответа...");
		}
	
		function funcSuccess (data){
			$("#information").html (data);
		
		}
		
	$(window).keydown(function(e) {
		if (e.which == 13) {
		var login = document.getElementById("login").value;
				var pass = document.getElementById("passik").value;
				$.ajax ({
					url: "server/login.php",
					type: "POST",
					data: ({login: login, pass: pass}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});	
		}
	});
	
	
	
			
		/*$(document).ready (function (){
			$("#enter").bind("click", function (){
				var login = document.getElementById("login").value;
				var pass = document.getElementById("passik").value;
				$.ajax ({
					url: "server/login.php",
					type: "POST",
					data: ({login: login, pass: pass}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
		});*/
	</script>
	</head>
	<body bgcolor="#D6DBDB">
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
					<li><a href="f_a_q.php">F.A.Q.</a></li>
					<?php 
						if (isset($_SESSION['login'])){
							echo  "<li ><a href=\"profile.php\">Профиль</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}
						?>
					<li><a href="FeedBack.html">FeedBack</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>
	
	<div class="container">
		<div class="row">
		<div class="col-sm-4" ></br>
			
		</div>
		<div class="col-sm-4">
		<font color="black" face="Arial" >Напишите ваше: пожелание, предложение, критику. </br> Я учту ваши отзывы и постараюсь всё исправить :)</font>
		<form id="feedbackForm" action="" method="post">
			
			<textarea id="want" name="want" style="width:100%; background-color:#FDF5E6; margin-top:1%;height:150px; margin-left:2%; min-height:10px;resize:none;"></textarea>
			<br/>
			<hr>
			<button id="buttonForWant" type="submit">Добавить пожелание</button>
		</form>
		<div id="information"></div>
		<!--<a href="#" class="thumbnail">
		<img src="img/2.jpg"  alt="ccp tutorial">
		</a>-->
		</div>
		<div class="col-sm-4" ></br>
			
		</div>
		</div>
		
	</div>
	
	</body>
</html>