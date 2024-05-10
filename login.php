<?php
include "db.php";
session_start();

if(isset($_POST["name"]) && isset($_POST["phone"])){
  
  $name = $_POST["name"];
  $phone = $_POST["phone"];

  // Check if the user exists
  $check_query = "SELECT * FROM `users` WHERE uname='$name' AND phone='$phone'";
  $check_result = mysqli_query($db, $check_query);

  if(mysqli_num_rows($check_result) == 1){
    // User exists, set session and redirect
    $_SESSION["userName"] = $name;
    $_SESSION["phone"] = $phone;
    header("location: index.php");
    exit();
  } else {
    // Check if the phone number already exists
    $phone_check_query = "SELECT * FROM `users` WHERE phone='$phone'";
    $phone_check_result = mysqli_query($db, $phone_check_query);

    if(mysqli_num_rows($phone_check_result) == 1){
      // Phone number already exists
      echo "<script>alert('$phone is already taken by another person')</script>";
    } else {
      // Phone number is unique, proceed with registration
      $insert_query = "INSERT INTO `users`(`uname`, `phone`) VALUES ('$name','$phone')";
      $insert_result = mysqli_query($db, $insert_query);

      if($insert_result){
        // Registration successful, set session and redirect
        $_SESSION["userName"] = $name;
        $_SESSION["phone"] = $phone;
        header("location: index.php");
        exit();
      } else {
        // Error in registration
        echo "<script>alert('Error: ".mysqli_error($db)."')</script>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatRoom</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <h1>ChatRoom</h1>
  <div class="login">
    <h2>Login</h2>
    <p>This ChatRoom is the best example to demonstrate the concept of ChatBot and it's completely for beginners.</p>
    <form action="" method="post">
      <h3>UserName</h3>
      <input type="text" placeholder="Short Name" name="name">
      <h3>Mobile No:</h3>
      <input type="number" placeholder="with country code" min="1111111" max="999999999999999" name="phone">
      <button>Login / Register</button>
    </form>
  </div>
</body>
</html>
