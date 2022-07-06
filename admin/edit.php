<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
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
                <div class="col-md-10">
                    <h5 class="text-center">Edit Doctor</h5>
                    <?php
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];

                            $query = "SELECT *FROM doctors WHERE id='$id'";
                            $res = mysqli_query($connect,$query);

                            $row = mysqli_fetch_array($res);
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-center">Doctor Details</h5>
                            
                            <h5 class="my-3">Name : <?php echo $row['name'] ?></h5>
                            
                            <h5 class="my-3">Email : <?php echo $row['email'] ?></h5>
                            <h5 class="my-3">Spec : <?php echo $row['spec'] ?></h5>
                            
                            <h5 class="my-3">docFees : $<?php echo $row['docFees'] ?></h5>
                            
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">Update docFees</h5>
                            <?php
                                if(isset($_POST['update'])){
                                    $docFees = $_POST['docFees'];

                                    $query = "UPDATE doctors SET docFees='$docFees' WHERE id='$id'";

                                    mysqli_query($connect,$query);
                                }
                            ?>
                            <form action="" method="post">
                                <label for="">Enter Doctor's docFees</label>
                                <input type="number" name="docFees" id="" class="form-control" autocomplete="off" placeholder="Enter Doctor's docFees" value="<?php echo $row['docFees']?>"> 
                                <input type="submit" name="update" id="" class="btn btn-info my-3" value="Update docFees">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>