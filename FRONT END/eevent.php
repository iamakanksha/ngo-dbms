<!DOCTYPE>
<html>
	<head>
		<title>Your events</title>
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
		<h2><span>YOUR EVENTS</span></h2>
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
		$query="CALL MyEvents('$username')";
		$result = mysqli_query($conn,$query);
		if(!$result)
			echo "<p>Event details unavailable</p>";
		else{
		if(mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>EvID</th><th>Event title</th><th>Date</th><th>Start time</th><th>Venue</th><th>Event Description</th><th>Sponsor</th><th>Funds raised (in INR)</th><th>Status</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["EvID"]."</td><td>". $row["title"]."</td><td>". $row["edate"]."</td><td>". $row["stime"]."</td><td>". $row["venue"]."</td><td>". $row["edescription"]."</td><td>". $row["sponsor"]."</td><td>". $row["funds"]."</td><td>". $row["status"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>You have not been assigned any event!</p>";
		}
		}
		mysqli_close($conn);
		?>
	</div>
	<footer></footer>
</body>
</html> 