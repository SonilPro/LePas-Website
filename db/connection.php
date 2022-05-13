<?php

$servername = "localhost:3306";
$dbname = "lepas";
$username = "root";
$password = "1234";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
