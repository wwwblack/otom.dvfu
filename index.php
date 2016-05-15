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
	<style>
	.window_show {
		display: none; 
		z-index: 1000;
		width: 200px; height: auto;
		right: 20px;
		
		
	}
	.green {
		color: #fff;
	}
	 
	.green a {
		color: #fff;
	}
</style>
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
					
				</ul>
			</div>	
		</div>	
	</nav>
	
	<div class="container">
		<div class="row">
		<div class="col-sm-6" ></br>
		<div class='window_show green'>
			<img src="img/1.jpg" height="300">
		</div>	
		</div>
		<div class="col-sm-6" style="width: 300px; margin-top: 15%;">
		<form id="login" action="server/login.php" method="post">
			<label><strong>Логин:</strong></label><br/>
			<input type="text" size="25" name="login" id="login" />
			<br/>
            <br/>
            <label><strong>Пароль:</strong></label><br/>
            <input id="passik" type="password" size="25" name="pass" id="pass" />
			<hr>
			<button id="enter" type="submit">Войти</button>
		</form>
		<div id="information"></div>
		<!--<a href="#" class="thumbnail">
		<img src="img/2.jpg"  alt="ccp tutorial">
		</a>-->
		</div>
		</div>
		
	</div>
	
	</body>
</html>