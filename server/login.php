<?php
session_start();
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	
	$server = "localhost";
	$user = "egor";
	$passer = "48916349";
	$db = "kvs";
	
	mysql_connect($server,$user,$passer) or die("всЄ пипец");
	mysql_select_db($db) or die("не пашет база");
	//спомощью запроса получаем все данные из таблицы users где логины совпадают.
	$query = mysql_query("SELECT * FROM users WHERE login='$login'");
	$user_data = mysql_fetch_array($query);

	switch ($user_data['privilege']){
	case 1:
		if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['privilege'] = $user_data['privilege'];
			$_SESSION['id'] = $user_data['id'];
			echo "<a href=\"main.php\">ООО ГОСПОДЬ ВСЕМОГУЩИЙ. ОЙ ТОЧНО! ЭТО ЖЕ Я!</a>".$_SESSION['id'];
			
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 2:
			if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['id'] = $user_data['id'];
			$_SESSION['privilege'] = $user_data['privilege'];
			echo "<a href=\"main.php\">Привет начаника</a>";
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 3:
				if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['id'] = $user_data['id'];
			$_SESSION['login']=$login;
			$_SESSION['privilege'] = $user_data['privilege'];
			echo "<a href=\"main.php\">Ну наконец то РАБ =[</a>";
		}
		else{
			echo ("неверный пароль");
		}
	break;
	echo "";
	}

?>