<?
session_start(); // �������� ������
include("mysql.php");// ���������� ���� � ����������� ��� �������� � ��
include("config.php"); // ���������� ��������� �������
include("func.php"); // ���������� ������� �������

### ���� ��������� ������ �� ���_����� ###
if(@$_GET['action'] == "logout") // ���� � �������� ������ ���������� action ����� "logout"
{                                            
    if(isset($_SESSION['login']) && isset($_SESSION['password'])) // ���� ���������� ���������� ���������� login � password
    {
        session_unregister("login"); // �������
        session_unregister("password"); // �������
        unset ($_SESSION['login'],$_SESSION['password']);// �������
        session_destroy();// ������� ������
    }
}
### ����� ����� ��������� ������ �� ���_����� 

### ���� ��������� ������, ��������� �� ����� ����������� ###
// ���� � ����� ����������� ���� �������� ����� � ������
// � ���� ���������� ���������� ������������������
if(isset($_POST['login']) && isset($_POST['pass']) 
&& !isset($_SESSION['login']) && !isset($_SESSION['pass']))
{
    // ���� � �� ������, ��������� ��������� �������, � ����������� �� �����
    $admins = mysql_query("
    SELECT * FROM admin 
    WHERE login = '". $_POST['login']."' 
    AND pass = '". ($_POST['pass'])."'");     
    // ���� ������� ���� ���� ������
    if(mysql_numrows($admins)) 
    {
        // ������������ ���������� ����������
        $login = $_POST['login'];
        $password = $_POST['pass'];
        session_register("login");
        session_register("pass");
    }
    // ����� ����� ������ ��������, � ����� ������� ����� �����������
    else echo "<center>�������������� � ������� ����������� ����� �� ����������!<br><br>
    </center>$admin_login_form";
}
// ����� ��� ������, ������ ������� ����� �����������
else if(!isset($_SESSION['login']) && !isset($_SESSION['pass'])) echo $admin_login_form;
### ����� ����� ��������� ������, ��������� �� ����� ����������� ###