<?php

// Добавление обычного текста в бд. Обратная связь

session_start();
include("mysql.php");
include("function.php");
$user_id = $_SESSION['id']; 
$textWant = $_POST['textWant'];

$sql1 = mysql_query("INSERT INTO `feedback` (`id_user`, `text_feedback`) VALUES ('$user_id', '$textWant')");
echo mysql_error();	

echo "
	<script type=\"text/javascript\">
	$(document).ready (function (){
		alert (\"Текст успешно адресован  разработчику .\");
		document.location.href = \"main.php\";
	});
	</script>
";


?>