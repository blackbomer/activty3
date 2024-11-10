<?php
//<!--actividad 3 creada  por jordi sala sanglas-->
define('DB_SERVER', 'db');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'secret');
define('DB_NAME', 'app_act3');

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if ($connection == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
