<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
        
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px">
                    <?php
                        include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h3 class="text-center my-2">Prescribe</h3>    
                    <?php
                        if(isset($_GET['doc_id'])&& isset($_GET['appdate'])){
                            $appdate = $_GET['appdate'];
                            $query=mysqli_query($connect,"select * from prescribe where appdate_pre='$appdate' ") ;                        
                            $row=mysqli_fetch_array($query);
                        }
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 jumbotron">
                                <div class="container">
                                    <div class="form-group">
                                        <label>Diagnostic:</label>
                                        <textarea id="diagnostic" class="form-control my-2" rows ="5" name="diagnostic" disabled required><?php echo $row['diagnostic']?></textarea>
                                    </div>                     
                                                            
                                    <div class="form-group">
                                        <label>Prescription:</label>
                                        <textarea id="prescription"class="form-control my-2" rows ="5" name="prescription" disabled required><?php echo $row['prescription']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Medicine name:</label>
                                        <input class="form-control" type="text" name="medicine" id="medicine" readonly="readonly" value="<?php echo $row['medicine'] ?>"/>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Medicine price:</label>
                                        <input class="form-control" type="text" name="price" id="price" readonly="readonly" value="<?php echo $row['price'] ?>"/>
                                        
                                    </div>
                                </div>
                                
                                <a href="appointment.php"><button class="btn btn-primary my-2" style="margin-left: 50pc;">Back</button></a>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
    </div>
</body>
</html>