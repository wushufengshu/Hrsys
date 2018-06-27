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

$id = $_GET["id"];

$get_record = mysqli_query($connections, "SELECT * FROM adduser WHERE id = '$id' ");

while ($get = mysqli_fetch_assoc($get_record)) {
	$db_name = $get["name"];
	$db_email = $get["email"];
	$db_username = $get["username"];
	$db_password = $get["password"];
}

$new_name = $new_email = $new_username = $new_password = "";
$new_nameErr = $new_emailErr = $new_usernameErr = $new_passwordErr = "";

if(isset($_POST["btnUpdate"])){
	if(empty($_POST["new_name"])){
		$new_nameErr = "*";
	}else{
		$new_name = $_POST["new_name"];
		$db_name = $new_name;
	}
	if(empty($_POST["new_email"])){
		$new_emailErr = "*";
	}else{
		$new_email = $_POST["new_email"];
		$db_email = $new_email;
	}

	if(empty($_POST["new_username"])){
		$new_usernameErr = "*";
	}else{
		$new_username = $_POST["new_username"];
		$db_username = $new_username;
	}
	if(empty($_POST["new_password"])){
		$new_passwordErr = "*";
	}else{
		$new_password = $_POST["new_password"];
		$db_password = $new_password;
	}

	if($new_name && $new_email && $new_username && $new_password){
		mysqli_query($connections, "UPDATE adduser SET 
		name = '$db_name' , 
		email = '$db_email' ,
		username = '$db_username',
		password = '$db_password' WHERE id = '$id' ");

		$encrypted = md5(rand(1,9));
		echo "<script>window.location.href='useradmin?$encrypted&&notify=User $db_username has been updated';</script>";
	}
}
?>
<br><br>
<form method="POST">
	<table border="0" width="40%">
		<tr>
			<td width="20%">New name: </td>
			<td>
				<input type="text" name="new_name" value="<?php echo $db_name ?>"><span class="error"><?php echo $new_nameErr ?></span>
			</td>
		</tr>
		<tr>
			<td>New email: </td>
			<td>
				<input type="text" name="new_email" value="<?php echo $db_email ?>"><span class="error"><?php echo $new_emailErr; ?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">New username: </td>
			<td>
				<input type="text" name="new_username" value="<?php echo $db_username?>"><span class="error"><?php echo $new_usernameErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>New Password: </td>
			<td>
				<input type="text" name="new_password" value="<?php echo $db_password?>"><span class="error"><?php echo $new_passwordErr; ?></span>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="btnUpdate" value="Update" class="btn-update">  <a href="?" class="btn-primary">Back</a>
			</td>
		</tr>
	</table>
</form>