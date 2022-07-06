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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                
                            <?php
                                
                                $id = $_SESSION['doctor'];
                                
                                $query = "SELECT *FROM doctors WHERE id ='$id'";

                                $res = mysqli_query($connect,$query);

                                $row = mysqli_fetch_array($res);  
                                 
                                //print_r($_SESSION);
                            ?>
                                <div class="my-3">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th colspan="2" class="text-center">Details</th>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $row['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Spec</td>
                                            <td><?php echo $row['spec']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Fees</td>
                                            <td><?php echo $row['docFees']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">                            
                                
                                <?php
                                    if(isset($_POST['change'])){
                                        $name=$_POST['name'];
                                        if(empty($name)){

                                        }else{
                                            $query="UPDATE doctors SET name='$name' WHERE email='$email'";
                                            $res = mysqli_query($connect,$query);
                                            if($res){
                                                $_SESSION['doctors']=$email;
                                            }
                                        }
                                    }
                                ?>
                                <form action="" method="post">
                                    <h5 class="text-center my-2">Change Name</h5>
                                    <input type="text" name="name" id="" class="form-control my-2" autocomplete="off">
                                    <input type="submit" name="change" id="" value="Change Name" class="btn btn-success">
                                </form>

                                <?php
                                        if(isset($_POST['update_pass'])){

                                            $old_pass = $_POST['old_pass'];
                                            $new_pass = $_POST['new_pass'];
                                            $con_pass = $_POST['con_pass'];
                                            
                                            $error = array();

                                            $old = mysqli_query($connect,"SELECT *FROM doctors WHERE email='$email'");

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
                                                    $query = "UPDATE doctors SET password='$new_pass' WHERE email='$email'";
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