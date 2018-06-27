<?php  

include("connections.php");

$first_name = $middle_name = $last_name = $phone_number = $email = $room_type = $number_of_room  = $checkin = $checkout = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $phone_numberErr = $emailErr = $room_typeErr = $number_of_roomErr = $checkinErr  = $checkoutErr = "";
$rate = "";


$max_person = $result = "";

$error_msg = "* All fields are required";

$retrieve_suite = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '1' AND status = 'Available' ");
$result_suite = mysqli_num_rows($retrieve_suite);

$retrieve_lux = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '2' AND status = 'Available' ");
$result_lux = mysqli_num_rows($retrieve_lux);

$retrieve_del = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '3' AND status = 'Available' ");
$result_del = mysqli_num_rows($retrieve_del);



$suite_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 1 ");
$srate = mysqli_fetch_assoc($suite_rate);
$db_srate = $srate["rate"];


$lux_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 2");
$lrate = mysqli_fetch_assoc($lux_rate);
$db_lrate = $lrate["rate"];


$del_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 3 ");
$drate = mysqli_fetch_assoc($del_rate);
$db_drate = $drate["rate"];


if(isset($_POST["btnReserve"])){

	if(empty($_POST["first_name"])){
		$first_nameErr = $error_msg;
	}else{
		$first_name = $_POST["first_name"];
	}

	if(empty($_POST["middle_name"])){
		$middle_nameErr = $error_msg;
	}else{
		$middle_name = $_POST["middle_name"];
	}

	if(empty($_POST["last_name"])){
		$last_nameErr = $error_msg;
	}else{
		$last_name = $_POST["last_name"];
	}

	if(empty($_POST["phone_number"])){
		$phone_numberErr = $error_msg;
	}else{
		$phone_number = $_POST["phone_number"];
	}

	if(empty($_POST["email"])){
		$emailErr = $error_msg;
	}else{
		$email = $_POST["email"];
	}

	if(empty($_POST["room_type"])){
		$room_typeErr = $error_msg;
	}else{
		$room_type = $_POST["room_type"];
	}

	if(empty($_POST["number_of_room"])){
		$number_of_roomErr = $error_msg;
	}else{
		$number_of_room = $_POST["number_of_room"];
	}

	if(empty($_POST["checkin"])){
		$checkinErr = $error_msg;
	}else{
		$checkin = $_POST["checkin"];
	}

	if(empty($_POST["checkout"])){
		$checkoutErr = $error_msg;
	}else{
		$checkout = $_POST["checkout"];
	}

	if($first_name AND $middle_name AND $last_name AND $phone_number AND $email AND $room_type AND $number_of_room  AND $checkin AND $checkout){

		$pattern = "/^[a-zA-Z ]*$/";
		$error_pattern = "Invalid name: Only letters are allowed";
		if(!preg_match($pattern, $first_name)){
			$first_nameErr = $error_pattern;
		}else{
			if(!preg_match($pattern, $middle_name)){
				$middle_nameErr = $error_pattern;
			}else{
				if(!preg_match($pattern, $last_name)){
					$last_nameErr = $error_pattern;
				}else{
					$count_first_name_string = strlen($first_name);
					if($count_first_name_string < 2){
						$first_nameErr = "First name should be atleast 2 letters";
					}else{
						$count_middle_name_string = strlen($middle_name);
						if($count_middle_name_string < 2){
							$middle_nameErr = "Middle name should be atleast 2 letters";
						}else{
							$count_last_name_string = strlen($last_name);
							if($count_last_name_string < 2){
								$last_nameErr = "Last name should be atleast 2 letters";
							}else{
								$count_phone_number_string = strlen($phone_number);
								if($count_phone_number_string < 11){
									$phone_numberErr = "Phone number must be 11 characters";
								}else{
									if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
									$emailErr = "Invalid email format";
									}else{
										if($number_of_room > $result_suite){
											$number_of_roomErr = "Sorry, there is only " . $result_suite . " room available in ". $room_type . " room";
										}else{
											if($number_of_room > $result_lux){
												$number_of_roomErr = "Sorry, there is only " . $result_lux. " room available in ". $room_type . " room";
											}else{
												if($number_of_room > $result_del){
													$number_of_roomErr = "Sorry, there is only " . $result_del . " room available in ". $room_type . " room";
												}else{

													

													//generate code
													function random_code_hrs($length = 5){
														$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
														$shuffled = substr(str_shuffle($str),0, $length);
														return $shuffled;
													}
													$code_hrs = random_code_hrs(8);



													//number of days
													$date_a = new DateTime($checkin);
													$date_b = new DateTime($checkout);

													$interval = date_diff($date_a,$date_b);

													$ddiff = $interval->format('%a');




													//condtions
													if($room_type == "Suite"){
														$rate = $db_srate;
														$nroom_type = 1;
														$total = ($rate * $ddiff) * $number_of_room;
													}elseif($room_type == "Luxury"){
														$rate = $db_lrate;
														$nroom_type = 2;
														$total = ($rate * $ddiff) * $number_of_room;
													}elseif($room_type == "Deluxe"){
														$rate = $db_drate;
														$nroom_type = 3;
														$total = ($rate * $ddiff) * $number_of_room;
													}
													$payment_status = "Not paid";

													$fullname = ucfirst($first_name) . " " . ucfirst($middle_name[0]) . ". " . ucfirst($last_name);

													include 'PHPMailer/PHPMailerAutoload.php';
										            $mailer = new PHPMailer();
										            $mailer->IsSMTP();
										            $mailer->Host = 'smtp.gmail.com:465'; 
										            $mailer->SMTPAuth = TRUE;
										            $mailer->Port = 465;
										            $mailer->mailer="smtp";
										            $mailer->SMTPSecure = 'ssl'; 
										            $mailer->IsHTML(true);
										            $mailer->SMTPOptions = array('ssl' => array(
										                                    'verify_peer' => false, 
										                                    'verify_peer_name' => false, 
										                                    'allow_self_signed' => true)
										                                    );
										            $mailer->Username = 'casepack123@gmail.com';
										            $mailer->Password = 'Casepacc123';
										            $mailer->From = 'admin@noreply.com'; 
										            $mailer->FromName = 'Suite Life Hotel';
										            $mailer->Body =  'Hello '.$fullname.'! The room has been reserved for you. Your check in date is on: '.$checkin . ' until ' . $checkout .'. Room type is: ' .$nroom_type . ' Room rate: ' . $rate . ' Your cancelation code is: ' . $code_hrs;
										            $mailer->Subject = 'Suite Life Hotel';
										            $mailer->AddAddress($email);
										            if(!$mailer->send()) {
										            echo 'Message could not be sent.';
										            echo 'Mailer Error: ' . $mailer->ErrorInfo;
										            } else {
										            echo 'Successfully Sent';
										           
										            } 
										            mysqli_query($connections, "INSERT INTO tbl_hrs(first_name , middle_name , last_name , phone_number , email , room_type , number_of_room , checkin , checkout , code_hrs , rate) 
										            	VALUES('$first_name' , '$middle_name' , '$last_name' , '$phone_number' , '$email' , '$nroom_type' , '$number_of_room' , '$checkin' , '$checkout' , '$code_hrs' , '$rate' )");

													mysqli_query($connections, "INSERT INTO payment (first_name,middle_name,last_name,room_type,room_rate,noroom,noday,checkin,checkout,total,code_hrs,payment_status) 
														VALUES('$first_name','$middle_name','$last_name','$nroom_type','$rate','$number_of_room','$ddiff','$checkin','$checkout','$total','$code_hrs','$payment_status')");

													mysqli_query($connections, "UPDATE room SET status = 'Reserved', checkin = '$checkin', checkout = '$checkout', code_hrs = '$code_hrs' WHERE room_type='$nroom_type' AND status = 'Available' LIMIT $number_of_room");

													

													$getVerify = md5(rand(1,9));

													echo "<script>window.location.href='reservationsuccess?getVerify=$getVerify&&rt=$room_type' ;</script>";

												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
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
							<li class="current"><a href="roomreservation">Book room</a></li>
							<li><a href="cancelreservation">Cancel Reservation</a></li>
						</ul>
					</nav>
				</div>
			</header>

			<div class="logo">
		
			</div>	
	<div class="table_form">
		<br><br>
		<form method="POST" >
			<center>
				<table border="0" width="100%">
					<tr>
						<td colspan="2">
							<h2>Personal Information</h2>
						</td>
					</tr>
					<tr>
						<td width="15%">First name: </td>
						<td>
							<input type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>">
							
						</td>
						<td width="20%"><span class="error"><?php echo $first_nameErr; ?></span></td>
					</tr>
					<tr>
						<td width="15%">Middle name: </td>
						<td>
							<input type="text" name="middle_name" placeholder="Middle name" value="<?php echo $middle_name; ?>">
							
						</td>
						<td><span class="error"><?php echo $middle_nameErr; ?></span></td>
					</tr>

					<tr>
						<td width="15%">Last name: </td>
						<td>
							<input type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>">
							
						</td>
						<td><span class="error"><?php echo $last_nameErr; ?></span></td>
					</tr>

					<tr>
						<td width="15%">Phone number: </td>
						<td>
							<input type="text" name="phone_number" placeholder="Phone number" maxlength="11" size="20" onkeypress='return event.charCode>=48 && event.charCode<=57' value="<?php echo $phone_number; ?>"/>
							
						</td>
						<td><span class="error"><?php echo $phone_numberErr; ?></span></td>
					</tr>

					<tr>
						<td width="10%">Email: </td>
						<td>
							<input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
							
						</td>
						<td><span class="error"><?php echo $emailErr; ?></span></td>
					</tr>
					<tr>
						<td colspan="2">
							<h2>Room Information</h2>
						</td>
					</tr>
					<tr>
						<td width="15%">Select room: </td>
						<td>
							
							<select name="room_type" id="room_type" >
								<option name="room_type" value=""></option>

								<option name="room_type" value="Suite" <?php if($room_type=="Suite"){echo "selected";} ?> >Suite</option>
								<option name="room_type" value="Luxury" <?php if($room_type=="Luxury"){echo "selected";} ?>>Luxury</option>
								<option name="room_type" value="Deluxe" <?php if($room_type=="Deluxe"){echo "selected";} ?>>Deluxe</option>
								
							</select>
						</td>
						<td><span class="error" ><?php echo $room_typeErr; ?></span></td>
					</tr>

					<tr>
						<td width="15%">Number of room: </td>
						<td>
							
							<select name="number_of_room" id="number_of_room">
								<option name="number_of_room" value=""></option>
								<option name = "number_of_room" value="1" <?php if($number_of_room=="1"){echo "selected";} ?> >1</option>
								<option name = "number_of_room" value="2" <?php if($number_of_room=="2"){echo "selected";} ?> >2</option>

							</select>
						</td>
						<td><span class="error"><?php echo $number_of_roomErr; ?></span></td>
					</tr>

					<tr>
						<td width="15%">Check in: </td>
						<td>
							<input type="text" name="checkin" id="datepicker" placeholder="Check in"  value="<?php echo $checkin; ?>" readonly />
							
						</td>
						<td><span class="error"><?php echo $checkinErr; ?></span></td>
					</tr>
					<tr>
						<td width="15%">Check out: </td>
						<td>
							<input type="text" name="checkout" id="datepicker2" placeholder="Check out" value="<?php echo $checkout; ?>" readonly />
							
						</td>
						<td><span class="error"><?php echo $checkoutErr; ?></span></td>
					</tr>
					<tr>
						<td colspan="2">
						</td>
					</tr>
					<tr><td></td>
						<td>
							<input type="submit" class="btn-update" name="btnReserve" value="Reserve">
						</td>
					</tr>
				</table>
			</center>
		</form>
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