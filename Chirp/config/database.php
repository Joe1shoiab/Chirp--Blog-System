<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'HN(Y6e.hW[Bh(7ir');
define('DB_NAME', 'chirp');


try{
    
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME; 
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    
    
}catch(PDOException $e){

    echo "Faild to connect.";
    
}









?>