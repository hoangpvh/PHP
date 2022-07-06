<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment His</title>
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
    
    <div class="col-md-10 my-2">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                <th scope="col">Patient</th>
                <th scope="col">Doctor</th>
                <th scope="col">Service</th>
                <th scope="col">Fees</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                <th scope="col">Prescribe</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                    
                    $query = "select * from appointment order by appdate desc";
                    $result = mysqli_query($connect,$query);

                    if(isset($_GET['cancel'])){
                        $query=mysqli_query($connect,"update appointment set doctorStatus='0', status='0' where appdate = '".$_GET['appdate']."' and doc_id = '".$_GET['doc_id']."'and patient_id  = '".$_GET['patient_id']."'");
                        if($query)
                        {
                            echo "<script>alert('Your appointment successfully cancelled');</script>";
                        }

                    }
                    while ($row = mysqli_fetch_array($result)){                     
                
                ?>
                <?php
                    $doc_id=$row['doc_id'];
                    $q=mysqli_query($connect,"select *from doctors where id=$doc_id");
                    $row1 = mysqli_fetch_array($q);
                ?>
                    <tr>
                        <td><?php echo $row['patient'];?></td>
                        <td><?php echo $row['doctor'];?></td>
                        <td><?php echo "Khám" .$row1['spec'];?></td>
                        <td><?php echo $row['docFees']?></td>
                        <td><?php echo $row['appdate'];?></td>
                        <td><?php echo $row['apptime'];?></td>
                        <td>
                    <?php 
                   
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                    {
                      echo "Active";
                    }
                    if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
                    {
                      echo "Cancelled by Patient";
                    }

                    if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
                    {
                      echo "Cancelled by Admin";
                    }                
                        ?>
                        
                      </td>

                     <td>
                        <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)&&($row['status'] == 0))  
                        { ?>

													
	                        <a href="appointment.php?doc_id=<?php echo $row['doc_id']?>&appdate=<?php echo $row['appdate']?>&patient_id=<?php echo $row['patient_id']?>&cancel=update" 
                              onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button></a>
	                        <?php } if(($row['userStatus']==0) || ($row['doctorStatus']==0)) {
                                  echo "Cancelled";
                                } if(($row['userStatus']==1) && ($row['doctorStatus']==1)&&($row['status'] == 1)) {
                                  echo "Finished";
                                }
                                ?>
                        <?php
                          
                        ?>
                        </td>
                        <td>

                        <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1) &&($row['status'] == 0))  
                        {                      
                            echo "-";
                        } if(($row['userStatus']==1) && ($row['doctorStatus']==1)&&($row['status'] == 1)){ ?>
                            <a href="view.php?doc_id=<?php echo $row['doc_id']?>&appdate=<?php echo $row['appdate']?>&patient_id=<?php echo $row['patient_id']?>"><button class="btn btn-success">View</button></a>
                        <?php }?>
                            
                        
                        
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>