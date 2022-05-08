<?php

/** @var \PDO  $conn = ""*/;

try {
    $servername = "localhost:3306";
    $dbname = "lepas";
    $username = "root";
    $password = "1234";

    $conn = new PDO(
        "mysql:host=$servername; dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
