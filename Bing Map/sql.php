<?php
$mysql_conf = array(
    'host'  => '127.0.0.1',
    'db'   => '000798153',
    'db_user' => 'root',
    'db_pwd' => '',
);
try {
    $pdo = new PDO("mysql:host=" . $mysql_conf['host'] . ";dbname=" . $mysql_conf['db'], $mysql_conf['db_user'], $mysql_conf['db_pwd']); //创建一个pdo对象  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    //set_exception_handler("cus_exception_handler");  
} catch (PDOException $e) {
    die("connect error:" . $e->getMessage());
}

