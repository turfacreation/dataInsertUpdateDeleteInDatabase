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
    //the below code is for image upload
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgType = $_FILES['img']['type'];
    $imgError = $_FILES['img']['error'];
    $imgSize = $_FILES['img']['size'];

    // Validation for image upload
    $imgExt = explode('.', $imgName);
    $imgActualExt = strtolower(end($imgExt));
    $allowed = ['jpg', 'jpeg', 'png'];

if (in_array($imgActualExt, $allowed)) {
    if ($imgError === 0) {
        if ($imgSize < 1000000) {
            $imgNewName = uniqid('', true) . "." . $imgActualExt;
            if (!is_dir('uploads')) {
                mkdir('uploads');
            }
            $imgDestination = 'uploads/' . $imgNewName;
            $imgUpload = move_uploaded_file($imgTmpName, $imgDestination);
            if ($imgUpload) {
                echo "Image Upload Successfully<br>";
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
    
    // this is for mysql validating for anti hackers
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $conemail = $conn->real_escape_string($conemail);
    $password = $conn->real_escape_string($password);
    $dob = $conn->real_escape_string($dob);
    $gender = $conn->real_escape_string($gender);
    //$hobby = $conn->real_escape_string($hobby);
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
        $errPassword = $password;
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
    $sql = "UPDATE `stuinfo` SET `sname`='$name', `email`='$email', `pass`='$password', `dob`='$dob', `gender`='$gender', `hobby`='$hobbyStr', `sclass`='$class', `simg`='$imgName' WHERE `id` = '$id' ";

    // the query will run by below line
    $result = $conn->query($sql); // or $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Student Update Successfully<br>";
        echo "<script> setTimeout(()=> location.href='./', 5000) </script>";
    } else {
        echo "Students Not Update<br>";
    }

    // duplicate the data check
    $dupDataCheckQuery = $conn->query("SELECT * FROM `stuinfo` WHERE `email` = '$email'");
    if($dupDataCheckQuery -> num_rows > 0) {
        echo "Email Already Exist";
        echo "<script> setTimeout(()=> location.href='./', 3000) </script>";
        exit();
    }
}
?>
<?php /*
// Image upload conditions
if (empty($imgName)) {
    $errImg = "<span class='color:red; font-weight:bold; font-size:22px;'>File is not found</span>";
} elseif (!in_array($imgActualExt, $allowed)) {
    $errImg = "<span class='color:red; font-weight:bold; font-size:22px;'>Only jpg, jpeg, and png extensions are allowed</span>";
}

if ($imgError === 0) {
    if ($imgSize < 10000000) {
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }

        // Validate file type using a more secure method (e.g., MIME type)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileMimeType = mime_content_type($imgTmpName);

        if (in_array($fileMimeType, $allowedMimeTypes)) {
            // Create a new image name
            $imgNewName = str_shuffle(date('HisAFdYDyl')) . uniqid('', true) . '.' . $imgActualExt;

            // Move image to the new location
            $imgUpload = move_uploaded_file($imgTmpName, 'uploads/' . $imgNewName);

            if ($imgUpload) {
                echo "<span class='color:green; font-weight:bold; font-size:22px;'>Image Upload Successfully<br></span>";
            } else {
                echo "<span class='color:red; font-weight:bold; font-size:22px;'>Failed to upload image<br></span>";
            }
        } else {
            echo "<span class='color:red; font-weight:bold; font-size:22px;'>Invalid file type<br></span>";
        }
    } else {
        echo "<span class='color:red; font-weight:bold; font-size:22px;'>File size exceeds the maximum limit<br></span>";
    }
}
*/
?>