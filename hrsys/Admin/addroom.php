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
<form method="POST">
	<center>
		<table>
			<tr>
				<td>
					<span class="error" ><?php echo $room_typeErr; ?></span>
					<select name="room_type" id="room_type" >
						<option name="room_type" value="">Select room</option>

						<option name="room_type" value="Suite" <?php if($room_type=="Suite"){echo "selected";} ?> >Suite</option>
						<option name="room_type" value="Luxury" <?php if($room_type=="Luxury"){echo "selected";} ?>>Luxury</option>
						<option name="room_type" value="Deluxe" <?php if($room_type=="Deluxe"){echo "selected";} ?>>Deluxe</option>
					</select>
				</td>
			</tr>
		</table>
	</center>
</form>