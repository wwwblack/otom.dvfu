<!DOCTYPE html>
<html>
	<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<title>login</title>
	<script>		
		function funcBefore(){
			$("#information").html("<hr> Ожидайте ответа...");
		}
	
		function funcSuccess (data){
			$("#information").html (data);
		
		}
		
		$(document).ready (function (){
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
		});
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
					ПриветФОЫРВ
				</ul>
			</div>	
		</div>	
	</nav>
	
	<div class="container">
		<div class="row">
		<div class="col-sm-6" ></br>
		<img src="img/1.jpg" height="300">
		</div>
		<div class="col-sm-6" style="width: 300px; margin-top: 15%;">
		<!--<form id="login" action="server/login.php" method="post">-->
			<label><strong>Логин:</strong></label><br/>
			<input type="text" size="50" name="login" id="login" />
			<br/>
            <br/>
            <label><strong>Пароль:</strong></label><br/>
            <input id="passik" type="password" size="50" name="pass" id="pass" />
			<hr>
			<button id="enter" type="submit">Войти</button>
		<!--</form>-->
		<div id="information"></div>
		<!--<a href="#" class="thumbnail">
		<img src="img/2.jpg"  alt="ccp tutorial">
		</a>-->
		</div>
		</div>
		
	</div>
	
	</body>
</html>