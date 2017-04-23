<?php


ob_start();

session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','mysql.hostinger.in');
define('DBUSER','u713899054_icici');
define('DBPASS','Icici2017**');
define('DBNAME','u713899054_icici');


//application address
define('DIR','http://domain.com/');
define('SITEEMAIL','email@email.com');

try {

    //create PDO connection
    $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    //show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection



?>
