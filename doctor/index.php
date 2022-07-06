<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                        include("sidenav.php")
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="my-3">
                        Doctor Dashboard
                    </h5>
                    <div class="col-md-12 my-1">
                        <div class="row">
                            <div class="col-md-3 bg-success mx-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="text-white my-2">My Profile</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="profile.php">
                                                <i class="fa fa-user-circle fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 bg-info mx-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                //print_r($_SESSION);
                                                $id = $_SESSION['doctor'];                                                
                                                $appointment = mysqli_query($connect,"SELECT * FROM appointment where doc_id = '$id'");
                                                $num3 = mysqli_num_rows($appointment);
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $num3 ?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Appointment</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="appointment.php">
                                                <i class="fa fa-calendar fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>