<?php 
include("connections.php");

$code_hrs = $db_code_hrs = "";
$code_hrsErr = "";
$first_name = $middle_name = $last_name =  $phone_number = $email = $room_type = $number_of_room = $checkin = $checkout = "";
$in_first_name = $in_middle_name = $in_last_name =  $in_phone_number = $in_email = $in_room_type = $in_number_of_room = $in_checkin = $in_checkout = $cancel_code="";

if(isset($_POST["btnSubmit"])){
	if(empty($_POST["code_hrs"])){
		$code_hrsErr = "Please enter cancelation code";
	}else{
		$code_hrs = $_POST["code_hrs"];
	}

	if($code_hrs){

		$check_code_hrs = mysqli_query($connections, "SELECT * FROM tbl_hrs WHERE code_hrs = '$code_hrs' ");
		$check_row = mysqli_num_rows($check_code_hrs);
		if($check_row > 0){
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
			$db_code_hrs = $fetch["code_hrs"];




		}
		
	}

}


if(isset($_POST["btnDelete"])){
	if(empty($_POST["in_first_name"])){
		$code_hrsErr = "Please enter cancelation code";
	}else{
		$in_first_name= $_POST["in_first_name"];
	}
	
	$in_middle_name = $_POST["in_middle_name"];
	$in_last_name = $_POST["in_last_name"];
	$in_phone_number = $_POST["in_phone_number"];
	$in_email = $_POST["in_email"];
	$in_room_type = $_POST["in_room_type"];
	$in_number_of_room = $_POST["in_number_of_room"];
	$in_checkin = $_POST["in_checkin"];
	$in_checkout = $_POST["in_checkout"];
	$in_code_hrs = $_POST["cancel_code"];

	$name = $in_first_name . " " . $in_middle_name . " " . $in_last_name;

	if($in_first_name AND $in_middle_name AND $in_last_name AND $in_phone_number AND $in_email AND $in_room_type AND $in_number_of_room AND $in_checkin AND $in_checkout){

		mysqli_query($connections, "DELETE FROM tbl_hrs WHERE code_hrs ='$in_code_hrs' ");
		mysqli_query($connections, "DELETE FROM payment WHERE code_hrs ='$in_code_hrs' ");

		echo "<script>window.location.href=' ?notify=$name has been removed';</script>";

		

		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name=description"" content="Affordable and high class hotel">
	<meta name="keywords" content="Affordable rooms, etc">
	<meta name="author" content="Khamaka Brekker">

	<title>Suite Life</title>
	<link rel="icon" type="image/png" sizes="16x16" href="resources/ico/favicon-16x16.png">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="resources/fonts/stylesheet.css">
	<script type="text/javascript" src="js/script.js"></script>

</head>
<body>
	<div class="wrap">
	<div class="maincontainer">
		<div class="main">
			<header>
				<div class="container">
					<div id="branding">
						<h1><span class="highlight">Suite Life Hotel</span></h1>
					</div>
					<nav>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index#rooms">Rooms and Rates</a></li>
							<li><a href="index#about">About</a></li>
							<li><a href="index#services">Services</a></li>
							<li><a href="roomreservation">Book room</a></li>
							<li><a href="cancelreservation">Cancel Reservation</a></li>
						</ul>
					</nav>
				</div>
			</header>
		
		<div class="logo">
		
			</div>	
	<div class="wrapperlogo">
			<br><br><br>
			<form method="POST">
				<center>
					<table border="0" width="80%">
					<tr>
						<td width="25%">
							Cancelation code: 
						</td>
						<td width="50%">
							<input type="text" name="code_hrs" value="" placeholder="Enter cancelation code here">
						</td>
						<td>
							<?php echo $code_hrsErr; ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td> 
							<input type="submit" name="btnSubmit" value="Submit" class="btn-update" onclick="">
						</td>
					</tr>
					
				</table>
				</center>
			</form>	
			<div id="show">
			<center>
			<form method="POST">

				<table border="0" width="80%">
					
					<?php
					
					 if($room_type == 1){
						$room_type = 'Suite';
					}elseif($room_type == 2){
						$room_type = 'Luxury';
					}elseif($room_type== 3){
						$room_type = 'Deluxe';
					}
					echo "
					<tr>
						<td width='18%'></td>
						<td width='45%'>
							<h4>You are about to cancel this reservation by: <font color='red'>
						</td>
					</tr>
					
					<tr>
						<td>First name: </td>
						<td>
							<input type='text' name='in_first_name' value='$first_name' readonly/>
						</td>
					</tr>
					<tr>
						<td>Middle name: </td>
						<td>
							<input type='text' name='in_middle_name' value='$middle_name' readonly/>
						</td>
					</tr>
					<tr>
						<td>Last name: </td>
						<td>
							<input type='text' name='in_last_name' value='$last_name' readonly/>
						</td>
					</tr>
					<tr>
						<td>Contact number</td>
						<td>
							<input type='text' name='in_phone_number' value='$phone_number' readonly/>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input type='text' name='in_email' value='$email' readonly/
						</td>
					</tr>
					<tr>
						<td>Room type</td>
						<td>
							<input type='text' name='in_room_type' value='$room_type' readonly/>
						</td>
					</tr>
					<tr>
						<td>Number of room</td>
						<td>
							<input type='text' name='in_number_of_room' value='$number_of_room' readonly/>
						</td>
					</tr>
					<tr>
						<td>Check in date</td>
						<td>
							<input type='text' name='in_checkin' value='$checkin' readonly/>
						</td>
					</tr>
					<tr>
						<td>Check out date</td>
						<td>
							<input type='text' name='in_checkout' value='$checkout' readonly/>
						</td>
					</tr>
					<tr>
					<td></td>
						<td>
							<input type='hidden' name='cancel_code' value='$db_code_hrs' important/>
						</td>
					</tr>
					<tr>
						<td>Action</td>
						<td>
							<input type= 'submit' name='btnDelete' value='Confirm cancel' class='btn-primary'> &nbsp;&nbsp;<a href='?' class='btn-delete'>Cancel</a>
						</td>
					</tr>
					";
					?>
						
					</font></h4>
				</table><br>
					
				
			</form>
			</center>
			
			</div>
	</div>


		</div>
	</div>
</div>
	
	
<link rel="stylesheet" href="css/foundation-datepicker.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/foundation-datepicker.js"></script>
<script>
$('#datepicker').fdatepicker({
	format: 'yyyy-mm-dd'
});

$('#datepicker2').fdatepicker({
	format: 'yyyy-mm-dd'
});
</script>


</body>
</html>