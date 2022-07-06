<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Income</title>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                        include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2">Total Income</h5>
                    <?php

                        $query = "SELECT *FROM appointment where status='1'";
                        $res = mysqli_query($connect,$query);

                        $output ="";

                        $output .="
                            <table class='table table-bordered'>
                                <tr>
                                    
                                    <th>Doctor</th>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Time</th>  
                                    <th>Service Name</th>  
                                    <th>Service Fees</th>                               
                                    <th>Medicine Price</th>                               
                                </tr>
                        ";
                        if(mysqli_num_rows($res) < 1){
                            $output .="
                                <tr>
                                    <td colspan='6' class='text-center'>No Patient Discharge Yet.</td>
                                </tr>
                            ";
                        }                        

                        while ($row = mysqli_fetch_array($res)){
                            $appdate = $row['appdate'];
                            $q = mysqli_query($connect, "select * from prescribe where appdate_pre='$appdate' ");
                            $row1 = mysqli_fetch_array($q);

                            $doc_id = $row['doc_id'];
                            $qq = mysqli_query($connect, "select * from doctors where id='$doc_id' ");
                            $row2 = mysqli_fetch_array($qq);
                            $output .="
                                <tr>
                                    <td>Dr. ".$row['doctor']."</td>
                                    <td>".$row['patient']."</td>
                                    <td>".$row['appdate']."</td>
                                    <td>".$row['apptime']."</td>
                                    <td>Khám ".$row2['spec']."</td>
                                    <td>".$row['docFees']."</td>  
                                    <td>".$row1['price']."</td>  

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