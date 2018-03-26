<?php
$servername = "localhost";
$username = "root";
$password = "team15";
$dbname = "Dashboard";
$myResult=[];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM sensorData"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
   $myResult = $stmt->fetchAll();

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Dashboard</h2>
  <p>Temperature and Humidity for room C505</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Index</th>
        <th>Humidty</th>
        <th>Temprature</th>
        <th>Date</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <?php
      foreach($myResult as $_result) {
        echo "<tr><td>" . $_result['id']. "</td>";
        echo "<td>" . $_result['temperature']. "</td>";
        echo "<td>" . $_result['humidity']. "</td>";
        echo "<td>" . $_result['date']. "</td>";
        echo "<td>" . $_result['time']. "</td></tr>";
        
      }
      ?>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>

