<?
//-----------------------------------------------------------------------------------
//Функция добавления записей, о том кто что взял. В таблицу users_item
if ( isset( $_POST['addItem'] ) ){
		$valueItem = $_POST['addItem'];
		$days = $_POST['days'];
		addItem($valueItem,$days);	
	}

function addItem ($valueItem,$days){
	//парсим на две переменные
	list($idItem, $id_user) = explode(":", $valueItem);
	// Добавляем 1 в таблицу given, для того чтобы убрать с отображения на главной
	$sql1 = mysql_query("UPDATE `item` SET `given` = '1' WHERE `id` = '$idItem'");
		echo mysql_error();	
		$now=date("Y-m-d H:i:s");
		$sql2 = mysql_query("INSERT INTO `user_item` (`id_user`, `id_item`, `time`, `dead_time`, `status`) VALUES ('$id_user', '$idItem', '$now', '$days', '0')");
	echo mysql_error();	
}
//------------------------------------------------------------------------------------------------------
//Функция возврата оборудования
if ( isset( $_POST['deleteItem'] ) ){
		$valueDeleteItem = $_POST['deleteItem'];
		deleteItem($valueDeleteItem);			
	}

function deleteItem ($valueDeleteItem){
	list($idItemInTable_Item, $id_user, $idItemInTable_User_item ) = explode(":", $valueDeleteItem);
	//--------------------------------------------------------------------------------------------------
	//Возвращаем 
	$sqlzapros1 = mysql_query("UPDATE `item` SET  `given` = '0' WHERE `id` = '$idItemInTable_Item'");
	echo mysql_error();
	//--------------------------------------------------------------------------------------------------
	//запрос всей строки из ЮЗЕР ИТЕМ. Для дальнейшего переноса в таблицу history_users_item
	$now = date("Y-m-d H:i:s");
	$zaprosStrokyDlyaPerenosa = mysql_query("SELECT * FROM user_item WHERE `id` = '$idItemInTable_User_item'");
	echo mysql_error();
	$result_zaprosStrokyDlyaPerenosa = mysql_fetch_array($zaprosStrokyDlyaPerenosa);
	$id_userForHistory = $result_zaprosStrokyDlyaPerenosa["id_user"];
	$id_itemForHistory = $result_zaprosStrokyDlyaPerenosa["id_item"];
	$timeForHistory = $result_zaprosStrokyDlyaPerenosa["time"];
	$deadTimeForHistory = $result_zaprosStrokyDlyaPerenosa["deadTime"];
	//Удаляем строку из которой получили данные
	$sqlzapros2 = mysql_query("DELETE FROM user_item WHERE `id` = '$idItemInTable_User_item'");
	echo mysql_error();
	$sqlzapros3 = mysql_query("INSERT INTO `history_users_item` (`id_user`, `id_item`, `time`, `dead_Time`, `refund_Time` ,  `status`) VALUES ('$id_userForHistory', '$id_itemForHistory', '$timeForHistory', '$deadTimeForHistory', '$now', '1')");
	echo mysql_error();
}
//------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------------
//функция добавления нового оборудования в базу данных

Function add_item (){
	
		// В PHP 4.1.0 и более ранних версиях следует использовать $HTTP_POST_FILES
					// вместо $_FILES.
					$uploaddir = '/var/www/uploads/';
					$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
					echo '<pre>';
					if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
						echo "Файл корректен и был успешно загружен.\n";
					} else {
						echo "Возможная атака с помощью файловой загрузки!\n";
					}
					echo 'Некоторая отладочная информация:';
					print_r($_FILES);
					print "</pre>";
}

//-----------------------------------------------------------------------------------------------------------------------
//Вывод взятых единиц оборудования на страничке profile.php
//-------------------------------------------
















				

?> 