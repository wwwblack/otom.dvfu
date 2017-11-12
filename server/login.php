<?php
session_start();
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	
	$server = "localhost";
	$user = "egor";
	$passer = "48916349";
	$db = "lab_dvfu";
	
	mysql_connect($server,$user,$passer) or die("всЁ пипец");
	mysql_select_db($db) or die("не пашет база");
	//спомощью запроса получаем все данные из таблицы users где логины совпадают.
	$query = mysql_query("SELECT * FROM users WHERE login='$login'");
	$user_data = mysql_fetch_array($query);

	switch ($user_data['id_role_of_user']){
	case 1:
		if ($user_data['password'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['id_role_of_user'] = $user_data['id_role_of_user'];
			$_SESSION['id'] = $user_data['id'];
			header('Location: ../main.php');
			exit;
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 2:
		if ($user_data['password'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['id'] = $user_data['id'];
			$_SESSION['id_role_of_user'] = $user_data['id_role_of_user'];
			header('Location: ../main.php');
			exit;
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 3:
		if ($user_data['password'] == $pass){
			$chek = true;
			$_SESSION['id'] = $user_data['id'];
			$_SESSION['login']=$login;
			$_SESSION['id_role_of_user'] = $user_data['id_role_of_user'];
			header('Location: ../main.php');
			exit;
		}
		else{
			echo ("неверный пароль");
		}
	break;
	}
?>