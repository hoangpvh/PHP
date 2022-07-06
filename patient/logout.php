<?php
    SESSION_START();

    if(isset($_SESSION['patient'])){
        unset($_SESSION['patient']);
        
        header("Location:../index.php");
    }
?>