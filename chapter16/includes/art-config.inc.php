<?php



define('DBCONNECTION', 'mysql:host=localhost;dbname=art-small');
define('DBUSER', 'root');
define('DBPASS', '');


spl_autoload_register(function ($class) {
    $file = 'lib/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
});

/* cloud 9 DB connection */
$ip = getenv('IP');
$port = '3306';
$user = getenv('');
//$connection = "mysql:host=$ip;port=$port;dbname=art-small;charset=utf8mb4;";
//$pdo = DatabaseHelper::setConnectionInfo(array(DBCONNECTION, $user, ''));

/* localhost connection */
$pdo = DatabaseHelper::setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));

?>
