<?php
session_start();
include("mysql.php");
//В переменной ниже содержиться 1 - номер функции; 2 - id аудитории чтобы найти его в базе
$button_update_position_name = $_POST['button_update_position_name'];
//ниже переменная - это обновлённое название аудитории
$update_position_name = $_POST['update_position_name'];
$update_position_name = mysql_real_escape_string($update_position_name);
list($functionAdmin, $id_position_name) = explode(":", $button_update_position_name);

$functionAdmin = $_POST['functionAdmin'];
$name_new_room = $_POST['name_new_room'];
$delete_posiotion_name = $_POST['delete_posiotion_name'];
echo $delete_posiotion_name;
switch ($functionAdmin){
	
	case 1:
	// обновление названия аудитории
	$sqlzapros1 = mysql_query("UPDATE `room` SET  `position_name` = '$update_position_name' WHERE `id` = '$id_position_name'");
	echo mysql_error();
	echo "Я обновил название аудитории :)";
	break;
	
	case 2:
	// удаление аудитории из спискf
	$sqlzapros2 = mysql_query("DELETE FROM room WHERE `id` = '$delete_posiotion_name'");
	echo "Я удалил аудиторию";
	break;
	
	case 3:
	// Добавление новой аудитории
	echo "id - ".$name_new_room."";
	$sqlzapros3 = mysql_query("INSERT INTO `room` (`position_name`) VALUES ('$name_new_room')");
	echo mysql_error();
		echo "что то случилось";
	break;
}

?>