<?php  
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

$id_user = $_GET["id_user"];

$query_name = mysqli_query($connections, "SELECT * FROM tbl_hrs WHERE id_user='$id_user' ");

$row_ = mysqli_fetch_assoc($query_name);

$db_first_name = $row_["first_name"];
$db_middle_name = $row_["middle_name"];
$db_last_name = $row_["last_name"];
$db_phone_number = $row_["phone_number"];
$db_email = $row_["email"];
$db_room_type = $row_["room_type"];
$db_number_of_room = $row_["number_of_room"];
$db_checkin = $row_["checkin"];
$db_checkout = $row_["checkout"];
$db_code_hrs = $row_["code_hrs"];

$full_name = ucfirst($db_first_name) . " " . ucfirst($db_middle_name) . " " . ucfirst($db_last_name);

if(isset($_POST["btnDelete"])){
	mysqli_query($connections, "DELETE FROM tbl_hrs WHERE id_user='$id_user' ");
	mysqli_query($connections, "DELETE FROM payment WHERE code_hrs = '$db_code_hrs' ");
	echo "<script>window.location.href='roomreservations?notify=$full_name has been removed';</script>";
}


?>
<center>
	<form method="POST">
		<h4>You are about to cancel this reservation by: <font color="red"><?php echo $full_name; ?></font></h4>
		<input type="submit" name="btnDelete" value="Confirm" class="btn-primary"> &nbsp;&nbsp;<a href="?" class="btn-delete">Cancel</a>
	</form>
</center>
<hr>
<br><br>