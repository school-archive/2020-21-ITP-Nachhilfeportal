<?php

if(!function_exists('get_np_mysql_object')) {
    function get_np_mysql_object() {
        global $pdo;
        if (isset($pdo))
            return $pdo;

        $host = getenv("DB_HOST") ? getenv("DB_HOST") : "localhost";
        $username = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");
        $db = "np";

        $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];

        return $pdo = new PDO($dsn, $username, $password, $options);
    }
}
