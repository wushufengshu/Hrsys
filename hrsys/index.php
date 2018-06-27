<?php
include("connections.php");
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
</head>
<body>
	<header>
		<div class="container">
			<div id="branding">
				<h1><span class="highlight">Suite Life Hotel</span></h1>
			</div>
			<nav>
				<ul>
					<li class="current"><a href="index">Home</a></li>
					<li><a href="#rooms">Rooms and Rates</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#services">Services</a></li>
					<li><a href="roomreservation">Book room</a></li>
					<li><a href="cancelreservation">Cancel Reservation</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="bg">
	<section id="showcase">
		<div class="container">
			<h1>RELAX, INDULGE, AND PAMPER</h1>
			<p>Enjoy and relax in Suite Life Hotel with the beautiful sceneries of Tagaytay.</p>
		</div>
	</section>
	</div>


	<section id="bookreservation">
		<a href="roomreservation">
			<div class="bookreservation-banner-inner">Book room
			</div>
		</a>
	</section>

	<section id="rooms">
		<span><h2>Rooms and Rates	</h2></span>
		<div class="container"><center>
		<table width="80%" border="0">
			<tr>
				<td width="40%">
					<div class="box">
						<a href="roomreservation">
							<img src="resources/img/6room.jpg" alt="Suite Room">
							Suite Room <br>
							<?php echo "&#x20b1 " .$db_srate; ?>
						</a><br>
					</div>
				</td>
				<td>
					<div class="content">
						<pre>
	This room have a capacity of six people.

	• One twin bed or One queen size 
	• Sofa Bed 
	• Bath Amenities
	• Hot & Cold shower
	• Bath tub
	• Hair Dryer
	• Mini Bar
	• Complimentary Bottled Water
	• Coffee/Tea Making Facilities
	• Internet Access
	• Television
	• Inclusive of two free breakfast
						</pre>
					</div>

				</td>
			</tr>
			<tr>
				<td>
					<div class="box">
						<a href="roomreservation">
							<img src="resources/img/4room.jpg" alt="Suite Room">
							Luxury Room	<br>
							<?php echo "&#x20b1 " .$db_lrate; ?>
						</a><br>

					</div>
					
				</td>
				<td>
					<div class="content">
						<pre>
	This room have a capacity of four people.

	• Two twin bed or one queen bed
	• Bath Amenities
	• Hot & Cold shower
	• Hair Dryer
	• Mini Bar
	• Complimentary Bottled Water
	• Coffee/Tea Making Facilities
	• Internet Access
	• Television
	• Inclusive of two free breakfast
						</pre>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="box">
						<a href="roomreservation">
							<img src="resources/img/2room.jpg" alt="Suite Room">
							Deluxe Room	<br>
							<?php echo "&#x20b1 " .$db_drate; ?>
						</a><br>
					</div>
				</td>
				<td>
					<div class="content">
						<pre>
	This room have a capacity of two people.

	• Two single bed or one twin bed
	• Bath Amenities
	• Hot & Cold shower
	• Hair Dryer
	• Mini Bar
	• Complimentary Bottled Water
	• Coffee/Tea Making Facilities
	• Internet Access
	• Television
	• Inclusive of two free breakfast
						</pre>
					</div>
				</td>
			</tr>
			
		</table>
		</center>
		</div>
	</section>

	



	<section id="services">
		<center>
		<div id="pictures">
			<center>
				<table border="0" width="80%">
					<tr>
						<th colspan="3"><h2>Gallery</h2></th>
					</tr>
					<tr>
						<td>
							<div class="pics">
								<img src="resources/img/pool.jpeg" alt="Swimming pool">
								<br><center><h3>Swimming pool</h3></center>
							</div>
						</td>
						<td>
							<div class="pics">
								<img src="resources/img/massage.jpg" alt="Massage">
								<br><center><h3>Spa</h3></center>
							</div>
						</td>
						<td >
							<div class="pics">
								<img src="resources/img/hotelbar.jpg" alt="Swish bar">
								<br><center><h3>Swish bar</h3></center>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="pics">
								<img src="resources/img/coffeeshop.jpg" alt="Swirl Coffee shop">
								<br><center><h3>Swirl Coffee Shop</h3></center>
							</div>
						</td>
						<td>
							<div class="pics">
								<img src="resources/img/resto.jpeg" alt="Swift Restaurant">
								<br><center><h3>Swift Restaurant</h3></center>
							</div>
						</td>
						<td>
							<div class="pics">
								<img src="resources/img/gym.jpeg" alt="Gym">
								<br><center><h3>Gym</h3></center>
							</div>
						</td>
					</tr>
				</table>
			</center>

		</div>
		</center>
	</section>
	
	<section id="aboutus">
		<div class="container">
			<h3 id="about">About Suite Life Hotel</h3>
			<p>	A five star hotel in Tagaytay City that provides a full range of amenities for work or play. You’ll feel right at home the minute you enter the hotel, reveling in our genuine hospitality. You’ll feel remarkably well rested and top it off with a night in our comfortable beds. You can even stay connected with your loved ones with our complimentary wireless internet. You’ll find our stylish settings perfect for your work or relaxation. Our wide range of international cuisine means you’ll always find something to suit your palate.</p>
			<img src="resources/img/hotel2.jpg" alt="">
		</div>
	</section>

	
	

	
	



	
	
	<footer>
		<section id="newsletter">
			<div class="container">
				<h1>Subscribe to our newsletter</h1>
				<form>
					<table width="40%">
						<tr>
							<td>
								<input type="email" placeholder="Enter email" style="color: #000;" />
							</td>
							<td>
								<input type="submit" class="btnSubscribe" value="Subscribe">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="foot">
				Suite Life Hotel, Copyright &copy; 2018
			</div>
		</section>
	</footer>

</body>
</html>