
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'students';

// Create connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die('Unable to connect to database: ' . $conn->connect_error);
}

// Drop database
$sql = 'DROP DATABASE ' . $database;
if ($conn->query($sql)) {
    echo "Database '$database' deleted successfully.\n";
} else {
    echo "Error dropping database '$database': " . $conn->error . "\n";
}

// Close connection (not necessary as PHP automatically closes it)
//$conn->close();
?>





<?php/*
 $host ='localhost';
 $user = 'root';
 $password = '';
 //$conn = new mysqli("localhost", "root", "");
 $conn = new mysqli($host, $user, $password);
   
 if ($conn->connect_errno > 0) {
    die('Unable to connect to database [' . $conn->connect_error . ']');
}
   
   $sql = 'DROP DATABASE students';
   $result = $conn->query( $sql, $conn );
   
   if(! $result ) {
    die('Could Not Drop Database "students" [' . $conn->connect_error . ']');
   }
   
   echo "Database deleted successfully\n";
   
  // mysql_close($conn);
*/?>