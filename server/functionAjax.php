<?php

session_start();
include("mysql.php");
include("mainfunction.php"); 
//принимаем значение кнопки чтобы передать её свитч и запустить нужную функцию.
$functionValue = $_POST['functionValue'];
switch ($functionValue){
	//---------------------------------------------------------------
	//Функция вывода
case 1:
	funcionViewContentOnMainPage();
break;

case 6:
	functionViewContentOnFAQPage();
break;

case 7:
	functionAddNewQuestion();
break;

case 8:
	functionAddNewAnswerForQuestion();
break;

}

?>