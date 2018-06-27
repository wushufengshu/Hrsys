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
<table border="0" width="80%">
	<tr>
		<td width="20%"><b>Name</b></td>
		<td width="15%"><b>Room type</b></td>
		<td width="10%"><b>Room rate</b></td>
		<td width="10%"><b>Number of room</b></td>
		<td width="10%"><b>Number of days</b></td>
		<td width="10%"><b>Checkin date</b></td>
		<td width="10%"><b>Checkout date</b></td>
		<td width="15%"><b>Total</b></td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>



<?php 
include("../connections.php");

$retreive_payment = mysqli_query($connections, "SELECT * FROM payment ORDER BY id DESC");
while ($retpay = mysqli_fetch_assoc($retreive_payment)) {
	$db_first_name = $retpay["first_name"];
	$db_middle_name = $retpay["middle_name"];
	$db_last_name = $retpay["last_name"];
	$db_room_type = $retpay["room_type"];
	$db_room_rate = $retpay["room_rate"];
	$db_noroom = $retpay["noroom"];
	$db_noday = $retpay["noday"];
	$db_checkin = $retpay["checkin"];
	$db_checkout = $retpay["checkout"];
	$db_total = $retpay["total"];

	$full_name = $db_first_name . " " . $db_middle_name . " " . $db_last_name;

	echo "
	
	<tr>
		<td>$full_name</td>
		<td>$db_room_type</td>
		<td>$db_room_rate</td>
		<td>$db_noroom</td>
		<td>$db_noday</td>
		<td>$db_checkin</td>
		<td>$db_checkin</td>
		<td>$db_total</td>
	</tr>
	<tr>
		<td colspan='8'><hr></td>
	</tr>


	";
}
?>
</table>
</center>