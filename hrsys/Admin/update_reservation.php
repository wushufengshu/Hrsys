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

$get_record = mysqli_query($connections, "SELECT * FROM tbl_hrs WHERE id_user = '$id_user' ");
while($get = mysqli_fetch_assoc($get_record)){

	$db_first_name = $get["first_name"];
	$db_middle_name = $get["middle_name"];
	$db_last_name = $get["last_name"];

	$db_phone_number = $get["phone_number"];
	$db_email = $get["email"];

	$db_room_type = $get["room_type"];
	$db_number_of_room = $get["number_of_room"];
	$db_checkin = $get["checkin"];
	$db_checkout =$get["checkout"];
	$db_code_hrs = $get["code_hrs"];
}
$new_first_name = $new_middle_name = $new_last_name = $new_phone_number = $new_email = $new_room_type= $new_number_of_room = $new_checkin = $new_checkout = "";
$new_first_nameErr = $new_middle_nameErr = $new_last_nameErr = $new_phone_numberErr = $new_emailErr = $new_room_typeErr = $new_number_of_roomErr= $new_checkinErr = $new_checkoutErr = "";


$suite_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 1 ");
$srate = mysqli_fetch_assoc($suite_rate);
$db_srate = $srate["rate"];


$lux_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 2");
$lrate = mysqli_fetch_assoc($lux_rate);
$db_lrate = $lrate["rate"];


$del_rate = mysqli_query($connections, "SELECT * FROM room_info WHERE id = 3 ");
$drate = mysqli_fetch_assoc($del_rate);
$db_drate = $drate["rate"];




$error_msg = "This field is required";

if(isset($_POST["btnUpdate"])){

	if(empty($_POST["new_first_name"])){
		$new_first_nameErr = $error_msg;
	}else{
		$new_first_name = $_POST["new_first_name"];
		$db_first_name = $new_first_name;
	}

	if(empty($_POST["new_middle_name"])){
		$new_middle_nameErr = $error_msg;
	}else{
		$new_middle_name = $_POST["new_middle_name"];
		$db_middle_name = $new_middle_name;
	}

	if(empty($_POST["new_last_name"])){
		$new_last_nameErr = $error_msg;
	}else{
		$new_last_name = $_POST["new_last_name"];
		$db_last_name = $new_last_name;
	}

	if(empty($_POST["new_phone_number"])){
		$new_phone_numberErr = $error_msg;
	}else{
		$new_phone_number = $_POST["new_phone_number"];
		$db_phone_number = $new_phone_number;
	}

	if(empty($_POST["new_email"])){
		$new_emailErr = $error_msg;
	}else{
		$new_email = $_POST["new_email"];
		$db_email = $new_email;
	}

	if(empty($_POST["new_room_type"])){
		$new_room_typeErr = $error_msg;
	}else{
		$new_room_type = $_POST["new_room_type"];
		$db_room_type = $new_room_type;
	}

	if(empty($_POST["new_number_of_room"])){
		$new_number_of_roomErr = $error_msg;
	}else{
		$new_number_of_room = $_POST["new_number_of_room"];
		$db_number_of_room = $new_number_of_room;
	}

	if(empty($_POST["new_checkin"])){
		$new_checkinErr = $error_msg;
	}else{
		$new_checkin = $_POST["new_checkin"];
		$db_checkin = $new_checkin;
	}

	if(empty($_POST["new_checkout"])){
		$new_checkoutErr = $error_msg;
	}else{
		$new_checkout = $_POST["new_checkout"];
		$db_checkout = $new_checkout;
	}
	$incode_hrs = $_POST["code_hrs"];

	if($new_first_name and $new_middle_name and $new_last_name and $new_phone_number and $new_email and $new_room_type and $new_number_of_room and $new_checkin and $new_checkout){
		
		$pattern = "/^[a-zA-Z ]*$/";
		$error_pattern = "Invalid name: Only letters are allowed";

		if(!preg_match("/^[a-zA-Z ]*$/", $new_first_name)){
			$new_first_nameErr = $error_pattern;
		}else{
			if(!preg_match("/^[a-zA-Z ]*$/", $new_middle_name)){
				$new_middle_nameErr = $error_pattern;
			}else{
				if(!preg_match("/^[a-zA-Z ]*$/", $new_last_name)){
					$new_last_nameErr = $error_pattern;
				}else{
					$count_first_name = strlen($new_first_name);
					if($count_first_name < 2 ){
						$new_first_nameErr = "Name should be atleast 2 letters";
					}else{
						$count_middle_name = strlen($new_middle_name);
						if($count_middle_name < 2 ){
							$new_middle_nameErr = $new_first_nameErr;
						}else{
							$count_last_name = strlen($new_last_name);
							if($count_last_name < 2){
								$new_last_nameErr = $new_first_nameErr;
							}else{
								$count_phone_number = strlen($new_phone_number);
								if($count_phone_number < 11){
									$new_phone_numberErr = "Phone number must be 11 numbers";
								}else{
									if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)){
										$new_emailErr = "Invalid email format";
									}else{
										include("../connections.php");
										//number of days
										$date_a = new DateTime($new_checkin);
										$date_b = new DateTime($new_checkout);

										$interval = date_diff($date_a,$date_b);

										$ddiff = $interval->format('%a');

										//condtions
										if($new_room_type == "Suite"){
											$rate = $db_srate;
											$new_room_type = 1;
											$total = ($rate * $ddiff) * $new_number_of_room;
										}elseif($new_room_type == "Luxury"){
											$rate = $db_lrate;
											$new_room_type = 2;
											$total = ($rate * $ddiff) * $new_number_of_room;
										}elseif($new_room_type == "Deluxe"){
											$rate = $db_drate;
											$new_room_type = 3;
											$total = ($rate * $ddiff) * $new_number_of_room;
										}

										mysqli_query($connections, "UPDATE tbl_hrs SET
											first_name = '$new_first_name' , 
											middle_name = '$new_middle_name' , 
											last_name = '$new_last_name' , 
											phone_number = '$new_phone_number' , 
											email = '$new_email' ,
											room_type = '$new_room_type' , 
											number_of_room = '$new_number_of_room' ,
											checkin = '$new_checkin' , 
											checkout = '$new_checkout' WHERE id_user = '$id_user'
										");
										mysqli_query($connections, "UPDATE payment SET
											first_name = '$new_first_name' , 
											middle_name = '$new_middle_name' ,
											last_name = '$new_last_name' ,
											room_type = '$new_room_type' , 
											room_rate = '$rate' , 
											noroom = '$new_number_of_room' , 
											checkin = '$new_checkin' , 
											checkout = '$new_checkout' WHERE code_hrs = '$incode_hrs'
										");

										$encrypted = md5(rand(1,9));
										echo "<script>window.location.href='roomreservations?$encrypted&&notify=Record has been updated';</script>";
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
<center>
<form method="POST">
	<table border="0" width="60%">
		<tr>
			<td width="15%">First name: </td>
			<td width="60%">
				<input type="text" name="new_first_name" value="<?php echo $db_first_name ?>">
			</td>
			<td>
				<span class="error"><?php echo $new_first_nameErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>Middle name: </td>
			<td>
				<input type="text" name="new_middle_name" value="<?php echo $db_middle_name ?>">
			</td>
			<td>
				<span class="error"><?php echo $new_middle_nameErr ?></span>
			</td>
		</tr>
		<tr>
			<td>Last name: </td>
			<td>
				<input type="text" name="new_last_name" value="<?php echo $db_last_name ?>">
			</td>
			<td>
				<span class="error"><?php echo $new_last_nameErr; ?></span>
			</td>
		</tr>
		<tr>
			<td >Phone number: </td>
			<td>
				<input type="text" name="new_phone_number"  maxlength="11" size="20" onkeypress='return event.charCode>=48 && event.charCode<=57' value="<?php echo $db_phone_number; ?>"/>
			</td>
			<td>
				<span class="error"><?php echo $new_phone_numberErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td> 
				<input type="text" name="new_email" value="<?php echo $db_email ?>" >
			</td>
			<td>
				<span class="error"><?php echo $new_emailErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>Room type:</td>
			<td> 
				<select name="new_room_type" id="room_type" onchange="category(this.value);" >
					<option name="new_room_type" value=""></option>

					<option name="new_room_type" value="Suite" <?php if($db_room_type=="Suite"){echo "Suite";} ?> >Suite</option>
					<option name="new_room_type" value="Luxury" <?php if($db_room_type=="Luxury"){echo "Luxury";} ?>>Luxury</option>
					<option name="new_room_type" value="Deluxe" <?php if($db_room_type=="Deluxe"){echo "Deluxe";} ?>>Deluxe</option>
					
				</select>
			</td>
			<td>
				<span class="error"><?php echo $new_room_typeErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>Number of room:</td>
			<td>
				<select name="new_number_of_room" id="number_of_room">
					<option name="new_number_of_room" value=""></option>

					<option name = "new_number_of_room" value="1" <?php if($new_number_of_room=="1"){echo "1";} ?> >1</option>
					<option name = "new_number_of_room" value="2" <?php if($new_number_of_room=="2"){echo "2";} ?> >2</option>
			</td>
			<td>
				</select><span class="error"><?php echo $new_number_of_roomErr; ?></span>
			</td>
		</tr>
		<tr><td>Check in date:</td>
			<td>
				 <input type="text" name="new_checkin" id="datepicker" placeholder="Check in"  value="<?php echo $db_checkin; ?>" readonly />
			</td>
			<td>
				<span class="error"><?php echo $new_checkinErr; ?></span>

			</td>
		</tr>
		<tr>
			<td>Check out date:</td>
			<td>
				<input type="text" name="new_checkout" id="datepicker2" placeholder="Check out" value="<?php echo $db_checkout; ?>" readonly />
			</td>
			<td>
				<span class="error"><?php echo $new_checkoutErr; ?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<hr>
			</td>
			<td><input type="hidden" name="code_hrs" value="<?php echo $db_code_hrs ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<input type="submit" name="btnUpdate" value="Update" class="btn-update">
			</td>
		</tr>

	</table>
</form>
</center>





<link rel="stylesheet" href="../css/foundation-datepicker.css">
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/foundation-datepicker.js"></script>
<script>
	$('#datepicker').fdatepicker({
		format: 'yyyy-mm-dd'
	});

	$('#datepicker2').fdatepicker({
		format: 'yyyy-mm-dd'
	});
</script>