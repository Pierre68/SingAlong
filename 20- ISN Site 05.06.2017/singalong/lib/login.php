<?php
session_start();
include 'dbh.php';

$email = $_POST['email'];
$password = $_POST['password'];
//========hashing (decryption) =======================
$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$hased = $row['password'];
$verify = password_verify($password,$hased);
//====================================================

if(!$verify){
  header("Location: ../home/index.php?error=login");
  exit();
}else{
  $_SESSION['id'] = $row['id'];
  header("Location: ../home/index.php");
}

 ?>
