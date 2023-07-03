<!DOCTYPE>
<html>
	<head>
		<title>Your volunteers</title>
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
		<button><a href="edonation.php">DONATION</a></button>
		<button><a href="loginpage.php">LOGOUT</a></button>
		</nav>
	</div>
	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>

	<div class="wrapper" align=center>
		<h2><span>YOUR VOLUNTEERS</span></h2>
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
		$query="CALL MyVolunteers('$username')";
		$result = mysqli_query($conn,$query);
		if(!$result)
			echo "<p>Volunteer details unavailable</p>";
		else{
		if(mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>VID</th><th>Full name</th><th>Date of Birth</th><th>Age</th><th>Gender</th><th>Qualification</th><th>E-mail</th><th>Phone number</th><th>Address</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["VID"]."</td><td>". $row["vname"]."</td><td>". $row["dob"]."</td><td>". $row["vage"]."</td><td>". $row["gender"]."</td><td>". $row["qualification"]."</td><td>". $row["email"]."</td><td>". $row["phno"]."</td><td>". $row["addr"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>There are no volunteers under your guidance in the database!</p>";
		}
		}
		mysqli_close($conn);
		?>
	</div>
	<center><a href="evol.php">click here to add/delete/update volunteer details</a></center><br>
	<center><a href="empvolunteer.html">BACK</a></center><br>
	<footer></footer>
</body>
</html>