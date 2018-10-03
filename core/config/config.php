<?
$host="localhost";
$db_name="library";
$username="root";
$password="";
$charset="utf8";

$dsn = 'mysql:host=' . $host . ";dbname=" . $db_name . ";charset=" . $charset;
        R::setup( $dsn,$username,$password ); //установка подключения
?>