<!DOCTYPE>
<html>

	<head>
		<title>Beneficiaries List</title>
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
		<h2><span>BENEFICIARIES</span></h2>
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
	
		$sql = "SELECT * FROM beneficiary";
		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>BID</th><th>Beneficiary name</th><th>Problem faced </th><th>Contact number</th><th>Tracker </th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["BID"]."</td><td>". $row["bname"]."</td><td>". $row["prob"]."</td><td>". $row["contactno"]."</td><td>". $row["tracker"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>Beneficiary details unavailable</p>";
		}
		mysqli_close($conn);
		?>
		<center><a href="abeneficiary.php">BACK</a></center>
	</div>
	<footer></footer>
</body>
</html>