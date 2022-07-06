<?php
    include("include/connection.php");

    if(isset($_POST['apply'])){
        $name = $_POST['name'];
        $dobirth = $_POST['dobirth'];
        $gender = $_POST['gender'];        
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $con_pass = $_POST['con_pass'];
        $spec = $_POST['spec'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $error = array();

        if(empty($name)){
            $error['account'] = "Name";
        }else if(empty($dobirth)){
            $error['account'] = "Enter Date Of Birth";
        }else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
            $error['account'] = "Invalid email address";
        }else if(!preg_replace('/[^0-9]/', '', $phone)){
            $error['account'] = "Invalid Number";
        }else if($gender == ""){
            $error['account'] = "Select Your Gender";
        }else if(empty($address)){
            $error['account'] = "Enter Address";
        }else if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)){
            $error['account'] = "Invalid Password";
        }else if($con_pass != $password){
            $error['account'] = "Both password do not match";
        }else if(empty($spec)){
            $error['spec'] = "Enter spec";
        }

        if(count($error)==0){
            $query = "INSERT INTO doctors(name,dateofbirth,gender,email,password,phone,address,spec,status,date_reg) VALUES('$name','$dobirth','$gender','$email','$password','$phone','$address','$spec','Pendding',NOW()) ";
            $res = mysqli_query($connect,$query);

            if($res){
                header("Location: doctorlogin.php");
            }else{
                echo "<script>alert('failed')</script>";
            }
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creat Account</title>
</head>
<body>
    <?php
        include("include/header.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row ">
                <div class="col-md-3"></div>
                <div class="col-md-6 my-2 jumbotron">
                    <h5 class="text-center text-info my-2">Creat Account</h5>
                    <form action="" method="POST" class="my-2">

                    <div>
                        <?php
                            if(isset($error['apply'])){
                                $sh = $error['apply'];
                                $show = "<p class='alert alert-danger'>$sh</p>";
                                }else{
                                    $show = "";
                            }
                            echo $show;
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
                        
                        <input type="submit" name="apply" id="" value="Create Account" class="btn btn-info my-2">
                        <p>I already have an account <a href="doctorlogin.php">Click Here</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- <script>

$(document).ready(function(){

	$('#patient_date_of_birth').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
    });
});
</script> -->