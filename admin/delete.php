<?php
    include("../include/connection.php");
    
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }

    $sql = "DELETE FROM doctors WHERE id=$id";
    $qr = mysqli_query($connect,$sql);
    header("Location:doctor.php");
?>