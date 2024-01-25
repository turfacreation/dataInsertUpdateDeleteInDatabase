<?php
$host ='localhost';
$user = 'root';
$password = '';
//$conn = new mysqli("localhost", "root", "");
$conn = new mysqli($host, $user, $password);
if ($conn->connect_errno > 0) {
    die('Unable to connect to database [' . $conn->connect_error . ']');
}

//this is connect to the database or failed
$conn->query("CREATE DATABASE IF NOT EXISTS `students`");
//the line works when database not available it create a database name as 'studentinfo'

mysqli_select_db($conn, "students");
// this line select the database that created

$stuinfo = "CREATE TABLE IF NOT EXISTS stuinfo
(id int (11) NOT NULL auto_increment,
sname varchar(50) NOT NULL,
email varchar(30) NOT NULL,
pass varchar(50) NOT NULL,
dob varchar(30) NOT NULL,
gender varchar(20) NOT NULL,
hobby varchar(20) NOT NULL,
sclass varchar(11) NOT NULL,
simg varchar(100) NOT NULL,
created_at TIMESTAMP  ,
PRIMARY KEY (id) )";

$conn->query($stuinfo);
?>
<?php
//this is create table if not avaliable it in the database 
?>