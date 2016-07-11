<?php
session_start();
include("mysql.php");
//В переменной ниже содержиться 1 - номер функции; 2 - id аудитории чтобы найти его в базе
$id_position_name = $_POST['button_update_position_name'];
//ниже переменная - это обновлённое название аудитории
$update_position_name = $_POST['update_position_name'];
$update_position_name = mysql_real_escape_string($update_position_name);

$functionAdmin = $_POST['functionAdmin'];
$name_new_room = $_POST['name_new_room'];
$delete_posiotion_name = $_POST['delete_posiotion_name'];

switch ($functionAdmin){
	
	case 1:
	// обновление названия аудитории
	$sqlzapros1 = mysql_query("UPDATE `room` SET  `position_name` = '$update_position_name' WHERE `id` = '$id_position_name'");
	echo mysql_error();
	echo "Название аудитории обновлено";
	break;
	
	case 2:
	// удаление аудитории из списка
	$sqlzapros2 = mysql_query("DELETE FROM room WHERE `id` = '$delete_posiotion_name'");
	echo "Аудитория удалена";
	break;
	
	case 3:
	// Добавление новой аудитории
	$sqlzapros3 = mysql_query("INSERT INTO `room` (`position_name`) VALUES ('$name_new_room')");
	echo mysql_error();
		echo "Новая аудитория добавлена";
	break;
	
	case 4:
	$id_brend = $_POST['button_update_brend'];
	//ниже переменная - это обновлённое название аудитории
	$update_brend = $_POST['update_brend'];
	$update_brend = mysql_real_escape_string($update_brend);
	//Обновление названия производителя
	$sqlzapros1 = mysql_query("UPDATE `brend` SET  `title` = '$update_brend' WHERE `id` = '$id_brend'");
	echo mysql_error();
	echo "Название производителя обновлено";
	break;
	
	case 5:
	//удаление производителя
	
	break;
	
	case 6:
	//добавление нового производителя

	break;	
	
	case 7:
	//Обновление названия типа оборудования
	
	break;	
	
	case 8:
	//удаление типа оборудования
	
	break;	
	
	case 9:
	//добавление нового типа оборудования
	
	break;	
}

?>