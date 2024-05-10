 
 <?php
     session_start();
     include "db.php";
     $msg=$_GET["msg"];
     $phone=$_SESSION["phone"];

     $q=$phone_check_query = "SELECT * FROM `users` WHERE phone='$phone'";
     $phone_check_result = mysqli_query($db, $phone_check_query);
 
     if(mysqli_num_rows($phone_check_result) == 1){
       // Phone number already exists
       $q="INSERT INTO `msg`( `phone`, `msg`) VALUES ('$phone','$msg');";
       if($rq=mysqli_query($db,$q));
     }


    

?>