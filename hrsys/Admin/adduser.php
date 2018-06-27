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


$fullname = $email = $username = $password = $cpassword = "";
$fullnameErr = $emailErr = $usernameErr = $passwordErr = $cpasswordErr = "";
$error = "* All fields are required";


if(isset($_POST["btnAddUser"])){
	if(empty($_POST["fullname"])){
		$fullnameErr = $error;
	}else{
		$fullname = $_POST["fullname"];
	}

	if(empty($_POST["inemail"])){
		$emailErr = $error;
	}else{
		$email = $_POST["inemail"];
	}

	if(empty($_POST["username"])){
		$usernameErr = $error;
	}else{
		$username = $_POST["username"];
	}

	if(empty($_POST["password"])){
		$passwordErr = $error;
	}else{
		$password = $_POST["password"];
	}

	if(empty($_POST["cpassword"])){
		$cpasswordErr = $error;
	}else{
		$cpassword = $_POST["cpassword"];
	}


	if($fullname AND $email AND $username AND $password AND $cpassword){
		$pattern = "/^[a-zA-Z ]*$/";
		$error_pattern = "Invalid name: Only letters are allowed";
		if(!preg_match($pattern, $fullname)){
			$fullnameErr = $error_pattern;
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailErr = "Invalid email format";
			}else{
				$count_username_string = strlen($username);
				if($count_username_string > 10){
					$usernameErr = "Username max is 10";
				}else{
					if($password != $cpassword){
						$passwordErr = "passwword didnt match";
					}else{
						$check_username = mysqli_query($connections, "SELECT * FROM adduser WHERE username ='$username' ");
						$row_check = mysqli_num_rows($check_username);

						if($row_check > 0 ){
							$usernameErr = "Username is already registered";
						}else{
							$insert_user = mysqli_query($connections, "INSERT INTO adduser(name,email,username,password,account_type) VALUES ('$fullname','$email', '$username','$password','1') ");
							$jScript =md5(rand(1,9));
							echo "<script>window.location.href=' ?jScript=$jScript&&Admin $username successfully registered';</script>";

						}
					}
				}
			}
		}
	}
}

?>
	
<div class="addusertbl">
<form method="POST">
		<table border="0" width="100%">
			<tr>
				<td width="15%">Full name</td>
				<td width="60%">
					<input type="text" name="fullname" placeholder="Full name" value="<?php echo $fullname ?>">
				</td>
				<td>
					<span class="error"><?php echo $fullnameErr ?></span>
				</td>
			</tr>
			<tr>
				<td>Email: </td>
				<td>
					<input type="text" name="inemail" placeholder="Email" value="<?php echo $email ?>">
				</td>
				<td>
					<span class="error"><?php echo $emailErr; ?></span>
				</td>
			</tr>
			<tr>
				<td>Username: </td>
				<td>
					<input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" >
					
				</td>
				<td>
					<span class="error"><?php echo $usernameErr; ?></span>
				</td>
			</tr>
			<tr>
				<td>Password: </td>
				<td>
					<input type="password" name="password" placeholder="Password" value="<?php echo $password ?>">
					
				</td>
				<td>
					<span class="error"><?php echo $passwordErr; ?></span>
				</td>
			</tr>
			<tr>
				<td>Confirm password: </td>
				<td>
					<input type="password" name="cpassword" placeholder="Confirm Password" value="<?php echo $cpassword ?>">
					
				</td>
				<td>
					<span class="error"><?php echo $cpasswordErr; ?></span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" class="btn-primary" name="btnAddUser" value="Add user" style="width: 100%;cursor: pointer;">
				</td>
			</tr>
		</table>
	
</form>
</div>