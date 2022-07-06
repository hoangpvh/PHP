<?php
    SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescribe</title>
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
                    <h5 class="text-center my-3">Prescribe</h5>
                    
                    <?php
                        if(isset($_GET['doc_id']) && isset($_GET['appdate']) && isset($_GET['patient_id'])) {                           
                            $doc_id = $_GET['doc_id'];
                            $appdate = $_GET['appdate'];
                            $patient_id = $_GET['patient_id'];

                            // $q=mysqli_query($connect,"select * from appointment where appdate='$appdate' and doc_id='$doc_id' and patient_id='patient_id'");
                            // $qq=mysqli_fetch_array($q);
                            // $appdate=$qq['appdate'];
                        }   
                        
                        if(isset($_POST['prescribe'])){
                            $appdate=$_POST['appdate'];
                            $doc_id=$_POST['doc_id'];
                            $patient_id = $_POST['patient_id'];
                            $diagnostic = $_POST['diagnostic'];
                            $prescription = $_POST['prescription'];  
                            //$price = $_POST['price'];
                            $name = $_POST['name'];
                            $arr = explode(" ",$name);
                            $tenthuoc = "";
                            $length= count($arr);
                            for($i =1; $i<$length; $i++)
                            {
                                $tenthuoc .= $arr[$i] . " ";
                            }
                            $tenthuoc = trim($tenthuoc);
                            $gia = $arr[0];
                            
                            
                            $query=mysqli_query($connect,"insert into prescribe(appdate_pre,doctor_id,patient_id,diagnostic,prescription,medicine,price) values ('$appdate','$doc_id','$patient_id','$diagnostic','$prescription','$tenthuoc','$gia') ");
                            
                            if($query)
                            {
                                $que=mysqli_query($connect,"update appointment set status='1' where appdate='$appdate' and doc_id='$doc_id' and patient_id='$patient_id'");
                                echo "<script>alert('Prescribed successfully!');</script>";
                                header("Location: appointment.php");   
                            }
                            else{
                                echo "<script>alert('Unable to process your request. Try again!');</script>";
                            }
                            
                        }
                        
                        
                    ?>

<?php
                        function display_medicine() {
                            global $connect;
                            $query="select * from medicine";
                            $result=mysqli_query($connect,$query);
                            while($row=mysqli_fetch_array($result))
                            {
                                $name=$row['medicine'];
                                $price=$row['price'];
                                
                                echo '<option  value="'.$price." ".$name. '">'.$name.'</option>';
                                
                            }
                        }
                        
                    ?>

                    <div class="col-md-12">
                    
                        <form class="form-group" name="prescribeform" method="post" action="prescribe.php">
                    
                            <div class="row">
                                <div class="container">
                                    <div class="form-group">
                                        <label>Diagnostic:</label>
                                        <textarea id="diagnostic" class="form-control my-2" rows ="5" name="diagnostic" required></textarea>
                                    </div>                     
                                                            
                                    <div class="form-group">
                                        <label>Prescription:</label>
                                        <textarea id="prescription"class="form-control my-2" rows ="5" name="prescription" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Medicine name:</label>
                                        <select name="name" id="name"  class="form-control">
                                            <option value="" disabled selected>Select Medicine</option>
                                            <?php 
                                                display_medicine();  
                                            ?>                                                                           
                                        </select>
                                        <script>
                                            document.getElementById('name').onchange = function updatePrice(e) {
                                                var selection = document.getElementById('name').value;
                                                
                                                var price = selection.split(" ")[0];
                                                
                                                document.getElementById('price').value = price;  
                                               
                                                                                   
                                            };
                                            
                                        
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Medicine price:</label>
                                        <input class="form-control" type="text" name="price" id="price" readonly="readonly"/>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="doc_id" value="<?php echo $doc_id ?>" />
                                <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>" />
                                <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />                              
                            </div>

                            
                            <input type="submit" name="prescribe" value="Prescribe" class="btn btn-primary my-2" style="margin-left: 70pc;">
                            
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>            
</body>
</html>



