<!DOCTYPE>
<html>

	<head>
		<title>Events List</title>
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
	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>

	<div class="wrapper" align=center>
	<div class="navbar1" align="center">
		<button><a href="#upcoming">UPCOMING EVENTS</a></button>
		<button><a href="#done">COMPLETED EVENTS</a></button>
	</div>	
	<br>
		<a name="upcoming"><h2><span>UPCOMING EVENTS</span></h2></a>
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
	
		$sql = "SELECT * FROM event where status='pending'";
		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>EvID</th><th>Event title</th><th>Manager ID</th><th>Date</th><th>Start time</th><th>Venue</th><th>Event Description</th><th>Sponsor</th><th>Funds raised (in INR)</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["EvID"]."</td><td>". $row["title"]."</td><td>". $row["manager"]."</td><td>". $row["edate"]."</td><td>". $row["stime"]."</td><td>". $row["venue"]."</td><td>". $row["edescription"]."</td><td>". $row["sponsor"]."</td><td>". $row["funds"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>No upcoming event details available</p>";
		}
		mysqli_close($conn);
		?>
		<br>
		<a name="done"><h2><span>COMPLETED EVENTS</span></h2></a>
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
	
		$sql = "SELECT * FROM event where status='complete'";
		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>EvID</th><th>Event title</th><th>Manager ID</th><th>Date</th><th>Start time</th><th>Venue</th><th>Event Description</th><th>Sponsor</th><th>Funds raised (in INR)</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["EvID"]."</td><td>". $row["title"]."</td><td>". $row["manager"]."</td><td>". $row["edate"]."</td><td>". $row["stime"]."</td><td>". $row["venue"]."</td><td>". $row["edescription"]."</td><td>". $row["sponsor"]."</td><td>". $row["funds"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>No completed event details available</p>";
		}
		mysqli_close($conn);
		?>
		
		<center><a href="aevent.php">BACK</a></center>
	</div>
	<footer></footer>
</body>
</html>