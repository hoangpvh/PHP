<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");

        $ad = $_SESSION['admin'];
        $query = "SELECT *FROM admin WHERE username='$ad'";
        $res=mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($res)){
            $username = $row['username'];
            
        }

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
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <h4 class="text-center my-2">Admin Profile</h4>
                                <br>
                                <?php
                                    if(isset($_POST['update'])){
                                        $profile = $_FILES['profile']['name'];
                                        if(empty($profile)){

                                        }else{
                                            $query = "UPDATE admin SET profile = '$profile' WHERE username='$ad'";
                                            $result = mysqli_query($connect,$query);
                                            if($result){
                                                move_uploaded_file($_FILES['profile']['tmp_name'],"img/$profile");
                                            }
                                        }
                                    }
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php
                                        echo "<img src='img/$profiles' class='col-md-12' style='height:300px;'>";
                                    ?>
                                    
                                    <div class="form-group">
                                        
                                        <input type="file" name="profile" id="" class="form-control my-2">
                                    </div>
                                    <input type="submit" name="update" id="" value="UPDATE" class="btn btn-success">
                                </form>
                            </div> -->
                            <div class="col-md-6">
                                <?php
                                    if(isset($_POST['change'])){
                                        $uname=$_POST['uname'];
                                        if(empty($uname)){

                                        }else{
                                            $query="UPDATE admin SET username='$username' WHERE username='$ad'";
                                            $res = mysqli_query($connect,$query);
                                            if($res){
                                                $_SESSION['admin']=$uname;
                                            }
                                        }
                                    }
                                ?>
                                <form action="" method="post">
                                    <h5 class="text-center my-2">Change Username</h5>
                                    <input type="text" name="uname" id="" class="form-control my-2" autocomplete="off">
                                    <input type="submit" name="change" id="" value="Change" class="btn btn-success">
                                </form>
                                    <?php
                                        if(isset($_POST['update_pass'])){

                                            $old_pass = $_POST['old_pass'];
                                            $new_pass = $_POST['new_pass'];
                                            $con_pass = $_POST['con_pass'];
                                            
                                            $error = array();

                                            $old = mysqli_query($connect,"SELECT *FROM admin WHERE username='$ad'");

                                            $row = mysqli_fetch_array($old);
                                            $pass = $row['password'];

                                            if(empty($old_pass)){
                                                $error['pass'] = "Enter old password";
                                            }else if(empty($new_pass)){
                                                $error['pass'] = "Enter new password";
                                            }else if(empty($old_pass)){
                                                $error['pass'] = "Confirm password";
                                            }else if($old_pass != $pass){
                                                $error['pass'] = "Invaild old password";
                                            }else if($new_pass != $con_pass){
                                                $error['pass'] = "Both password does not match";
                                            }
                                                if(count($error) == 0){
                                                    $query = "UPDATE admin SET password='$new_pass' WHERE username='$ad'";
                                                    mysqli_query($connect,$query);
                                                }

                                                
                                            
                                        }

                                        if(isset($error['pass'])){
                                            $e = $error['pass'];
                                            $show = "<p class='text-center alert alert-danger'>$e</p>";
                                        }else{
                                            $show = "";
                                        }
                                    ?>
                                <form action="" method="post">
                                    <h5 class="text-center my-4">Change Password</h5>
                                    <div>
                                        <?php
                                            echo $show;
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Old Password</label>
                                        <input type="password" name="old_pass" id="" class="form-control my-2" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" name="new_pass" id="" class="form-control my-2" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="con_pass" id="" class="form-control my-2" autocomplete="off">
                                    </div>
                                    <input type="submit" name="update_pass" id="" value="Update Pass" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>