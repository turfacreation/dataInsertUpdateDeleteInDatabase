<?php
require_once("./header.php");
$id = $_GET['id'] ?? header("location:./"); // if entered without id the function header("location:./") automatically redirect to main location.
$id =  $conn->real_escape_string($id); //if entered wrong id or facke id the function can not do this
$sql = "SELECT * FROM `stuInfo` WHERE `id` = '$id'";
$result = $conn->query($sql);
$result->num_rows == 0 ? header("location:./") : null; //if entered wrong id or facke or == 0,  then the function can not do this and she redirect to main location
$obj = $result->fetch_object();
if (isset($_POST['deleteStudent'])) {
    $result = $conn->query("DELETE FROM `stuInfo` WHERE `id`=$id");
    if ($result) {
        $delImg = unlink("./uploads/" . $obj->simg); // this function use for delete img from server or db or folder
        if ($delImg) {
            echo "Student Delete Successfully";
            echo "<script> setTimeout(()=> location.href='./', 1000) </script>";
        } else {
            echo "Students Not Deleted";
        }
    }
}
?>

<div class="container-fluid text-center">
    <h2 class="text-center text-danger bg-dark py-3">Delete Student</h2>
    <form action="" method="post">
        <h3>Are you sure you want to delete this student?</h3>
        <input type="submit" value="Yes" name="deleteStudent">
        <a href="./"><button type="button">No</button></a>
    </form>

</div>

<?php require_once("./footer.php") ?>