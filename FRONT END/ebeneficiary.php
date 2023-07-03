<!DOCTYPE>
<html>
	<head>
		<title>Your Beneficiaries</title>
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
		<h2><span>YOUR BENEFICIARIES</span></h2>
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
		$query="CALL MyBeneficiary('$username')";
		$result = mysqli_query($conn,$query);
		if(!$result)
			echo "<p>Beneficiary details unavailable</p>";
		else{
		if(mysqli_num_rows($result) > 0) {
    		echo "<table border=1><tr><th>BID</th><th>Beneficiary name</th><th>Contact number</th><th>Problem faced</th></tr>";
    		// output data of each row
    		while($row =mysqli_fetch_assoc($result)) {
        		echo "<tr><td>". $row["BID"]."</td><td>". $row["bname"]."</td><td>". $row["contactno"]."</td><td>". $row["prob"]."</td></tr>";
    		}
    		echo "</table>";
		} else {
    	echo "<p>There are no beneficiaries under you in the database!</p>";
		}
		}
		mysqli_close($conn);
		?>
	</div>
	<footer></footer>
</body>
</html>