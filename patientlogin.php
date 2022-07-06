<?php
    SESSION_START();
    include("include/connection.php");

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $error = array();

        if(empty($email)){
            echo "<script>alert('Enter Email')</script>";
        }else if(empty($pass)){
            echo "<script>alert('Enter Password')</script>";
        }
        if(count($error)==0){
            
            $query = "SELECT * FROM patient WHERE email='$email' AND password='$pass'";
            $res = mysqli_query($connect,$query);
            $row = mysqli_fetch_array($res);
            if(mysqli_num_rows($res) == 1){
                header("Location: patient/index.php");
                $_SESSION['patient'] = $row['id'];
                exit();
            }else{
                echo "<script>alert('Invailed Account')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<head>
    <title>Patient Login</title>
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
                    <h5 class="text-center my-3">Patient Login</h5>
                    <form method="post">

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
                        <p>I don't have an account <a href="account.php">Click here</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>