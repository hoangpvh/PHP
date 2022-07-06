
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Report</title>
</head>
<body>
    
    <?php
        include("include/header.php");
        include("include/connection.php");
        
        if(isset($_POST['send'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];
            
            if(empty($name) || empty($email) || empty($phone) || empty($message)){
                
            }else{
                
                $query="insert into contact(name,email,phone,message,date_send) values('$name','$email','$phone','$message',NOW());";
                $res = mysqli_query($connect,$query);
                if($res){
                    echo "<script>alert('You have sent )</script>";
                }
            }
        }
    ?>


    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron br-info my-5">
                <h5 class="text-center my-2">Send Contact Us</h5>
                <form action="" method="post">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" autocomplete="off" class="form-control" placeholder="Enter Name">
                    
                    <label for="">Email</label>
                    <input type="text" name="email" id="" autocomplete="off" class="form-control" placeholder="Enter Email">
                    
                    <label for="">Phone</label>
                    <input type="text" name="phone" id="" autocomplete="off" class="form-control" placeholder="Enter Phone">
                    
                    <label for="">Message</label>
                    <input type="text" name="message" id="" autocomplete="off" class="form-control" placeholder="Enter Message">
                    
                    <input type="submit" name="send" id="" value="Send Message" class="btn btn-success my-2">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>

