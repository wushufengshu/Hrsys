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
	<a href="allrooms">Rooms</a>
	<a href="bookedrooms" class="active">Booked Rooms</a>
	<a href="payment">Payment</a>
	<a href="useradmin">Users</a>
</div>

<div class="main">
	<center><h1>Booked Rooms</h1></center>
	<hr width="100%">
	<div id="reservedretriever">
	</div>
		

</div>
	






<script type="text/javascript" src="../js/jQuery.js"></script>
<script type="application/javascript">
setInterval(function(){
	$('#bookedretriever').load('bookedretriever.php');
},1000)
</script>

<script type="application/javascript">
setInterval(function(){
	$('#reservedretriever').load('reservedretriever.php');
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