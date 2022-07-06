<?php
    SESSION_START();

    if(isset($_SESSION['admin'])){
        unset($_SESSION['admin']);
        
        header("Location:../index.php");
    }
?>