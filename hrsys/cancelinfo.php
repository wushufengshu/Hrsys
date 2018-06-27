<?php

$code_hrs = $_GET["code_hrs"];

$check_code_hrs = mysqli_query($connections, "SELECT * FROM tbl_hrs WHERE code_hrs = '$code_hrs' ");
$check_row = mysqli_num_rows($check_code_hrs);
$fetch = mysqli_fetch_assoc($check_code_hrs);
$first_name = $fetch["first_name"];
$middle_name = $fetch["middle_name"];
$last_name = $fetch["last_name"];
$phone_number = $fetch["phone_number"];
$email = $fetch["email"];
$room_type = $fetch["room_type"];
$number_of_room = $fetch["number_of_room"];
$checkin = $fetch["checkin"];
$checkout = $fetch["checkout"];

$name = $first_name . " " . $middle_name . " " . $last_name;
if($room_type == 1){
	$room_type = "Suite";
}elseif($room_type == 2){
	$room_type = "Luxury";
}elseif($room_type== 3){
	$room_type = "Deluxe";
}

echo "
<tr>
	<td width='25%'>Name: </td>
	<td>$name</td>
</tr>
<tr>
	<td>Contact number</td>
	<td>$phone_number</td>
</tr>
<tr>
	<td>Email</td>
	<td>$email</td>
</tr>
<tr>
	<td>Room type</td>
	<td>$room_type</td>
</tr>
<tr>
	<td>Number of room</td>
	<td>$number_of_room</td>
</tr>
<tr>
	<td>Check in date</td>
	<td>$checkin</td>
</tr>
<tr>
	<td>Check out date</td>
	<td>$checkout</td>
</tr>





";

?>