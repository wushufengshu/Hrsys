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

$query_name = mysqli_query($connections, "SELECT * FROM adduser WHERE id = '$id' ");
$row_ = mysqli_fetch_assoc($query_name);
$db_username = $row_["username"];
$db_password = $row_["password"];

if(isset($_POST["btnDelete"])){
	mysqli_query($connections, "DELETE FROM adduser WHERE id = '$id' ");
	echo "<script>window.location.href='useradmin?notify=User $db_username has been removed';</script>";
}
?>
<center>
	<form method="POST">
		<h3>You are about to remove user: <font color="red"><?php echo $db_username; ?></font></h3>
		<input type="submit" name="btnDelete" value="Confirm" class="btn-delete"> &nbsp; <a href="?" class="btn-primary">Cancel</a>
	</form>
</center>