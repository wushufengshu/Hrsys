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


date_default_timezone_set("Asia/Manila");

$addroom = $new_room_number = $addroomstr= "";
$addroomErr = $new_room_numberErr = "";
$check_room = mysqli_query($connections, "SELECT * FROM room");
while($check_row = mysqli_fetch_assoc($check_room)){
	$db_id = $check_row["id"];
	$db_room_type = $check_row["room_type"];
	$db_room_number = $check_row["room_number"];
}

if(isset($_POST["btnAddRoom"])){
	
	if(empty($_POST["addroom"])){
		$addroomErr = "*";
	}else{
		$addroom = $_POST["addroom"];
	}

	if(empty($_POST["new_room_number"])){
		$new_room_numberErr = "*";
	}else{
		$new_room_number = $_POST["new_room_number"];
	}

	if($addroom AND $new_room_number){
		$count_room_number_string = strlen($new_room_number);
		if($count_room_number_string > 10){
			$new_room_numberErr = "Room number name too long";
		}else{
			if($db_room_number == $new_room_number){
				$new_room_numberErr = "Room number is already registered";
			}else{
				if($addroom == "1"){
					$addroomstr = "Suite";
				}elseif($addroom == "2"){
					$addroomstr = "Luxury";
				}elseif($addroom == "3"){
					$addroomstr = "Deluxe";
				}
				$new_room_number = $addroomstr . $new_room_number;

				include("../connections.php");
				mysqli_query($connections, "INSERT INTO room(room_type,room_number,status)
				VALUES('$addroom', '$new_room_number','Available') ");

			$roomAdded = md5(rand(1,9));
			echo "<script>window.location.href=' ?roomAdded=$roomAdded&&Room$new_room_number is succesfully added';</script>";
			}
		}
	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width initial-scale=1'>
	<meta name=description"" content="Affordable and high class hotel">
	<meta name="keywords" content="Affordable rooms, etc">
	<meta name="author" content="Khamaka Brekker">

	<title>Suite Life</title>
	<link rel="icon" type="image/png" sizes="16x16" href="../resources/ico/favicon-16x16.png">
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="stylesheet" href="../css/stylesheet.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<div class="navbar">
	<img src="../resources/icons/logofinalhotel_icon.png" alt="">
	<div id="branding">
        <h1><span class="highlight">Suite Life Hotel</span></h1>
    </div>
	<div class="dropdown">
		<button class="dropbtn" onclick="myFunction()"><?php echo $username; ?>
		<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content" id="myDropdown">
			<a href="logout">Log out</a>
		</div>
	</div>
</div>

<div class="vertical-menu">
	<a href="index">Home</a>
	<a href="roomreservations">Room Reservations</a>
	<a href="sales">Sales</a>
	<a href="allrooms" class="active">Rooms</a>
	<a href="bookedrooms">Booked Rooms</a>
	<a href="payment">Payment</a>
	<a href="useradmin">Users</a>
</div>

<div class="main">
	<center><h1>Rooms</h1></center>
	<hr width="100%">
	
	<?php 
	
	if(empty($_GET["removeRoom"])){

	}else{
		include("confirm_removeroom.php");
	}

	?>
	
	<div id="retrieveallrooms">
	

	</div>
	<div class="addroom">
		<form method="POST">
		<center><h2>Add room</h2></center>
		<table border="0" width="100%">
			<tr>
				<td>
					<select name="addroom" class="select-room" >
						<option name=addroom"" value="">Select room</option>
						<option name="addroom" value="1" <?php if($addroom=="Suite"){echo "Suite";} ?>>Suite</option>
						<option name="addroom" value="2" <?php if($addroom=="Luxury"){echo "Luxury";} ?>>Luxury</option>
						<option name="addroom" value="3" <?php if($addroom=="Deluxe"){echo "Deluxe";} ?>>Deluxe</option>
					</select><span class="error"><?php echo $addroomErr; ?></span>&nbsp;
					<input type="text" name="new_room_number" placeholder="Room number" value="<?php echo $new_room_number ?>" class="input-room">
					<span class="error"><?php echo $new_room_numberErr; ?></span>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="btnAddRoom" class="btnAddroom" value="Add room">
				</td>
			</tr>
		</table>
		</form>
	</div>
	<div class="roomcount">
		<h2>Available room details</h2>
		<?php 

		$retrieve_suite = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '1' AND status = 'Available' ");
		$result_suite = mysqli_num_rows($retrieve_suite);

		$retrieve_lux = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '2' AND status = 'Available' ");
		$result_lux = mysqli_num_rows($retrieve_lux);

		$retrieve_del = mysqli_query($connections, "SELECT * FROM room WHERE room_type = '3' AND status = 'Available' ");
		$result_del = mysqli_num_rows($retrieve_del);

		?>
		<center>
		<table border="0" width="60%">
			<tr>
				<td><h1>Suite rooms: </h1></td>
				<td><span class="suite"><b><?php echo $result_suite; ?></b></span></td>
			</tr>
			<tr>
				<td><h1>Luxury rooms:</h1></td>
				<td> <span class="luxury"><b><?php echo $result_lux; ?></b></span></td>
			</tr>
			<tr>
				<td><h1>Deluxe rooms: </h1></td>
				<td><span class="deluxe"><b><?php echo $result_del; ?></b></span></td>
			</tr>
		</table>
		</center>

	</div>
</div>
	






<script type="text/javascript" src="../js/jQuery.js"></script>
<!--script type="application/javascript">
setInterval(function(){
	$('#bookedretriever').load('bookedretriever.php');
},1000)
</script-->

<script type="application/javascript">
setInterval(function(){
	$('#retrieveallrooms').load('retrieveallrooms.php');
},1000)
</script>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}
</script>

	


</body>
</html>