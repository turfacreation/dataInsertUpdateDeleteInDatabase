<?php require_once("./header.php") ?>

<?php require_once('./Stu_Insert_php_validation_sqlquery.php') ?>
<div class="container">
    <div class="row min-vh-100 d-flex py-3">
        <div class="col-md-8 m-auto border rounded p-4">
            <form action="" method="post" enctype="multipart/form-data">


                <!--Your name tag start here  -->
                <div class="mb-3 form-floating ">
                    <input type="text" name="name" id="" placeholder="Your Name" class="form-control <?= isset($errName) ? 'is-invalid' : null; ?><?= isset($crrName) ? 'is-valid' : null; ?> ">
                    <label for="" class="label">Your Name:</label>
                    <div class="invalid-feedback">
                        <?= $errName ?? null; ?>
                    </div>
                    <div class="valid-feedback"></div>
                </div>
                <!-- Your name tag finished here  -->

                <!-- email and confirm email  -->
                <div class="mb-3 form-floating ">
                    <input type="text" name="email" id="" placeholder=" Your Email" class="form-control <?= isset($errEmail) ? 'is-invalid' : (isset($crrEmail) ? 'is-valid' : null); ?>">
                    <label for="" class="label"> Your Email:</label>
                    <div class="invalid-feedback">
                        <?= $errEmail ?? null; ?>
                    </div>
                </div>

                <div class="mb-3 form-floating ">
                    <input type="text" name="conemail" id="" placeholder="Confirm Email" class="form-control <?= isset($errConEmail) ? 'is-invalid' : (isset($crrConEmail) ? 'is-valid' : null); ?>">
                    <label for="" class="label">Confirm Email:</label>
                    <div class="invalid-feedback">
                        <?= $errConEmail ?? null; ?>
                    </div>
                </div>
                <!-- email and confirm email  -->

                <!-- create password  -->

                <div class="form-floating mb-3 ">
                    <input type="password" name="password" id="pass" class="form-control <?= isset($errPassword) ? "is-invalid" : (isset($crrPassword) ? 'is-valid' : null) ?>">
                    <input type="checkbox" class="form-check form-check-inline" name="" id="showPass">
                    <label for="">Password</label>
                    <div class="invalid-feedback">
                        <?= $errPassword ?>
                    </div>
                </div>

                <script>
                    const showPass = document.getElementById('showPass');
                    const pass = document.getElementById('pass');
                    showPass.addEventListener('click', () => {
                        if (showPass.checked) {
                            pass.setAttribute('type', 'text');
                        } else {
                            pass.setAttribute('type', 'password');
                        }
                    })
                </script>
                <!-- create password  -->


                <!-- date start tag  -->
                <div class="mb-3 form-floating ">
                    <input type="date" name="date" id="fordate" class="form-control <?= isset($errDate) ? 'is-invalid' : (isset($crrDate) ? 'is-valid' : null); ?> ">
                    <label for="fordate" class="form-label">Date of Birth</label>
                    <div class="invalid-feedback">
                        <?= $errDate ?>
                    </div>
                </div>
                <!-- date end tag  -->


                <!-- select gender with radio button  -->
                <div class="mb-3 border rounded  py-3">
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
                <div class="mb-3 border rounded  py-3">
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
                <div class="mb-3 form-floating  ">
                    <select name="class" id="chooseClass" class="form-select">
                        <option value="">-- Choose Your Class</option>
                        <option value="Six" <?= isset($crrClass) && $crrClass == 'Six' ? 'selected' : null; ?>>Six
                        </option>
                        <option value="Seven" <?= isset($crrClass) && $crrClass == 'Seven' ? 'selected' : null; ?>>Seven
                        </option>
                        <option value="Eight" <?= isset($crrClass) && $crrClass == 'Eight' ? 'selected' : null; ?>>Eight
                        </option>
                        <option value="Nine" <?= isset($crrClass) && $crrClass == 'Nine' ? 'selected' : null; ?>>Nine
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
                    <div class="col-6"><input type="file" name="img" id="stuImgFileUpload" class="form-control"></div>
                    <div class="col-6">
                        <img src="" alt="" id="stuImgView" class="img-fluid img-thumbnail rounded float-start">
                        <script>
                            const stuImgFileUpload = document.getElementById('stuImgFileUpload');
                            const stuImgView = document.getElementById('stuImgView');

                            stuImgFileUpload.addEventListener('change', function() {
                                const file = this.files[0]; // this.files means stuImgFileUpload, 0 means 1st file
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
                    <input type="submit" name="addStudent" value="Add Student" class="btn btn-primary btn-md mt-2 ">
                </div>
            </form>
        </div>
    </div>
</div>



<?php require_once("./footer.php") ?>