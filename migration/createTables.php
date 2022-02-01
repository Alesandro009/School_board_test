<?php
require __DIR__ . '/../dbConnection.php';

try {
    $database = new dbConnection();
    $dbConn=$database->getConnection();
    $tables=[
        "Students"=>"CREATE TABLE students (id MEDIUMINT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL)",
        "Boards"=>"CREATE TABLE boards (id MEDIUMINT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL)",
        "Students_Grades"=>"CREATE TABLE students_grades (id MEDIUMINT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,student_id MEDIUMINT(8), grade_id MEDIUMINT(8) NOT NULL, bal MEDIUMINT(8) NOT NULL)"
    ];
    foreach($tables as $nameTable=>$tableQuery){
        if ($dbConn->executeSql($tableQuery)) {
            echo "Table ".$nameTable." created.\n";
        }
    }
   
} catch (Exception $e) {
    $message = json_decode($e->getMessage());
    echo $message->errorInfo->message."\n";
}