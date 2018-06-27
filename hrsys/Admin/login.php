<?php 
session_start();
include("../connections.php");

if(isset($_SESSION["email"])){

	$email = $_SESSION["email"];

	$query_account_type = mysqli_query($connections, "SELECT * FROM adduser WHERE email = '$email' ");

	$get_account_type = mysqli_fetch_assoc($query_account_type);

	$account_type = $get_account_type["account_type"];

	if($account_type == 1 ){
		echo "<script>window.location.href='index';</script>";
	}else{
		echo "<script>window.location.href='index';</script>";
	}
}

date_default_timezone_set("Asia/Manila");
$date_now = date("m/d/Y");
$time_now = date("h:i a");
$notify = $attempt = $log_time = "";

$end_time = date("h:i A", strtotime("+2 minutes", strtotime($time_now)));



$email = $password = "";
$emailErr = $passwordErr = "";

if(isset($_POST["btnLogin"])){
	if(empty($_POST["email"])){
		$emailErr = "Required";
	}else{
		$email = $_POST["email"];
	}

	if(empty($_POST["password"])){
		$passwordErr = "Required";
	}else{
		$password = $_POST["password"];
	}

	if($email and $password){
		$check_email =  mysqli_query($connections, "SELECT * FROM adduser WHERE email = '$email' ");
		$check_row = mysqli_num_rows($check_email);

		if($check_row> 0){
			$fetch = mysqli_fetch_assoc($check_email);
			$db_password = $fetch["password"];
			$db_attempt = $fetch["attempt"];
			$db_log_time = strtotime($fetch["log_time"]);
			$my_log_time = $fetch["log_time"];
			$new_time = strtotime($time_now);
			$account_type = $fetch["account_type"];
			if($account_type =='1'){
				if($db_password == $password){

					$_SESSION["email"] = $email;

					echo "<script>window.location.href='index' </script>";
				}else{
					$passwordErr ="Password is incorrect";
				}
			}else{
				if($db_log_time <= $new_time){
					if($db_password == $password){

						$_SESSION["email"] = $email;

						mysqli_query($connections, "UPDATE adduser SET attempt='0', log_time='' WHERE email = '$email' ");
						echo "<script>window.location.href='index.php';</script> ";
					}else{
						$attempt = $db_attempt + 1;
						if($attempt >= 3){
							mysqli_query($connections, "UPDATE adduser SET attempt='$attempt', log_time = '$end_time' WHERE email = '$email' ");
							$notify = "You already reach the 3 times attempt to login, please login after 2minutes: $end_time";

						}else{
							mysqli_query($connections, "UPDATE adduser SET attempt ='$attempt' WHERE email = '$email' ");
							$passwordErr = "Password is incorrect";
							$notify = "Login attempt: $attempt";
						}
					}

				}else{
					$notify = "Im sorry you have to wait until: $my_log_time before you can login";
				}
			}

		}else{
			$emailErr = "Email not registered";
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
	<script type="text/javascript" src="../fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>

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

<div class="login">
	<center>
	<form method="POST">
		<h2>Sign in</h2>

		<input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>"><br>
		<span class="error"><?php echo $emailErr; ?></span><br>

		<input type="password" name="password" placeholder="Password" value=""><br><span class="error"><?php echo $passwordErr; ?></span><br>
		<input type="submit" name="btnLogin" value="Login" class="btn-primary">
		<br><br>
		<span class="error"><?php echo $notify; ?></span>
		<br>
	</form>
</center>
</div>


</body>
</html>