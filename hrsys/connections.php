<?php  

$connections = mysqli_connect("localhost", "root", "", "hotelreservationdb");
if(mysqli_connect_errno()){

	echo "Failed to connect to MySQL database: " . mysqli_connect_errno();
}

?>
<style>
.error{
	color: red;
}
.btn-primary{
	-webkit-border-radius:0;
	-moz-border-radius:0;
	border-radius: 4px;
	font-family: Georgia;
	color: #fff;
	font-size: 15px;
	background: #2f97ef;
	padding: 8px 10px;
	text-transform: uppercase;
	border: none;
	text-decoration: none;
	cursor: pointer;
}
.btn-primary:hover{
	background: #37aff7;
	text-decoration: none;
}

.btn-update{
	font-family: sans-serif;
	color: #fff;
	font-size: 15px;
	background: #09192A;
	padding: 8px 10px;
	text-decoration: none;
	text-transform: uppercase;
	border-radius: 4px;
}
.btn-update:hover{
	background: #063c53;
	text-decoration: none;
}
.btn-delete{
	font-family: sans-serif;
	border-radius: 4px;
	color: #fff;
	font-size: 15px;
	background: #d93434;
	padding: 8px 10px;
	text-decoration: none;
	text-transform: uppercase;
	border: none;
}
.btn-delete:hover{
	background:#ff6d6d;
	text-decoration: none;
}
</style>