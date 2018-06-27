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
?>
<br>
<center>
<table width="100%" border="0">
	<tr>
		<td width="15%"><b>Name</b></td>
		<td width="15%"><b>Email</b></td>
		<td width="15%"><b>Username</b></td>
		<td width="20%"><b>Action</b></td>
	</tr>
	<tr>
		<td colspan='5'>
			<hr>
		</td>
	</tr>




<?php 
include("../connections.php");
$retrieve_user = mysqli_query($connections, "SELECT * FROM adduser");
while ($row_user = mysqli_fetch_assoc($retrieve_user)) {
	$id = $row_user["id"];
	$db_email = $row_user["email"];
	$db_name = $row_user["name"];
	$db_username = $row_user["username"];
	$db_password = $row_user["password"];


	$jScript = md5(rand(1,9));
	$newScript = md5(rand(1,9));
	$getUpdate = md5(rand(1,9));
	$getDelete = md5(rand(1,9));

	echo "
	
	<tr>
		<td>$db_name</td>
		<td>$db_email</td>
		<td>$db_username</td>
		<td>
				<a href=' ?jScript=$jScript&&newScript=$newScript&&getUpdate=$getUpdate&&id=$id' class='btn-update'>Update</a>
				&nbsp;

				<a href=' ?jScript=$jScript&&newScript=$newScript&&getDelete=$getDelete&&id=$id' class='btn-delete'>
					Remove</a>
			<br>
		</td>
	</tr>
	<tr>
		<td colspan='5'>
			<hr>
		</td>
	</tr>


	";
}

?>
</table>
</center>