<?php
    include("../include/connection.php");
    $query = "SELECT * FROM doctors WHERE status='Pendding' ORDER BY date_reg ASC";
    $res = mysqli_query($connect,$query);

    $output ="";

    $output ="
        <table class='table table-bordered'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Dateofbirth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Spec</th>
                <th>Date Registered</th>
                <th>Action</th>                
            </tr>
    ";
    if(mysqli_num_rows($res) < 1){
        $output .="
            <tr>
                <td colspan='10' class='text-center'>No job Request Yet.</td>
            </tr>
        ";
    }

    while ($row = mysqli_fetch_array($res)){
        $output .="
            <tr>
                <td>".$row['id']."</td>                
                <td>".$row['name']."</td>
                <td>".$row['dateofbirth']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['address']."</td>
                <td>".$row['spec']."</td>
                <td>".$row['date_reg']."</td>
                <td>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <buton id='".$row['id']."' class='btn btn-success approve'>Approve</buton>
                            </div>
                            <div class='col-md-6'>
                                <buton id='".$row['id']."' class='btn btn-danger reject'>Reject</buton>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        ";
    }
    $output .="
        </tr>
        </table>
    ";
    echo $output;
?>