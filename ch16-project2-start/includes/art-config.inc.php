<?php



define('DBCONNECTION', 'mysql:host=localhost;dbname=newart');
define('DBUSER', 'root');
define('DBPASS', '');


spl_autoload_register(function ($class) {
    $file = 'lib/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
});

$ip = getenv('IP');
$port = '3306';
$user = getenv('root');
$connection = "mysql:host=$ip;port=$port;dbname=newart;charset=utf8mb4;";
//$pdo = DatabaseHelper::setConnectionInfo(array(DBCONNECTION, $user, ''));

/* localhost connection */
$pdo = DatabaseHelper::setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));

?>
