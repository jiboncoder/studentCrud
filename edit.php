<?php

// include autoload file here..

include "./autoload.php";


if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dept = $_POST['dept'];
    $old_image = $_POST['image_old'];
    $new_image = $_FILES['image_new'];





    if(empty($new_image['name'])){

        $unique_name = $old_image;


    }else{

        $unique_name = move($new_image);
        unlink('uploads/users/'. $old_image);

    }

    $updated_at = date('Y-m-d g:i;s');

    update("Update users SET name='$name', uname='$uname', email='$email', cell='$cell', gender='$gender', age='$age', department='$dept', image='$unique_name', updated_at='$updated_at' WHERE id='$id'");

    $msg = msg('Data Inserted Success', 'success');

}


if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];
    $data = find("users", $edit_id);
    $edit_student = $data->fetch_object();
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css"
        integrity="sha512-2bBQCjcnw658Lho4nlXJcc6WkV/UxpE/sAokbXPxQNGqmNdQrWqtw26Ns9kFF/yG792pKR1Sx8/Y1Lf1XN4GKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div style="width: 600px;" class="container">
        
        <br>
        <?php
            if(isset($msg)){
                echo$msg;
            }        
        
        ?>
        <br>
        <div class="card shadow">
            <div class="card-body">
                <h2>Edit  <?php echo $edit_student->name?>  data</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" class="form-control" value="<?php echo $edit_student->name?>" type="text">
                    </div><br>
                    <div class="form-group">
                        <label for="">Uname</label>
                        <input name="uname" class="form-control" value="<?php echo $edit_student->uname?>" type="text">
                    </div><br>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input name="email" class="form-control" value="<?php echo $edit_student->email?>" type="text">
                        <input type="hidden" value="<?php echo $edit_student->id?>" name="id">
                    </div><br>
                    <div class="form-group">
                        <label for="">Cell</label>
                        <input name="cell" class="form-control" value="<?php echo $edit_student->cell?>" type="text">
                    </div><br>
                    <div class="form-group">
                        <label for="">Gender</label><br>
                        <label for="">
                            <input name="gender" <?php if($edit_student->gender=="male"){
                                echo "checked";
                            }?> value="male" type="radio">Male
                        </label>
                        <label for="">
                            <input name="gender" <?php if($edit_student->gender=="female"){
                                echo "checked";
                            }?> value="female" type="radio">Female
                        </label>
                        <label for="">
                            <input name="gender" <?php if($edit_student->gender=="others"){
                                echo "checked";
                            }?> value="others" type="radio">Others
                            </label>
                    </div><br>
                    <div class="form-group">
                        <label for="">Age</label>
                        <input name="age" class="form-control" value="<?php echo $edit_student->age?>" type="text">
                    </div><br>
                    <div class="form-group">
                        <label for="">Department</label>
                        <select class="form-control" name="dept" id="">
                            <option selected disabled value="">ChoosDepartment</option>
                            <option <?php if($edit_student->department=="cse"){
                                echo "selected";
                            }?> value="cse">CSE</option>
                            <option <?php if($edit_student->department=="eee"){
                                echo "selected";
                            }?> value="eee">EEE</option>
                            <option <?php if($edit_student->department=="civil"){
                                echo "selected";
                            }?> value="civil">Civil</option>
                            <option <?php if($edit_student->department=="textile"){
                                echo "selected";
                            }?> value="textile">Textile</option>
                            <option <?php if($edit_student->department=="machanical"){
                                echo "selected";
                            }?> value="machanical">Machanical</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="">Choose an Image</label><br>
                        
                        <img style="width: 200px;" id="preview_photo" src="uploads/users/<?php echo $edit_student->image?>" alt=""><br>
                        <label for="profile_photo_new"><img src="./assets/image/17840-200.png" alt=""></label>
                        <input name="image_old" class="form-control" type="hidden" value="<?php echo $edit_student->image?>">
                        <input id="profile_photo_new" name="image_new" class="form-control" type="file">
                    </div><br>
                    <div class="d-flex justify-content-between">
                        <input name="update" class="btn btn-primary" type="submit" value="Update Data">
                        <a class="btn btn-secondary" href="index.php">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    
    





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"
        integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js"
        integrity="sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/custom.js"></script>
</body>

</html>