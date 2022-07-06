<?php
    SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
                        include("sidenav.php")
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2">
                        Book Appointment
                    </h5>
                    <?php
                        
                                $id = $_SESSION['patient'];
                                // print_r($_SESSION);
                                $query = "SELECT *FROM patient WHERE id ='$id'";

                                $res = mysqli_query($connect,$query);

                                $row = mysqli_fetch_array($res);
                                $email = $row['email']                         ;
                                $patient_name = $row['name'];
                                $dobirth = $row['dateofbirth'];
                                $gender = $row['gender'];
                                $phone = $row['phone'];

                                
                                

                        if(isset($_POST['app-submit'])){

                            $spec = $_POST['spec'];
                            $doctor = $_POST['doctor'];
                            $docFees=$_POST['docFees'];
                            $appdate=$_POST['appdate'];
                            $apptime=$_POST['apptime'];
                            $cur_date = date("Y-m-d");
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $cur_time = date("H:i:s");
                            $apptime1 = strtotime($apptime);
                            $appdate1 = strtotime($appdate);
                        
                        $re = mysqli_query($connect,"select * from doctors where name='$doctor' ");
                        $row = mysqli_fetch_array($re);    
                        $doc_id = $row['id'];
                        $doc_email = $row['email'];
                            if (date("Y-m-d",$appdate1)>=$cur_date){
                                if((date("Y-m-d",$appdate1)==$cur_date and date("H:i:s",$apptime1)>$cur_time) or date("Y-m-d",$appdate1)>$cur_date){
                                    $check_query = mysqli_query($connect,"select * from appointment where appdate='$appdate' and doc_id='$doc_id'");
                                    $check_query1 = mysqli_query($connect,"select * from appointment where appdate='$appdate' and patient_id='$id'");
                                    
                                    if(mysqli_num_rows($check_query)==0 && mysqli_num_rows($check_query1)==0){
                                        $query=mysqli_query($connect,"insert into appointment(doc_id,patient_id,patient,dateofbirth,gender,email,phone,doctor,doctor_email,docFees,appdate,apptime,userStatus,doctorStatus,status) values('$doc_id','$id','$patient_name','$dobirth','$gender','$email','$phone','$doctor','$doc_email','$docFees','$appdate','$apptime','1','1','0')");                              
                                        if($query){
                                          echo "<script>alert('Your appointment successfully booked');</script>";
                                        }
                                        else{
                                          echo "<script>alert('Unable to process your request. Please try again!');</script>";
                                        }
                                    }
                                    else if(mysqli_num_rows($check_query) != 0){
                                      echo "<script>alert('We are sorry to inform the doctor is not available in this time or date. Please choose different time or date!');</script>";
                                    }else if(mysqli_num_rows($check_query1) !=0){
                                        echo "<script>alert('You have booked an appointment for this day. Please choose different time or date!');</script>";
                                    }
                                  }else{
                                    echo "<script>alert('Select a time or date in the future!');</script>";
                                }
                            }else{
                                echo "<script>alert('Select a time or date in the future!');</script>";
                            }
                        }
                        if(isset($_GET['cancel'])){
                            $query=mysqli_query($connect,"update appointment set userStatus='0', status='0' where appdate = '".$_GET['appdate']."' and doc_id = '".$_GET['doc_id']."'and patient_id  = '".$_GET['patient_id']."'");
                            if($query)
                            {
                            echo "<script>alert('Your appointment successfully cancelled');</script>";
                            }
                        }
                    ?>
                    <?php
                        function display_specs() {
                            global $connect;
                            $query="select distinct(spec) from doctors";
                            $result=mysqli_query($connect,$query);
                            while($row=mysqli_fetch_array($result))
                            {
                                $spec=$row['spec'];
                                echo '<option data-value="'.$spec.'">'.$spec.'</option>';
                            }
                        }
                        function display_docs()
                        {
                        global $connect;
                        $query = "select * from doctors";
                        $result = mysqli_query($connect,$query);
                            while( $row = mysqli_fetch_array($result) )
                            {
                            $name = $row['name'];
                            $price = $row['docFees'];
                            $spec = $row['spec'];
                            echo '<option value="' .$name. '" data-value="'.$price.'" data-spec="'.$spec.'">Dr. '.$name.'</option>';
                            }
                        }
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 "></div>
                            <div class="col-md-6 jumbotron">
                                <form action="" method="post">

                                    <label for="spec">Specialization</label>
                                    <select name="spec" id="spec" class="form-control">
                                        <option value="" disabled selected>Select Specialization</option>
                                        <?php 
                                        display_specs();
                                        ?>
                                    </select>
                                    
                                    <script>
                                        document.getElementById('spec').onchange = function foo() {
                                            let spec =this.value;   
                                            console.log(spec)
                                            let docs = [...document.getElementById('doctor').options];
                                            
                                            docs.forEach((el, ind, arr)=>{
                                            arr[ind].setAttribute("style","");
                                            if (el.getAttribute("data-spec") != spec ) {
                                                arr[ind].setAttribute("style","display: none");
                                            }
                                            });
                                        };

                                    </script>

                                    <label for="doctor">Doctors</label>
                                    <select name="doctor" id="doctor" class="form-control" required="required">
                                        <option value="" disabled selected>Select Doctor</option>
                                        <?php display_docs(); ?>
                                    </select>

                                    <script>
                                        document.getElementById('doctor').onchange = function updateFees(e) {
                                            var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                                            document.getElementById('docFees').value = selection;
                                        };
                                    </script>
                                      
                                    <label for="consultancyfees">Consultancy Fees</label>
                                    <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly"/>
                                    
                                    <label for="">Appointment Date</label>
                                    <input type="date" name="appdate" id="" class="form-control datepicker" >

                                    <label for="">Appointment Time</label>
                                    <select name="apptime" class="form-control" id="apptime" required="required">
                                        <option value="" disabled selected>Select Time</option>
                                        <option value="08:00:00">8:00 AM</option>
                                        <option value="10:00:00">10:00 AM</option>
                                        
                                        <option value="14:00:00">2:00 PM</option>
                                        <option value="16:00:00">4:00 PM</option>
                                        </select>
                                    
                                    <input type="submit" name="app-submit" id="inputbtn" class="btn btn-info my-3" value="Book Appointment">
                                </form>
                            </div>                            
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>