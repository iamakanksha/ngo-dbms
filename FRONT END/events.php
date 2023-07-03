<!DOCTYPE>
<html>

	<head>
		<title>Our Events</title>
		<link rel="stylesheet" type="text/css" href="ev.css">
	</head>
<body>
	<header></header>
	<div class="navbar">
		<nav>
		<button><a href="home.html">HOME</a></button>
		<button><a href="home.html#about">ABOUT</a></button>
		<button><a href="events.php">EVENTS</a></button>
		<button><a href="workwithus.html">WORK WITH US</a></button>
		<button><a href="home.html#contactus">CONTACT US</a></button>
		<button><a href="loginpage.php">LOGIN</a></button>
		</nav>
	</div>

	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>

	<div class="section" align=center>
		<a name="events"><h2><span>UPCOMING EVENTS</span></h2></a>
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
    		echo "<table border=1><tr><th>Event</th><th>Date</th><th>Time</th><th>Venue</th><th>Event description</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["title"]."</td><td>". $row["edate"]."</td><td>". $row["stime"]."</td><td>". $row["venue"]."</td><td>". $row["edescription"]."</td></tr>";
    		}
    		echo "</table>";
    		echo "<p>Interested volunteers can report to their guides.</p>";
		} else {
    	echo "<p>No upcoming event details are available!!</p>";
		}
		mysqli_close($conn);
		?>
	</div>
	<br>
	<br>
	<br>
	<footer></footer>
</body>
</html>