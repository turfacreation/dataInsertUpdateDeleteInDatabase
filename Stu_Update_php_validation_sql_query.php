<?php
//function for not hacking
function clean($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return ($data);
}

// validation and sql query start form here

if (isset($_POST['updateStudent'])) {
    $name = clean($_POST['name'] ?? null);
    $email = clean($_POST['email'] ?? null);
    $conemail = clean($_POST['conemail'] ?? null);
    $password = clean($_POST['password'] ?? null);
    $dob = clean($_POST['date'] ?? null);
    $gender = clean($_POST['gender'] ?? null);
    $hobby = $_POST['hobby'] ?? []; // checkbox item always array thats why it will be convert arry to string
    $hobbyStr = implode(", ", $hobby); // for convert array to string use imploade() function
    $class = clean($_POST['class'] ?? null);
    //the below code is for image update
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgType = $_FILES['img']['type'];
    $imgError = $_FILES['img']['error'];
    $imgSize = $_FILES['img']['size'];

    // Validation for image upload
    $imgExt = explode('.', $imgName);
    $imgActualExt = strtolower(end($imgExt));
    $allowed = ['jpg', 'jpeg', 'png'];

    // this is for mysql validating for anti hackers
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $conemail = $conn->real_escape_string($conemail);
    $password = $conn->real_escape_string($password);
    $dob = $conn->real_escape_string($dob);
    $gender = $conn->real_escape_string($gender);
    $hobbyStr = $conn->real_escape_string($hobbyStr);
    $class = $conn->real_escape_string($class);
    $imgName = $conn->real_escape_string($imgName);



    //this is for name validation
    if (empty($name)) {
        $errName = "Name is Required";
    } elseif (!preg_match("/^[A-Za-z. ]*$/", $name)) {
        $errName = "Only Letter and White Spaces are allowed";
    } else {
        $crrName = $name;
    }

    //this is for email validation
    if (empty($email)) {
        $errEmail = "Email Is Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) //  elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    {
        $errEmail = "Invalid Email Format";
    } else {
        $crrEmail = $email;
    }

    //this is for confirm email
    if (empty($conemail)) {
        $errConEmail = "Email Confirm  Required";
    } elseif ($email != $conemail) {
        $errConEmail = " Your Email Does Not Match, Please! Confirm.";
    } else {
        $crrConEmail = $conemail;
    }

    //this is for password validation
    if (empty($password)) {
        $errPassword = "Password is required";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/", $password)) {
        $errPassword = "Password must be 5 Characters long & Contain at least </br> one UPPERCASE letter </br> one lowercase letter </br>one digit and </br>one Special Character";
    } else {
        $crrPassword = $password;
    }

    //this is for date validation
    if (empty($dob)) {
        $errDate = "Date of Birth Must be Required";
    } elseif (time() < strtotime('+10 Years', strtotime($dob))) {
        $errDate = "You have must be +10 Years old for Addmission";
    } else {
        $crrDate = $dob;
    }

    //this is for gender validation
    if (empty($gender)) {
        $errGender = "Please Select Your Gender.";
    } else {
        $crrGender = $gender;
    }

    //validation for checkbox field name as hobby

    if (empty($hobby)) {
        $errHobby = "Please Select Your Hobby";
    } else {
        $crrHobby = $hobby;
    }

    //validation for dropdown menu name as class
    if (empty($class)) {
        $errClass = "Please Select Your Class";
    } else {
        $crrClass = $class;
    }


    //student update query.............................................
    $id = $_GET['id'] ?? header("location:./"); // if entered without id the function header("location:./") automatically redirect to main location.
    $id =  $conn->real_escape_string($id); //if entered wrong id or facke id the function can not do this
    $sql = "SELECT * FROM `stuinfo` WHERE `id` = '$id'";
    $result = $conn->query($sql);
    $result->num_rows == 0 ? header("location:./") : null; //if entered wrong id or facke or == 0,  then the function can not do this and she redirect to main location
    $row = $result->fetch_object();
    //this is for students update SQL query

    if (
        isset($crrName) && isset($crrEmail) && isset($crrConEmail) && isset($crrPassword)
        && isset($crrDate) && isset($crrGender) && isset($crrHobby) && isset($crrClass)
        && isset($imgName)
    ) {

        $sql = "UPDATE `stuinfo` SET `sname`='$name', `email`='$email', `conemail`='$conemail', `pass`='$password', `dob`='$dob', `gender`='$gender', `hobby`='$hobbyStr', `sclass`='$class', `simg`='$imgName' WHERE `id` = '$id' ";

        // the query will run by below line
        $result = $conn->query($sql); // or $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<div class='container text-success text-center fs-5'>Student Update Successfully</div>";
            echo "<script> setTimeout(()=> location.href='./', 50000) </script>";
        } else {
            echo "<div class='container text-danger text-center fs-5'>Students Not Update</div>";
        }
    }

    //this is  image upload code
    if (in_array($imgActualExt, $allowed)) {
        if ($imgError === 0) {
            if ($imgSize < 1000000) {
                $imgName = uniqid('', true) . "." . $imgActualExt;
                $imgDestination = 'uploads/' . $imgName;
                $imgUpload = move_uploaded_file($imgTmpName, $imgDestination);
                if ($imgUpload) {
                    $sql = "UPDATE `stuinfo` SET `simg` = '$imgName' WHERE `id` = '$id'";
                    $result = $conn->query($sql);
                    if ($result) {
                        $delFile = unlink("./uploads/" . $row->simg);
                        if ($delFile) {
                            echo "Student Image Update Successfully";
                            echo "<script>setTimeOut(()=> location.herf='./', 2000)</script>";
                        } else {
                            echo "Student Image Not Update";
                        }
                    } else {
                        echo "File not Uploaded<br>";
                    }
                } else {
                    echo "Failed to upload image<br>";
                }
            } else {
                echo "File size exceeds the maximum limit<br>";
            }
        } else {
            echo "Error uploading image<br>";
        }
    } else {
        echo "Invalid file type<br>";
    }
}