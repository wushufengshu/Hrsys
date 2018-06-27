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
		<td colspan="5"><hr></td>
	</tr>
	<tr>
		<td><b>Room type</b></td>
		<td><b>Room number</b></td>
		<td><b>Status</b></td>
		<td><b>Check in date</b></td>
		<td><b>Check out date</b></td>
	</tr>
	<tr>
		<td colspan="5"><hr></td>
	</tr>
<?php include("../connections.php");

$checkout_str = "";

date_default_timezone_set("Asia/Manila");
$date_now = date("Y-m-d");
$date_now_str = strtotime($date_now);
$time_now = date("h:i a");


$retrieve_reserved = mysqli_query($connections, "SELECT * FROM room WHERE status='Reserved' OR status='Occupied' ");
while ($row_room = mysqli_fetch_assoc($retrieve_reserved)) {
	$id_room = $row_room["id"];

	$room_type = $row_room["room_type"];
	$room_number = $row_room["room_number"];
	$status = $row_room["status"];
	$checkin = $row_room["checkin"];
	$checkout = $row_room["checkout"];

	$checkout_str = strtotime($row_room["checkout"]);
	
	

	if($room_type == "1"){
		$room_type_string = "Suite";
	}elseif($room_type == "2"){
		$room_type_string = "Luxury";
	}elseif($room_type == "3"){
		$room_type_string = "Deluxe";
	}
	echo "
	<tr>
	<td>$room_type_string</td>
	<td>$room_number</td>
	<td>$status</td>
	<td>$checkin</td>	
	<td>$checkout</td>
	</tr>
	<tr>
		<td colspan='5'><hr></td>
	</tr>

	";

	$notify = "Room available at $time_now."; 
	$paid = "Paid";
	if($date_now >$checkout){
		mysqli_query($connections, "UPDATE room SET status='Available', checkin='', checkout='' WHERE (status='Reserved' OR status='Occupied') AND CURRENT_DATE > checkout ");
		mysqli_query($connections, "UPDATE payment SET payment_status = 'Paid' WHERE checkout > CURRENT_DATE ");
		mysqli_query($connections, "INSERT INTO notification(notification) VALUES('$notify')");
		

	}else{
		if($date_now >= $checkin OR $date_now <= $checkout){
			#mysqli_query($connections, "UPDATE room SET status='Occupied' WHERE status='Reserved', CURRENT_DATE >= $checkin AND CURRENT_DATE <= $checkout");
			mysqli_query($connections, "UPDATE room SET status='Occupied' WHERE CURRENT_DATE BETWEEN checkin AND checkout");

		}	
	}
	/*if($date_now > $checkin AND $date_now < $checkout){
		mysqli_query($connections, "UPDATE room SET status='Occupied' WHERE status = 'Reserved' CURRENT_DATE >= $checkin AND CURRENT_DATE <= $checkout");
	}*/
		

}	

	


?>
</tr>
</table>
</center>