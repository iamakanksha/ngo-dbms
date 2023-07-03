<!DOCTYPE>
<html>
    <head>
        <title>Login Information</title>
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
    </div>
    <div class='wrapper' align='center'>
        <h2><span>LOGIN DETAILS</span></h2>
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
        $sql = "SELECT l.EID,e.name,l.username,l.password, l.access_per FROM login l, employee e where e.EID=l.EID";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border=1><tr><th>Employee ID</th><th>Employee Name</th><th>Username</th><th>Password</th><th>Access permission</th></tr>";
            // output data of each row
            while($row =mysqli_fetch_assoc($result)) {
                echo "<tr><td>". $row["EID"]."</td><td>". $row["name"]."</td><td>". $row["username"]."</td><td>". $row["password"]."</td><td>". $row["access_per"]."</td></tr>";
            }
            echo "</table>";
        } else {
        echo "<p>Login details unavailable</p>";
        }
        mysqli_close($conn);
        ?>    
    </div>
    <center><a href="logindetails.php">BACK</a></center>
    <footer></footer>
</body>
</html>