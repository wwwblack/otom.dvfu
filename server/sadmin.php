<?
session_start(); // стартуем сессию
include("mysql.php");// подключаем файл с настройками для коннекта к БД
include("config.php"); // подключаем настройки скрипта
include("func.php"); // подключаем функции скрипта

### Блок обработки выхода из Бэк_Офиса ###
if(@$_GET['action'] == "logout") // если в адресной строке переменная action равна "logout"
{                                            
    if(isset($_SESSION['login']) && isset($_SESSION['password'])) // если существуют сессионные переменные login и password
    {
        session_unregister("login"); // удаляем
        session_unregister("password"); // удаляем
        unset ($_SESSION['login'],$_SESSION['password']);// удаляем
        session_destroy();// убиваем сессию
    }
}
### Конец блока обработки выхода из Бэк_Офиса 

### Блок обработки данных, пришедших из формы авторизации ###
// если в форму авторизации были занесены логин и пароль
// И если сессионные переменные НЕзарегистрированы
if(isset($_POST['login']) && isset($_POST['pass']) 
&& !isset($_SESSION['login']) && !isset($_SESSION['pass']))
{
    // Ищем в бд строку, сравнивая имеющиеся даннные, с полученными из формы
    $admins = mysql_query("
    SELECT * FROM admin 
    WHERE login = '". $_POST['login']."' 
    AND pass = '". ($_POST['pass'])."'");     
    // если найдена хоть одна строка
    if(mysql_numrows($admins)) 
    {
        // регистрируем сессионные переменные
        $login = $_POST['login'];
        $password = $_POST['pass'];
        session_register("login");
        session_register("pass");
    }
    // Иначе очень сильно ругаемся, и снова выводим форму авторизации
    else echo "<center>Администратора с данными параметрами входа не существует!<br><br>
    </center>$admin_login_form";
}
// Иначе без ругани, просто выводим форму авторизации
else if(!isset($_SESSION['login']) && !isset($_SESSION['pass'])) echo $admin_login_form;
### Конец блока обработки данных, пришедших из формы авторизации ###