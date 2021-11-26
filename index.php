  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>registration form</title>
        <style>

        </style>
    </head>
    <body>
        
        <?php 
            //1.check data is co,ming or not
            if(isset($_GET['resgsubmit'])){
                //echo "ok";
                //1.db open 
                $conn = mysqli_connect("localhost","root","",'flipkart_db');
                //always filter the data 
                $name =  mysqli_real_escape_string($conn,$_GET["name"]);
                $uname = mysqli_real_escape_string($conn,$_GET["uname"]);
                $pass =  mysqli_real_escape_string($conn,$_GET["pass"]);
                $cpass = mysqli_real_escape_string($conn,$_GET["cpass"]);
                $Email = mysqli_real_escape_string($conn,$_GET["Email"]);
                $dob =   mysqli_real_escape_string($conn,$_GET["dob"]);
                $agree = mysqli_real_escape_string($conn,$_GET["agree"]);
                
                if( isset($agree) && $agree == 'yes'){
                    echo 'aggree';
                    //check for pass and cpass
                    if($pass == $cpass ){
                        echo 'match';
                        // check the user name is unique or not 
                        $qurey = "SELECT * FROM user_table WHERE username = '$uname' OR email='$Email' ";

                        $result = mysqli_query($conn,$qurey);

                        $count = mysqli_num_rows($result);
                        if( $count > 0 ){
                            //avaliable already exist
                            echo '<script> swal("Choine any ther user name or email ", " Choine any ther user name or email!", "error"); </script>';
                        }else{
                            //avaliable already not  exist

                            //2.build qurey
                            $pass = SHA1($pass);
                            $sql = "INSERT INTO user_table(`name`,`email`,`password`,`username`,`dob`) VALUES('$name','$uname','$pass','$Email','$dob')";
                            
                            //3.exucute the qurey 
                            mysqli_query($conn,$sql);
                            //4.display the result 
                            echo '<script> swal("Good job!", "User Registed succesfully!", "success"); </script>';
                       
                        }

                    }else{
                        //echo "nonno match ";
                        echo '<script> swal("Please enter  same password ", "Same pasword!", "error"); </>';
                    }
                } else{
                    //echo "Not agree";
                    echo '<script> swal("Please accpet t&C!", "Please accpet!", "error"); </script>';
                } 

                mysqli_query($conn,$sql);

                header('Location: '.$_SERVER['PHP_SELF'].'?msg=1');
                //5.db close
                mysqli_close($conn);
            }/* else{
                echo 'no';
            } */
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-50 offset-3">
            <h1 class='text-center mt-5'>Registration Form</h1>
            <div class="mb-3">
                <label for="Name" class="form-label">Name</label>
                <input type="text" name='name'class="form-control" id="Name" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="uname" class="form-label">User Name</label>
                <input type="text" name="uname"class="form-control" id="uname">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" name="pass"class="form-control" id="pass">
            </div>
            <div class="mb-3">
                <label for="cpass" class="form-label"> confirm Password</label>
                <input type="password" name="cpass"class="form-control" id="cpass">
            </div>
            
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="text" name="Email"class="form-control" id="Email">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob"class="form-control" id="dob">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="agree" value = "yes"id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">T&C apply</label>
            </div>
            <input type="submit" name = 'resgsubmit' class="btn btn-primary">
        </form>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
