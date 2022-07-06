<?php
    include("../include/connection.php");

    $id = $_POST['id'];
    $query = "UPDATE doctors SET status='Approve' WHERE id='$id'";
    mysqli_query($connect,$query);
?>