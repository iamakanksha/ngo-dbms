<!DOCTYPE>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="edb.css">
</head>
<body>
	<header></header>
	<div class="navbar">
		<nav>
		<button><a href="empdashboard.php">WELCOME</a></button>
		<button><a href="eevent.php">EVENTS</a></button>
		<button><a href="empvolunteer.html">VOLUNTEERS</a></button>
        <button><a href="ebeneficiary.php">BENEFICIARIES</a></button>
		<button><a href="edonation.php">DONATIONS</a></button>
		<button><a href="loginpage.php">LOGOUT</a></button>
		</nav>
	</div>
	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>
	<div class="wrapper" align=center>
		<h2><span>MY INFORMATION</span></h2>
		<?php
		$host="localhost";
		$dbusername="root";
		$dbpassword="";
		$dbname="ngo";
		//create a connection
		$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
		if(mysqli_connect_error())
		{
			die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
		}
		session_start();
		$username=$_SESSION['username'];
		//echo "Logged in username:".$username;
		$query="SELECT * FROM employee e, login l where l.EID=e.EID and e.EID=(Select EID from login where username='$username')";
		$result = mysqli_query($conn,$query);
		if(!$result)
			echo "Your information has not been entered!";
		else{
		if(mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>FIELD</th><th>YOUR INFORMATION</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>Employee ID</td><td>". $row["EID"]."</td></tr>";
        		echo "<tr><td>Employee name</td><td>". $row["name"]."</td></tr>";
        		echo "<tr><td>Username</td><td>". $row["username"]."</td></tr>";
        		echo "<tr><td>Designation</td><td>". $row["designation"]."</td></tr>";
        		echo "<tr><td>Salary (per month)</td><td>". $row["salary"]."</td></tr>";
        		echo "<tr><td>Date of Birth</td><td>". $row["dob"]."</td></tr>";
        		echo "<tr><td>Age</td><td>". $row["age"]."</td></tr>";
        		echo "<tr><td>Sex</td><td>". $row["sex"]."</td></tr>";
        		echo "<tr><td>Phone number</td><td>". $row["phone"]."</td></tr>";
        		echo "<tr><td>Address</td><td>". $row["address"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>User details unavailable</p>";
		}
		}
		mysqli_close($conn);
		?>
		<p>Kindly report to the admin incase of any incorrect data! You can also send a mail to admin@lightofhope.org</p>;
	<footer style="margin-top: 150px;"></footer>
</body>
</html>