<?php
require_once("./header.php");
$sql = "SELECT * FROM `stuinfo`  ORDER BY `id` ASC";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "No students Found";
} else { //else start 
?>
<div class="container-fluid m-0 m-auto">
    <table class="table  table-striped table-bordered">
        <thead class="text-center">
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Stu Name</th>
                <th scope="col">Email</th>
                <th scope="col">Pass</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">Hobby</th>
                <th scope="col">Class</th>
                <th scope="col">Stu Image</th>
                <th scope="col">Created_at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <?php
            $sn = 1;
            while ($row = $result->fetch_object()) { //start while loop 
            ?>
        <tr>
            <td><?= $sn++ ?></td>
            <td><?= $row->sname ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->pass ?></td>
            <td><?= $row->dob ?></td>
            <td><?= $row->gender ?></td>
            <td><?= $row->hobby ?></td>
            <td><?= $row->sclass ?></td>
            <td><img src="./uploads/<?= $row->simg ?>" alt="" style="height: 40px"></td>
            <td><?= $row->created_at ?></td>
            <td>
                <a href="./editStudent.php?id=<?php echo $row->id ?>"><button class="btn btn-dark btn-sm"><i
                            class="fa-solid fa-pen-to-square fa-lg" style="color: #00e639;"></i></button></a></br></br>
                <a href="./deleteStudent.php?id=<?php echo $row->id ?>"><button class="btn btn-dark btn-sm"><i
                            class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i></button></a>
            </td>
        </tr>
        <?php
            } //end while loop
            ?>
    </table>
</div>
<?php
} //else end
?>

<?php
require_once("./footer.php");
?>


<!-- For using fech_assoc function call will be associative array type  -->
<?php /* 

            $sn = 1;
            while ($row = $result->fetch_assoc()) { //start while loop 
        <tr>
        <td><?= $sn++ ?></td>
<td><?= $row['sname'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['pass'] ?></td>
<td><?= $row['dob'] ?></td>
<td><?= $row['gender'] ?></td>
<td><?= $row['hobby'] ?></td>
<td><?= $row['sclass'] ?></td>
<td><?= $row['simg'] ?></td>
<td><?= $row['created_at'] ?></td>
<td>
    <a href="./editStudent.php?id= <?php echo $row->id ?>"><button class="btn btn-info btn-sm">Edit</button></a>
    <a href="./deleteStudent.php?id=<?php echo $row->id ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
</td>
</tr>

<?php
            } //end while loop


            ........................................
             IF I WANT TO USE FOREACH LOOP THE CONDITION WILL AUTOMATICALLY CONVERT ASSOCIATIVE ARRAY
             $sn = 1;
             foreach ($result as $row){
                <td><?= $row["sname"] ?></td>
}
................................................................
*/ ?>