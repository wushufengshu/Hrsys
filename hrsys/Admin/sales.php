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


$retrieve_january = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-01-01' AND '2018-01-31'");
$row = mysqli_fetch_assoc($retrieve_january);
$january = $row["total"];

$retrieve_feb = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-02-01' AND '2018-02-31'");
$row = mysqli_fetch_assoc($retrieve_feb);
$feb = $row["total"];

$retrieve_march = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-03-01' AND '2018-03-31'");
$row = mysqli_fetch_assoc($retrieve_march);
$march = $row["total"];

$retrieve_april = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-04-01' AND '2018-04-31'");
$row = mysqli_fetch_assoc($retrieve_april);
$april = $row["total"];

$retrieve_may = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-05-01' AND '2018-05-31'");
$row = mysqli_fetch_assoc($retrieve_may);
$may = $row["total"];

$retrieve_june = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-06-01' AND '2018-06-31'");
$row = mysqli_fetch_assoc($retrieve_june);
$june = $row["total"];

$retrieve_july = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-07-01' AND '2018-07-31'");
$row = mysqli_fetch_assoc($retrieve_july);
$july = $row["total"];

$retrieve_august = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-08-01' AND '2018-08-31'");
$row = mysqli_fetch_assoc($retrieve_august);
$august = $row["total"];

$retrieve_september = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-09-01' AND '2018-09-31'");
$row = mysqli_fetch_assoc($retrieve_september);
$september = $row["total"];

$retrieve_october = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-10-01' AND '2018-10-31'");
$row = mysqli_fetch_assoc($retrieve_october);
$october = $row["total"];

$retrieve_november = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-11-01' AND '2018-11-31'");
$row = mysqli_fetch_assoc($retrieve_november);
$november = $row["total"];

$retrieve_december = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-12-01' AND '2018-12-31'");
$row = mysqli_fetch_assoc($retrieve_december);
$december = $row["total"];


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
	<script type="text/javascript" src="../fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
    <script type="text/javascript">
        FusionCharts.ready(function() {
            var revenueChart = new FusionCharts({
                "type": "column2d",
                "renderAt": "chartContainer",
                "width": "100%",
                "height": "300%",
                "dataFormat": "json",
                "dataSource": {
                    "chart": {
                        "caption": "Monthly revenue for year 2018",
                        "subCaption": "Suite Life Hotel",
                        "xAxisName": "Month",
                        "yAxisName": "Revenues (In Peso)",
                        "theme": "fint"
                    },
                    "data": [{
                            "label": "Jan",
                            "value": "<?php echo $january ?>"
                        },
                        {
                            "label": "Feb",
                            "value": "<?php echo $feb ?>"
                        },
                        {
                            "label": "Mar",
                            "value": "<?php echo $march ?>"
                        },
                        {
                            "label": "Apr",
                            "value": "<?php echo $april ?>"
                        },
                        {
                            "label": "May",
                            "value": "<?php echo $may ?>"
                        },
                        {
                            "label": "Jun",
                            "value": "<?php echo $june ?>"
                        },
                        {
                            "label": "Jul",
                            "value": "<?php echo $july ?>"
                        },
                        {
                            "label": "Aug",
                            "value": "<?php echo $august ?>"
                        },
                        {
                            "label": "Sep",
                            "value": "<?php echo $september ?>"
                        },
                        {
                            "label": "Oct",
                            "value": "<?php echo $october ?>"
                        },
                        {
                            "label": "Nov",
                            "value": "<?php echo $november ?>"
                        },
                        {
                            "label": "Dec",
                            "value": "<?php echo $december ?>"
                        }
                    ]
                }

            });
            revenueChart.render();
        })
    </script>
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
    <a href="sales" class="active">Sales</a>
	<a href="allrooms">Rooms</a>
	<a href="bookedrooms">Booked Rooms</a>
	<a href="payment">Payment</a>
	<a href="useradmin">Users</a>
</div>

<div class="main">
	<center><h1>Sales </h1></center>
    <hr>
    
     <div id="chartContainer">FusionCharts XT will load here!</div>
     <br>
     <div class="gg">
        <a href="PHPExcel/Examples/blank.php" class="btn-primary">Export to excel</a>
        &nbsp;&nbsp;&nbsp;
        <a href="TCPDF/User/blank.php" class="btn-primary">Get PDF</a>
     </div>

   
</div>
	


























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