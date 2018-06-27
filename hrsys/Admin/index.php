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

$query_info = mysqli_query($connections, "SELECT * FROM adduser WHERE email = '$email' ");
$info = mysqli_fetch_assoc($query_info);
$account_type = $info["account_type"];
$img = $info["img"];

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

    if($account_type == 1){
        $dis_account_type = "Admin";
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
	<script type="text/javascript" src="../fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
    <script type="text/javascript">
        FusionCharts.ready(function() {
            var revenueChart = new FusionCharts({
                "type": "column2d",
                "renderAt": "chartContainer",
                "width": "500",
                "height": "325",
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
    <script src="../js/jQuery.js"></script>
    <style>
        img{
            height: 150px;
        }
    </style>
    <script type="application/javascript">
        var _URL = window.URL || window.webkitURL;

        function displayPreview(files){
            var file = files[0]
            var img = new Image();
            var sizeKB = file.size / 1024;
            img.onload = function(){
                $('#preview').append(img);
            }
            img.src = _URL.createObjectURL(file);
        }
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
	<a href="index" class="active">Home</a>
	<a href="roomreservations">Room Reservations</a>
    <a href="sales">Sales</a>
	<a href="allrooms">Rooms</a>
	<a href="bookedrooms">Booked Rooms</a>
	<a href="payment">Payment</a>
	<a href="useradmin">Users</a>
</div>

<div class="main">
	<center><h1>Home </h1></center>
    <hr>
    <div class="profile"><center><h3>Your profile</h3></center>
    <form method="POST" enctype="multipart/form-data">
        <table width="90%" border="0">
            <tr height = '100'>
                <td width="30%"><center>
                    <span id="preview">
                        
                    </span></center>
                    <?php 
                    $target_dir ="img_folder/";
                    $uploadErr = "";

                    if(isset($_POST["btnUpload"])){
                        $target_file = $target_dir . "/" . basename($_FILES["profile_pic"]["name"]);
                        $uploadOk = 1;

                        if(file_exists($target_file)){
                            $target_file = $target_dir . rand(1,9) . rand(1,9) . rand(1,9) . "_" . basename($_FILES["profile_pic"]["name"]);
                            $uploadOk = 1;
                        }
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                        if($_FILES["profile_pic"]["size"] > 5000000000000){
                            $uploadErr = "Sorry the file is too large.";
                            $uploadOk = 0;
                        }
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                            $uploadErr = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed";
                            $uploadOk = 0;
                        }
                        if($uploadOk == 1){
                            if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"] , $target_file)){
                                echo "<font color=green>The file ". basename($_FILES["profile_pic"]["name"]) . " has been uploaded.</font>";
                                mysqli_query($connections, "UPDATE adduser SET img = '$target_file' WHERE email='$email' ");
                                $notify = "<font color=green>Your profile photo has been uploaded! </font>";
                                echo "<script>window.location.href='?notify=$notify';</script> ";
                            }else{
                                echo "Sorry, there was an error uploading your file";
                            }
                        }
                    }
                    if(empty($_GET["notify"])){
                        //do nothing
                    }else{
                        echo "<center>" . $_GET["notify"] . "</center>";
                    }
                    if($img == ""){
                        echo "<center>No photo</center>";
                    }else{
                        echo "<img src='$img' height='150px' width='150px' > ";
                    }

                    
                    ?>
                
                </td>
                <td width="15%">
                    <input type="file" id="profile_pic" name="profile_pic" onchange="displayPreview(this.files);"/><br><br><hr>
                    <input type="submit" name="btnUpload" class="btn-update" value="Upload">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    Position: 
                </td>
                <td>
                    <?php echo $dis_account_type; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>
                    Name: 
                </td>
                <td>
                    <?php echo $name; ?>
                </td>
            </tr>
             <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>
                    Email: 
                </td>
                <td>
                    <?php echo $email; ?>
                </td>
            </tr>
             <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>
                    Username: 
                </td>
                <td>
                    <?php echo $username; ?>
                </td>
            </tr>
             <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table>
    </form><span class="error"><?php echo $uploadErr; ?></span>
    </div>
    
    <a href="sales">    
        <div id="chartContainer">FusionCharts XT will load here!</div>
    </a>


   
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