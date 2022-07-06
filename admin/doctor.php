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
                
                <div class="col-md-2">
                <h5 class="text-center my-3">Add Doctor</h5>
                    <?php
                        if(isset($_POST['add'])){
                            
                            $name = $_POST['name'];
                            $dobirth = $_POST['dobirth'];
                            $gender = $_POST['gender'];     
                            $email = $_POST['email'];
                            $password = $_POST['pass'];
                            $con_pass = $_POST['con_pass'];
                            $phone = $_POST['phone'];
                            $address = $_POST['address'];
                            $spec = $_POST['spec'];
                            $docFees = $_POST['docFees'];
                    
                            $error = array();
                    
                            if(empty($name)){
                                $error['doctor'] = "Enter Name";
                            }else if(empty($dobirth)){
                                $error['account'] = "Enter Date Of Birth";
                            }else if($gender == ""){
                                $error['account'] = "Select Your Gender";
                            }else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
                                $error['doctor'] = "Invalid email address";
                            }else if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)){
                                $error['doctor'] = "Invalid Password";
                            }else if($con_pass != $password){
                                $error['doctor'] = "Both password do not match";
                            }else if(!preg_replace('/[^0-9]/', '', $phone)){
                                $error['account'] = "Invalid Number";
                            }else if(empty($address)){
                                $error['account'] = "Enter Address";
                            }else if(empty($spec)){
                                $error['doctor'] = "Enter Spec";
                            } else if(empty($docFees)){
                                $error['doctor'] = "Enter docFees";
                            }
                    
                            if(count($error)==0){
                                $query = "INSERT INTO doctors (name,dateofbirth,gender,email,password,phone,address,spec,status,date_reg,docFees) VALUES('$name','$dobirth','$gender','$email','$password','$phone','$address','$spec','Approve',NOW(),'$docFees') ";
                                $res = mysqli_query($connect,$query);

                                // $que = "UPDATE doctors SET status='Approve' ";
                                // mysqli_query($connect,$que);
                    
                                if($res){
                                    header("Location: doctor.php");
                                }else{
                                    echo "<script>alert('failed')</script>";
                                }
                            }
                        }
                    ?>
                    <form action="" method="POST" class="my-2">

                        <div>
                            <?php
                                if(isset($error['doctor'])){
                                    $sh = $error['doctor'];
                                    $show = "<p class='alert alert-danger'>$sh</p>";
                                    }else{
                                        $show = "";
                                }
                                echo $show;
                                // $id = $_POST['id'];
                                // $query = "UPDATE doctors SET status='Approve' WHERE id='$id'";
                                // mysqli_query($connect,$query);
                            ?>
                        </div>  

                        <div class="form-group">
                            <label for="">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control my-2" autocomplete="off" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label for="">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dobirth" id="patient_date_of_birth" class="form-control my-2" autocomplete="off" placeholder="Enter Date of Birth">
                        </div>

                        <div class="form-group">
                            <label for="">Gender<span class="text-danger">*</span></label>
                            <select name="gender" class="form-control my-2" id="">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>                                    
                        </div>
                        
                        <div class="form-group">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control my-2" autocomplete="off" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="">Password<span class="text-danger">*</span></label>
                            <input type="password" name="pass" class="form-control my-2" autocomplete="off" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <label for="">Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="con_pass" class="form-control my-2" autocomplete="off" placeholder="Enter Confirm Password">
                        </div>

                        <div class="form-group">
                            <label for="">Spec<span class="text-danger">*</span></label>
                            <input type="text" name="spec" class="form-control my-2" autocomplete="off" placeholder="Enter Spec">
                        </div>

                        <div class="form-group">
                            <label for="">Phone No<span class="text-danger">*</span></label>
                            <input type="number" name="phone" class="form-control my-2" autocomplete="off" placeholder="Enter Phone Number">
                        </div>

                        <div class="form-group">
                            <label for="">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control my-2" autocomplete="off" placeholder="Enter Address">                                        
                        </div>

                        <div class="form-group">
                            <label for="">docFees<span class="text-danger">*</span></label>
                            <input type="number" name="docFees" class="form-control my-2" autocomplete="off" placeholder="Enter docFees">                                        
                        </div>
                        
                        <input type="submit" name="add" id="" value="Add Doctor" class="btn btn-info my-2">
                        
                    </form>
                </div>

                <div class="col-md-8">
                    <h5 class="text-center my-3">Total Doctors</h5>
                    <?php 
                        $query = "SELECT *FROM doctors where status='Approve'";
                        $res = mysqli_query($connect,$query);
                        $output ="";

                        $output .="
                            <table class='table table-bordered table-hover'>
                                <tr>                                    
                                    <th>Name</th>
                                    <th>Dateofbirth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Spec</th>
                                    <th>Date Registered</th>
                                    <th>docFees</th>
                                    <th>Action</th>                                    
                                </tr>
                        ";
                        if(mysqli_num_rows($res) < 1){
                            $output .="
                                <tr>
                                    <td colspan='10' class='text-center'>No Doctor.</td>
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
                                    <td>".$row['spec']."</td>
                                    <td>".$row['date_reg']."</td>
                                    <td>".$row['docFees']."</td>                                    
                                    <td>
                                        <a href='edit.php?id=".$row['id']."'>
                                            <button class='btn btn-info'>Edit</button>    
                                        </a>

                                        <a href='delete.php?id=".$row['id']."'>
                                            <button class='btn btn-danger'>Delete</button>
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