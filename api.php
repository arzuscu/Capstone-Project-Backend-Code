<?php
$servername = "localhost";
$username = "root";
$password = "team15";
$dbname = "Dashboard";
$temp = $_REQUEST['t'];
$humi = $_REQUEST['h'];
date_default_timezone_set('EST');
$date =date('Y-m-j');
$time = date('G:i:s');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO sensorData(temperature, humidity, date, time) VALUES (:temp, :h, :d, :t)");
    $stmt->bindParam(":temp", $temp);
    $stmt->bindParam(":h", $humi);
    $stmt->bindParam(":d", $date);
    $stmt->bindParam(":t", $time);

    $stmt->execute();
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>



