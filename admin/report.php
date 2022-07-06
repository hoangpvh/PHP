<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Report</title>
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
                    <h5 class="text-center ny-2">Total Report</h5>
                    <?php
                        $query = "SELECT *FROM contact";
                        $res = mysqli_query($connect,$query);

                        $output ="";

                        $output .="
                            <table class='table table-bordered table-hover'>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date Send</th>                                 
                                </tr>
                        ";
                        if(mysqli_num_rows($res) < 1){
                            $output .="
                                <tr>
                                    <td colspan='5' class='text-center'>No Report Yet.</td>
                                </tr>
                            ";
                        }

                        while ($row = mysqli_fetch_array($res)){
                            $output .="
                                <tr>
                                    <td>".$row['name']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['message']."</td>
                                    <td>".$row['date_send']."</td>
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