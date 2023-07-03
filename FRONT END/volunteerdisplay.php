<!DOCTYPE>
<html>
<head>
	<title>Volunteers</title>
	<link rel="stylesheet" type="text/css" href="db.css">
</head>
<body>
	<header></header>
	<div class="navbar">
		<nav>
		<button><a href="dashboard.html">WELCOME</a></button>
		<button><a href="aevent.php">EVENTS</a></button>
		<button><a href="employee.html">EMPLOYEES</a></button>
		<button><a href="volunteer.html">VOLUNTEERS</a></button>
		<button><a href="abeneficiary.php">BENEFICIARIES</a></button>
		<button><a href="donation.php">DONATIONS</a></button>
		<button><a href="loginpage.php">LOGOUT</a></button>
		</nav>
	</div>
	<div class='wrapper' align='center'>
		<h2><span>VOLUNTEER DETAILS</span></h2>
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
	
		$sql = "SELECT * FROM volunteer";
		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>VID</th><th>Name</th><th>Qualification</th><th>e-mail</th><th>Contact Number</th><th>Address   </th><th>Date of Birth  </th><th>Age</th><th>Gender</th><th>Guide</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["VID"]."</td><td>". $row["vname"]."</td><td>". $row["qualification"]."</td><td>". $row["email"]."</td><td>". $row["phno"]."</td><td>". $row["addr"]."</td><td>". $row["dob"]."</td><td>". $row["vage"]."</td><td>". $row["gender"]."</td><td>". $row["guide"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>Volunteer details unavailable</p>";
		}
		mysqli_close($conn);
		?>
	</div>
	<center><a href="avolunteer.php">BACK</a></center>
	<footer></footer>
</body>
</html>
