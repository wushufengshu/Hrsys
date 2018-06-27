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

<table border="0" width="100%">
	<tr>
		<td width="15%"><b>Room type</b></td>
		<td width="15%"><b>Room number</b></td>
		<td width="15%"><b>Status</b></td>
		<td width="15%"><b>Action</b></td>
	</tr>
	<tr>
		<td colspan="4"><hr></td>
	</tr>

	<?php 

	include("../connections.php");

	$room_type_string = "";

	$bookedretriever_query = mysqli_query($connections, "SELECT * FROM room ORDER BY id ASC");

	while($row_room = mysqli_fetch_assoc($bookedretriever_query)){
		$id = $row_room["id"];

		$room_type = $row_room["room_type"];
		$room_number = $row_room["room_number"];
		$status = $row_room["status"];

		if($room_type == "1"){
			$room_type_string = "Suite";
		}elseif($room_type == "2"){
			$room_type_string = "Luxury";
		}elseif($room_type == "3"){
			$room_type_string = "Deluxe";
		}

		$removeRoom = md5(rand(1,9));
		$jScript = md5(rand(1,9));
		$newScript = md5(rand(1,9));

		echo "
		<tr>
			<td>$room_type_string</td>
			<td>$room_number</td>
			<td>$status</td>
			<td>
				<a href=' ?jScript=$jScript&&newScript=$newScript&&removeRoom=$removeRoom&&id=$id' class='btn-delete'>Remove room</a>
			</td>
		</tr>
		<tr>
			<td colspan='4'><hr></td>
		</tr>
		
		";
	}

	?>
	</table>