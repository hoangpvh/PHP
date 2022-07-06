<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-info justify-content-around">
        <h5 class="text-white">Hospital Management System</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
            include("connection.php");
                if(isset($_SESSION['admin'])){
                    $user = $_SESSION['admin'];
                    echo '
                        <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                    ';
                }else if(isset($_SESSION['doctor'])){
                    $id = $_SESSION['doctor'];
                    $query = "select name from doctors where id=$id";
                    $res =mysqli_query($connect,$query);
                    $row = mysqli_fetch_array($res);
                    echo '
                        <li class="nav-item"><a href="#" class="nav-link text-white">Dr. '.$row['name'].'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                    ';
                }else if(isset($_SESSION['patient'])){
                    $id = $_SESSION['patient'];
                    $que = "select name from patient where id=$id";
                    $result =mysqli_query($connect,$que);
                    $row1 = mysqli_fetch_array($result);
                    echo '
                        <li class="nav-item"><a href="#" class="nav-link text-white">'.$row1['name'].'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                    ';
                }else{
                    echo'
                        <li class="nav-item"><a href="index.php" class="nav-link text-white mx-2">HOME</a></li>                
                        <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white mx-2">LOGIN</a></li>
                        <li class="nav-item"><a href="contact.php" class="nav-link text-white mx-2">CONTACT</a></li>
                    ';
                }
            ?>
            

        </ul>
    </nav>

</body>
</html>