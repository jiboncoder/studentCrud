<?php

// include autoload file here..

include "./autoload.php";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dept = $_POST['dept'];

    $mail_check = connection()->query("SELECT email FROM users WHERE email='$email'");

    $uni_name = move($_FILES["image"]);


    if(empty($name) || empty($uname) || empty($email) || empty($cell) || empty($gender) || empty($age) || empty($dept) || empty($uni_name)){
        
        $msg = msg('All Fields Are Required');

    }else if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

        $msg = msg('Invalid Email Address');

    }else if($mail_check->num_rows > 0){
        
        $msg = msg('Email is already taken.', 'warning');

    }else{
        
        

        create("INSERT INTO users(name, uname, email, cell, gender, age, department, image) VALUES('$name', '$uname', '$email', '$cell', '$gender', '$age', '$dept', '$uni_name')");

        $msg = msg('Data Inserted Success', 'success');

    }
}

 
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $msg = delete("users", $id);
    
}

if(isset($_GET['image'])){
    $image_name = $_GET['image'];
    unlink('uploads/users/'.$image_name);
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



    <div class="wrap-table">
        <a class="btn btn-primary mb-3" href="#modal" data-bs-toggle="modal">Add New Student</a>
        <br>
        <?php
            if(isset($msg)){
                echo$msg;
            }        
        
        ?>
        <br>
        <div class="card shadow">
            <form action="" method="POST">
                <h1 style="text-align: center; padding: 20px;">WELCOME TO DIPTI</h1>
                <div class="my-3 d-flex justify-content-center">
                    <input name="search" type="text" class="form-control w-50" placeholder="Search here...">
                    <button name="searchBtn" type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <div class="card-body">
                <h2>All Data</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Uname</th>
                            <th>Email</th>
                            <th>Cell</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Department</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(isset($_POST['searchBtn'])){
                            echo $value = $_POST['search'];
                            $data = connection()->query("SELECT * FROM users WHERE name LIKE '%$value%'");

                        }else{

                            $data = connection()->query('SELECT * FROM users');
                        }

                        

                        $i=1;
                        while($students = $data->fetch_object()){
                        
                        ?>
                        <tr>
                            <td><?php echo $i; $i++?></td>
                            <td><?php echo $students->name?></td>
                            <td><?php echo $students->uname?></td>
                            <td><?php echo $students->email?></td>
                            <td><?php echo $students->cell?></td>
                            <td><?php echo $students->gender?></td>
                            <td><?php echo $students->age?></td>
                            <td><?php echo $students->department?></td>
                            <td><img src="./uploads/users/<?php echo $students->image ?>" alt=""></td>
                            
                            <td>
                                <a class="btn btn-sm btn-info" href="profile.php?view_id=<?php echo $students->id?>">View</a>
                                <a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $students->id?>">Edit</a>
                                <a id="delete_user" class="btn btn-sm btn-danger" href='?delete_id=<?php echo $students->id?>&image=<?php echo $students->image?>'>Delete</a>
                            </td>
                        </tr>
                        <?php

                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap shadow">
                        <div class="card">
                            <div class="card-body">
                                <h2>Add New Student</h2>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input name="name" value="<?php if(isset($_POST['name'])){
                                            echo $_POST['name'];
                                        }?>" class="form-control" type="text">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Uname</label>
                                        <input name="uname" value="<?php if(isset($_POST['uname'])){
                                            echo $_POST['uname'];
                                        }?>" class="form-control" type="text">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input name="email" value="<?php if(isset($_POST['email'])){
                                            echo $_POST['email'];
                                        }?>" class="form-control" type="text">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Cell</label>
                                        <input name="cell" value="<?php if(isset($_POST['cell'])){
                                            echo $_POST['cell'];
                                        }?>" class="form-control" type="text">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Gender</label><br>
                                        <label for="">
                                            <input name="gender" value="male" type="radio">Male
                                        </label>
                                        <label for="">
                                            <input name="gender" value="female" type="radio">Female
                                        </label>
                                        <label for="">
                                            <input name="gender" value="others" type="radio">Others
                                        </label>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Age</label>
                                        <input name="age" value="<?php if(isset($_POST['age'])){
                                            echo $_POST['age'];
                                        }?>" class="form-control" type="text">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select class="form-control" name="dept" id="">
                                            <option selected disabled value="">Choose A Department</option>
                                            <option value="cse">CSE</option>
                                            <option value="eee">EEE</option>
                                            <option value="civil">Civil</option>
                                            <option value="textile">Textile</option>
                                            <option value="machanical">Machanical</option>
                                        </select>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="">Choose an Image</label><br>
                                        <img style="width: 200px;" id="preview_photo" src="" alt=""><br>
                                        <label for="profile_photo"><img src="./assets/image/17840-200.png" alt=""></label>
                                        <input id="profile_photo" name="image" class="form-control" type="file">
                                    </div><br>
                                    <div class="form-group text-right">
                                        <input name="add" class="btn btn-primary" type="submit" value="Sign Up">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
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