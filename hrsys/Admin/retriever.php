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
?>
<center>
<table border="0" width="100%">
	<tr>
		<td width="15%"><b>Name</b></td>
		<td width="10%"><b>Phone number</b></td>
		<td width="17%"><b>Email</b></td>
		<td width="8%"><b>Room type</b></td>
		<td width="7%"><b>Number of room</b></td>
		<td width="9%"><b>Check in date</b></td>
		<td width="9%"><b>Check out date</b></td>
		<td><center><b>Action</b></center></td>
	</tr>
	<tr>
		<td colspan="9"><hr></td>
	</tr>



<?php 



include("../connections.php"); 

$suite_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 1 ");
$srate = mysqli_fetch_assoc($suite_rate);
$db_srate = $srate["rate"];


$lux_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 2");
$lrate = mysqli_fetch_assoc($lux_rate);
$db_lrate = $lrate["rate"];


$del_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 3 ");
$drate = mysqli_fetch_assoc($del_rate);
$db_drate = $drate["rate"];




$rtvqry = "SELECT * FROM tbl_hrs ORDER BY id_user DESC";
$retrieve_query = mysqli_query($connections, $rtvqry);
while ($rows_ = mysqli_fetch_assoc($retrieve_query)) {
	
	$id_user = $rows_["id_user"];

	$db_first_name = $rows_["first_name"];
	$db_middle_name =$rows_["middle_name"];
	$db_last_name = $rows_["last_name"];
	$db_phone_number = $rows_["phone_number"];
	$db_email = $rows_["email"];
	$db_room_type = $rows_["room_type"];
	$db_number_of_room = $rows_["number_of_room"];
	$db_checkin = $rows_["checkin"];
	$db_checkout = $rows_["checkout"];

	$full_name = ucfirst($db_first_name) . " " . ucfirst($db_middle_name) . " " . ucfirst($db_last_name);
	if($db_room_type == "1"){
		$rate = $db_srate;
		$db_room_type = 'Suite';
	}elseif($db_room_type == "2"){
		
		$rate = $db_lrate;
		$db_room_type = 'Luxury';
	}elseif($db_room_type == "3"){
		$rate = $db_drate;
		$db_room_type = 'Deluxe';
	}

	$jScript = md5(rand(1,9));
	$newScript = md5(rand(1,9));
	$getUpdate = md5(rand(1,9));
	$getDelete = md5(rand(1,9));

	echo "

	<tr>
		<td>$full_name</td>
		<td>$db_phone_number</td>
		<td>$db_email</td>
		<td>$db_room_type</td>
		<td>$db_number_of_room</td>
		<td>$db_checkin</td>
		<td>$db_checkout</td>
		<td>
			<center>
				<a href=' ?jScript=$jScript&&newScript=$newScript&&getUpdate=$getUpdate&&id_user=$id_user ' class='btn-update'>Update</a>
				&nbsp;
				<a href=' ?jScript=$jScript&&newScript=$newScript&&getDelete=$getDelete&&id_user=$id_user' class='btn-delete'>Cancel</a>
			<br>
			</center>
		</td>
	</tr>";
	echo "
	
	<tr>
		<td colspan='8'><hr></td>
	</tr>
	";
}


?>
</table>
</center>	