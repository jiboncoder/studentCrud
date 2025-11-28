<?php

// include autoload file here..

include "./autoload.php";

if(isset($_GET['view_id'])){
    $id = $_GET['view_id'];
    $data = find("users", $id  );
    $student = $data->fetch_object();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Personal Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css"
        integrity="sha512-2bBQCjcnw658Lho4nlXJcc6WkV/UxpE/sAokbXPxQNGqmNdQrWqtw26Ns9kFF/yG792pKR1Sx8/Y1Lf1XN4GKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>


    <div style="width: 500px;" class="container">
        <div class="row">
            <div class="col_lg_6 mx-auto mt-5">
                
                <div class="card">
                    <div >
                        <img class="card_imgae" style="width: 250px; margin-left: 22%; margin-top: 10px; paddding: 20px; border-radius: 47%;" src="uploads/users/<?php echo $student->image?>" alt="">
                    </div>
                    <h2 style="text-align:center"><?php echo $student->name?> profile</h2>
                    <div class="card_body">
                        <table class="table">
                            <tr>
                                <td>Uname:</td>
                                <td><?php echo $student->uname?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $student->email?></td>
                            </tr>
                            <tr>
                                <td>Cell:</td>
                                <td><?php echo $student->cell?></td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td><?php echo $student->gender?></td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><?php echo $student->age?></td>
                            </tr>
                            <tr>
                                <td>Dept:</td>
                                <td><?php echo $student->department?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align:center;">
                        <a class="btn btn-secondary my-2" style="width: 90%;" href="index.php">Back</a>
                    </div>
                </div>
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