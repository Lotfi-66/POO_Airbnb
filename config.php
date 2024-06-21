<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'airbnb_clone');

// Connexion à la base de données
function connect() {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}
?>
