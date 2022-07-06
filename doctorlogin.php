<?php
    SESSION_START();

    include("include/connection.php");

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $error = array();

        if(empty($email)){
            $error['login'] = "Enter Email";
        }else if(empty($password)){
            $error['login'] = "Enter Password";
        }else{

            $qq = mysqli_query($connect,"SELECT * FROM doctors WHERE email='$email' AND password='$password'");
            $row = mysqli_fetch_array($qq);

            if(mysqli_num_rows($qq) ==0 ){
                $error['login'] = "Invaild Username or Password";
            }else{
                $_SESSION['doctor'] = $row['id'];
                header("Location:doctor/index.php");
                exit();
            }
        }

        // if(count($error)==0){
        

        //     $query = "SELECT * FROM doctors WHERE email='$email' AND password='$password'";
        //     $result = mysqli_query($connect,$query);

        //     if(mysqli_num_rows($result)){
        //         echo "<script>alert('You have Login As a doctor')</script>";
                
        //         $_SESSION['doctor'] = $email;
        //         header("Location:doctor/index.php");
        //         exit();
        //     }else{
        //         echo "<script>alert('Invaild Username or Password')</script>";
        //     }
        // }
        
    }
    //print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
</head>
<body>
    <?php
        include("include/header.php");
        
    ?>       
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 my-5 jumbotron">
                <h5 class="text-center my-3">Doctor Login</h5>
                    <form action="" method="post" class="my-2">

                            <div>
                                <?php
                                    if(isset($error['login'])){
                                        $sh = $error['login'];
                                        $show = "<p class='alert alert-danger'>$sh</p>";
                                    }else{
                                        $show = "";
                                    }
                                    echo $show;
                                ?>
                            </div>

                        <div class="form-group">
                            <label for="" class="my-2">Email</label>
                            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="" class="my-2">Password</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                        </div>

                        <input type="submit" name="login" id="" class="btn btn-success my-3" value="Login">
                        
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>