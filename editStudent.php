<?php require_once("./header.php") ?>
<?php require_once('./Stu_Update_php_validation_sql_query.php') ?>
<div class="container-fluid">
    <h2 class="text-center text-warning bg-dark py-3">Edit Students</h2>
    <?php
    $id = $_GET['id'] ?? header("location:./"); // if entered without id the function header("location:./") automatically redirect to main location.
    $id =  $conn->real_escape_string($id); //if entered wrong id or facke id the function can not do this
    $sql = "SELECT * FROM `stuInfo` WHERE `id` = '$id'";
    $result = $conn->query($sql);
    $result->num_rows == 0 ? header("location:./") : null; //if entered wrong id or facke or == 0,  then the function can not do this and she redirect to main location
    $row = $result->fetch_object();
    ?>

    <div class="container">
        <div class="row min-vh-100 d-flex py-3">
            <div class="col-md-8 m-auto border rounded p-4">
                <form action="" method="post" enctype="multipart/form-data">


                    <!--Your name tag start here  -->
                    <div class="mb-3 form-floating shadow-sm">
                        <input type="text" name="name" value="<?= $row->sname; ?>" id="" placeholder="Your Name" class="form-control <?= isset($errName) ? 'is-invalid' : null; ?><?= isset($crrName) ? 'is-valid' : null; ?> ">
                        <label for="" class="label">Your Name:</label>
                        <div class="invalid-feedback">
                            <?= $errName ?? null; ?>
                        </div>
                        <div class="valid-feedback"></div>
                    </div>
                    <!-- Your name tag finished here  -->

                    <!-- email and confirm email  -->
                    <div class="mb-3 form-floating shadow-sm">
                        <input type="text" name="email" value="<?= $row->email; ?>" id="" placeholder=" Your Email" class="form-control <?= isset($errEmail) ? 'is-invalid' : (isset($crrEmail) ? 'is-valid' : null); ?>">
                        <label for="" class="label"> Your Email:</label>
                        <div class="invalid-feedback">
                            <?= $errEmail ?? null; ?>
                        </div>
                    </div>

                    <div class="mb-3 form-floating shadow-sm">
                        <input type="text" name="conemail" id="" placeholder="Confirm Email" class="form-control <?= isset($errConEmail) ? 'is-invalid' : (isset($crrConEmail) ? 'is-valid' : null); ?>">
                        <label for="" class="label">Confirm Email:</label>
                        <div class="invalid-feedback">
                            <?= $errConEmail ?? null; ?>
                        </div>
                    </div>
                    <!-- email and confirm email  -->

                    <!-- create password  -->
                    <div class="form-floating mb-3 shadow-sm ">
                        <input type="password" name="password" value="<?= $row->pass; ?>" id="" placeholder="" class="form-control <?= isset($errPassword) ? "is-invalid" : (isset($crrPassword) ? 'is-valid' : null) ?>">
                        <label for="">Password</label>
                        <div class="invalid-feedback">
                            <?= $errPassword ?>
                        </div>

                    </div>
                    <!-- create password  -->


                    <!-- date start tag  -->
                    <div class="mb-3 form-floating shadow-sm">
                        <input type="date" name="date" value="<?= $row->dob; ?>" id="fordate" class="form-control <?= isset($errDate) ? 'is-invalid' : (isset($crrDate) ? 'is-valid' : null); ?> ">
                        <label for="fordate" class="form-label">Date of Birth</label>
                        <div class="invalid-feedback">
                            <?= $errDate ?>
                        </div>
                    </div>
                    <!-- date end tag  -->


                    <!-- select gender with radio button  -->
                    <div class="mb-3 border rounded shadow-sm py-3">
                        <div class="form-check form-check-inline">
                            <label for="" class="form-check-label">Select Gender:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Male" id="male" class="form-check-input <?= isset($gender) && $gender == "Male" ? "Checked" : null; ?>">
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="female" value="Female" class="form-check-input <?= isset($gender) && $gender == "Female" ? "Checked" : null; ?>">
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="custom" value="Custom" class="form-check-input <?= isset($gender) && $gender == "Custom" ? "Checked" : null; ?>">
                            <label for="custom" class="form-check-label">Custom</label>
                        </div>
                        <div class="form-check form-check-inline text-danger">
                            <?= $errGender ?? null; ?>
                        </div>
                    </div>
                    <!-- select gender with radio button  -->



                    <!-- select hobby with checkbox  -->
                    <div class="mb-3 border rounded shadow-sm py-3">
                        <div class="form-check form-check-inline">
                            <label for="" class="form-check-label">Select Hobby:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="hobby[]" id="reading" value="Reading" class="form-check-input<?= isset($crrHobby) && in_array("Reading", $crrHobby) ? "checked" : null; ?>">
                            <label for="reading" class="form-check-label">Reading</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="hobby[]" id="swimming" value="Swimming" class="form-check-input <?= isset($crrHobby) && in_array("Swimming", $crrHobby) ? "checked" : null; ?>">
                            <label for="swimming" class="form-check-label">Swimming</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="hobby[]" id="gardening" value="Gardening" class="form-check-input <?= isset($crrHobby) && in_array("Gardening", $crrHobby) ? "checked" : null; ?>">
                            <label for="gardening" class="form-check-label">Gardening</label>
                        </div>

                        <div class="form-check <?= isset($errHobby) ? 'text-danger' : (isset($crrHobby) ? 'text-success' : null); ?>">
                            <?= $errHobby ?? null; ?>

                            <?php
                            //if (isset($hobby)) {
                            //  foreach ($hobby as $hobbys) {
                            //  echo $hobbys;
                            // }
                            // }
                            ?>
                        </div>

                    </div>
                    <!-- select hobby with checkbox  -->

                    <!-- select class with drop down menu  -->
                    <div class="mb-3 form-floating shadow-sm ">
                        <select name="class" id="chooseClass" class="form-select">
                            <option value="">-- Choose Your Class</option>
                            <option value="Six" <?= isset($crrClass) && $crrClass == 'Six' ? 'selected' : null; ?>>Six
                            </option>
                            <option value="Seven" <?= isset($crrClass) && $crrClass == 'Seven' ? 'selected' : null; ?>>
                                Seven
                            </option>
                            <option value="Eight" <?= isset($crrClass) && $crrClass == 'Eight' ? 'selected' : null; ?>>
                                Eight
                            </option>
                            <option value="Nine" <?= isset($crrClass) && $crrClass == 'Nine' ? 'selected' : null; ?>>
                                Nine
                            </option>
                        </select>
                        <label for="chooseClass">Choose Your Class</label>

                    </div>
                    <div class="form-check form-check-inline <?= isset($errClass) ? 'text-danger' : (isset($crrClass) ? "text-success" : null); ?>">
                        <?= $errClass ?? null; ?>
                    </div>
                    <!-- select class with drop down menu  -->



                    <!-- image upload tag start here -->
                    <div class="row ">
                        <div class="col-6"><input type="file" name="img" value="<?= $row->img; ?>" id="stuImgFileUpload" class="form-control">
                        </div>
                        <div class="col-6">
                            <img src="" alt="" id="stuImgView" class="img-fluid img-thumbnail rounded float-start">
                            <script>
                                const stuImgFileUpload = document.getElementById('stuImgFileUpload');
                                const stuImgView = document.getElementById('stuImgView');

                                stuImgFileUpload.addEventListener('change', function() {
                                    const file = this.files[
                                        0]; // this.files means stuImgFileUpload, 0 means 1st file
                                    if (file) {
                                        const reader = new FileReader();
                                        //FileReader() is js built in class function. "new" use for convert class
                                        reader.addEventListener('load', function() {
                                            stuImgView.setAttribute('src', this.result);
                                            //"this.result" reffer abobe line - "reader" and push into "src"
                                        });
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                        </div>


                    </div>

                    <!-- image upload tag end  here -->

                    <div>
                        <input type="submit" name="updateStudent" value="Update" class="btn btn-primary btn-md mt-2 ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("./footer.php") ?>