<?php
  require "./conn.php";
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $fullname = $_POST['full-name'];
    $length = strlen($fullname);
    if($length < 5){ 
        header("Location: ./register.php");
    } else if($length > 25) {
        header("Location: ./register.php");
    }

    $usermame = $_POST['username'];
    $length = strlen($username);
    if($length < 5){ 
        header("Location: ./register.php");
    } else if($length > 25) {
        header("Location: ./register.php");
    }
    $email = $_POST['email'];
    $length = strlen($email);
    if($length < 5){ 
        header("Location: ./register.php");
    } else if($length > 25) {
        header("Location: ./register.php");
    }
    $age = $_POST['age'];
    $length = strlen($age);
    if($length < 5){ 
        header("Location: ./register.php");
    } else if($length > 25) {
        header("Location: ./register.php");
    }
    $password = $_POST['password'];
    $length = strlen($password);
    if($length < 5){ 
        header("Location: ./register.php");
    } else if($length > 25) {
        header("Location: ./register.php");
    }

    
  }
?>