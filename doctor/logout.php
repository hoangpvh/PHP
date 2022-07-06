<?php
    SESSION_START();

    if(isset($_SESSION['doctor'])){
        unset($_SESSION['doctor']);
        
        header("Location:../index.php");
    }
?>