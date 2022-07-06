<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Doctors</title>
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
                        include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">Total Patient</h5>
                    <?php 
                        $query = "SELECT *FROM patient";
                        $res = mysqli_query($connect,$query);
                        $output ="";

                        $output .="
                            <table class='table table-bordered table-hover'>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date Registered</th>   
                                    <th>Action</th>
                                </tr>
                        ";
                        if(mysqli_num_rows($res) < 1){
                            $output .="
                                <tr>
                                    <td colspan='8' class='text-center'>No Patient Yet.</td>
                                </tr>
                            ";
                        }

                        while ($row = mysqli_fetch_array($res)){
                            $output .="
                                <tr>
                                    
                                    <td>".$row['name']."</td>
                                    <td>".$row['dateofbirth']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['address']."</td>
                                    <td>".$row['date_reg']."</td>
                                    <td>
                                        <a href='view-pat.php?id=".$row['id']."'>
                                            <button class='btn btn-info'>View</button>    
                                        </a>
                                    </td>
                            ";
                        }
                        $output .="
                            </tr>
                            </table>
                        ";
                        echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>