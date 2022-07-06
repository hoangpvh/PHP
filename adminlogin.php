<?php
    SESSION_START();

    include("include/connection.php");

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $error = array();

        if(empty($username)){
            $error['admin'] = "Enter Username";
        }else if(empty($password)){
            $error['admin'] = "Enter Password";
        }
        // else if($username != 'uname' || $password != 'password'){
        //     $error['admin'] = "Invaild Username or Password";
        // }

        if(count($error)==0){
            $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $result = mysqli_query($connect,$query);

            if(mysqli_num_rows($result) == 1){
                echo "<script>alert('You have Login As an admin')</script>";
                $_SESSION['admin'] = $username;
                header("Location:admin/index.php");
                exit();
            }else{
                echo "<script>alert('Invaild Username or Password')</script>";
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
    <title>Admin Login</title>
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
                <h5 class="text-center my-3">Admin Login</h5>
                    <form action="" method="post" class="my-2">

                            <div>
                                <?php
                                    if(isset($error['admin'])){
                                        $sh = $error['admin'];
                                        $show = "<p class='alert alert-danger'>$sh</p>";
                                    }else{
                                        $show = "";
                                    }
                                    echo $show;
                                ?>
                            </div>

                        <div class="form-group">
                            <label for="" class="my-2">Username</label>
                            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label for="" class="my-2">Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Enter Password">
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