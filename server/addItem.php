<?php if ( isset( $_POST['addItem'] ) ){
		$valueItem = $_POST['addItem'];
		addItem($valueItem);			
	}

function addItem ($valueItem){
	//������ �� ��� ����������
	list($idItem, $id_user) = explode(":", $valueItem);
	// ��������� 1 � ������� given, ��� ���� ����� ������ � ����������� �� �������
	$sql1 = mysql_query("UPDATE `item` SET `given` = '1' WHERE `id` = '$idItem'");
		echo mysql_error();	
	$now=date("Y-m-d H:i:s");
	echo $now;
	$sql2 = mysql_query("INSERT INTO `user_item` (`id_user`, `id_item`, `time`, `dead_Time`, `status`) VALUES ('$id_user', '$idItem', '$now', '0', '0')");
	echo mysql_error();	
}

?>