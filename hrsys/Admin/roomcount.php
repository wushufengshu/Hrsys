<?php 

session_start();
include("../connections.php");

if(isset($_SESSION["email"])){
    $email =$_SESSION["email"];
    $auth = mysqli_query($connections, "SELECT * FROM adduser WHERE email = '$email' ");
    $fetch = mysqli_fetch_assoc($auth);
    $email = $fetch["email"];
    $name = $fetch["name"];
    $username = $fetch["username"];
    $account_type = $fetch["account_type"];
    
    if($account_type != 1){
        echo "<script>window.location.href='../Forbidden';</script> ";
    }
}else{
    echo "<script>window.location.href='login';</script> ";
}

$retrieve_suite = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '1' AND status = 'Available' ");
$result_suite = mysqli_num_rows($retrieve_suite);
echo $result_suite . "<br>";


$retrieve_lux = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '2' AND status = 'Available' ");
$result_lux = mysqli_num_rows($retrieve_lux);
echo $result_lux;


$retrieve_del = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '3' AND status = 'Available' ");
$result_del = mysqli_num_rows($retrieve_del);
echo $result_del;


?>