<?php
session_start();
include 'dbh.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT email FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$emailcheck = mysqli_num_rows($result);

$errortag = "";

if(empty($email) || empty($username) || empty($password)){
  $errortag = $errortag."register,";
}
if ($emailcheck > 0) {
  $errortag = $errortag."emailtaken,";
}
if(strlen($username)<3||strlen($password)<3||strlen($username)>14||strlen($password)>14){
  $errortag = $errortag."length,";
}

if($errortag !== ""){
  header("Location: ../home/index.php?error=".$errortag);
  echo "test";
  exit();
}

//====== encryption ==============
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO user (email, username, password)
VALUES ('$email', '$username', '$hash')";

$result = mysqli_query($conn, $sql);

//Auto Login
$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['id'] = $row['id'];

header("Location: ../home/index.php");


 ?>
