<!DOCTYPE>
<?php
session_start();
if(isset($_POST['submit'])){
	$host="localhost";
	$user="root";
	$password="";
	$database="ngo";
	$conn = mysqli_connect($host, $user, $password, $database) or DIE('Connection to host has failed perhaps server is down');
	$username= $_POST['username'];
	$password= $_POST['password'];
	
	$query="SELECT * FROM login WHERE username='$username' AND password='$password'and access_per='non-admin'";
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		$_SESSION['username']=$username;
		header('Location: empdashboard.php');
	}
	else{
		echo '<script type="text/javascript"> alert("LOGIN FAILED!")</script>';	
	}
}
?>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<header></header>
	<div class="navbar">
		<nav>
		<button><a href="home.html">HOME</a></button>
		<button><a href="home.html#about">ABOUT US</a></button>
		<button><a href="events.php">EVENTS</a></button>
		<button><a href="workwithus.html">WORK WITH US</a></button>
		<button><a href="home.html#contactus">CONTACT US</a></button>
		<button><a href="loginpage.php">LOGIN</a></button>
		</nav>
	</div>
	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>
	<div class="loginbox">
	<h1>Login for employees</h1>
	<form method="POST" action="loginpage.php">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter username">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter password">
			<input type="submit" name="submit" value=" Login ">
			<a href='adminlogin.php'>click here to login as admin</a><br>
	</form>
	</div>
	<footer style="margin-top:390px;"></footer>
</body>
</html>