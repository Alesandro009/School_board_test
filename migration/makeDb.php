<?php
require __DIR__ . '/../autoload.php';
$conn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE ".$_ENV['DB_DATABASE'];
if (mysqli_query($conn, $sql)) {
    echo "Database ".$_ENV['DB_DATABASE']." created successfully";
}
else
{
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>