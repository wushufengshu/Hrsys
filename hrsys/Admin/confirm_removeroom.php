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

$error = "";
$id = $_GET["id"];

$query_remove = mysqli_query($connections, "SELECT * FROM room WHERE id='$id' ");

$remove_ = mysqli_fetch_assoc($query_remove);

$db_room_type = $remove_["room_type"];
$db_room_number = $remove_["room_number"];
$db_status = $remove_["status"];
$db_code_hrs = $remove_["code_hrs"];
$db_checkin = $remove_["checkin"];

include("../connections.php");

if(isset($_POST["btnRemove"])){
	if($db_status == "Reserved" || $db_status == "Occupied"){
		$error = "Room " . $db_room_number ." cannot be remove! ";
	}else{
		mysqli_query($connections, "DELETE FROM room WHERE id='$id' ");
		echo "<script>window.location.href='allrooms?notify=$db_room_number has been removed';</script>";
	}
	
	
}

?>

<center>
<form method="POST">
	<span class="error"><?php echo $error; ?></span>
	<br>
	<h4>You are about to remove room: <font color="red"><?php echo $db_room_number; ?></font></h4>
		<input type="submit" name="btnRemove" value="Remove" class="btn-delete"> &nbsp; &nbsp; <a href="?" class="btn-primary">Cancel</a>
</form>
</center>
<hr>
