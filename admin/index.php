<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                        Admin Dashboard
                    </h5>
                    <div class="col-md-12 my-1">
                        <div class="row">
                            <div class="col-md-3 bg-success mx-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">                                           
                                            <h5 class="text-white my-2">Admin</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="profile.php">
                                                <i class="fa fa-user-cog fa-3x my-4" style="color: white;"></i>
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
                                                $doctor = mysqli_query($connect,"SELECT * FROM doctors where status='Approve'");
                                                $num2 = mysqli_num_rows($doctor);
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $num2 ?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Doctors</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="doctor.php">
                                                <i class="fa fa-user-md fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-3 bg-warning mx-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $patient = mysqli_query($connect,"SELECT * FROM patient ");
                                                $num3 = mysqli_num_rows($patient);
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $num3 ?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Patient</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="patient.php">
                                                <i class="fa fa-procedures fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-danger mx-2 my-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $re = mysqli_query($connect,"SELECT * FROM appointment where userStatus='1' and doctorStatus='1' ");
                                                $num4 = mysqli_num_rows($re);
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $num4 ?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Appointment</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="appointment.php">
                                                <i class="fa fa-calendar-check fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-warning mx-2 my-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $job = mysqli_query($connect,"SELECT * FROM doctors WHERE status ='Pendding'");
                                                $num1 = mysqli_num_rows($job);
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $num1?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Job Request</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="job_request.php">
                                                <i class="fa fa-book-open fa-3x my-4" style="color: white;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2 my-2" style="height:150px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $in = mysqli_query($connect,"SELECT sum(docFees) as profit FROM appointment where status='1' ");
                                                $row = mysqli_fetch_array($in);
                                                $inc = $row['profit'];

                                                $in1 = mysqli_query($connect,"SELECT sum(price) as profit FROM prescribe");
                                                $row1 = mysqli_fetch_array($in1);
                                                $inc1 = $row1['profit'];
                                                
                                            ?>
                                            <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $inc + $inc1 ; ?></h5>
                                            <h5 class="text-white my-2">Total</h5>
                                            <h5 class="text-white my-2">Income</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="income.php">
                                                <i class="fa fa- fa-money-check-alt fa-3x my-4" style="color: white;"></i>
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