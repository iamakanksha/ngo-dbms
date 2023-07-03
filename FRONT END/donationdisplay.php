<!DOCTYPE>
<html>
    <head>
        <title>DONATION LIST</title>
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
        <h2><span>DONATION DETAILS</span></h2>
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
    
        $sql = "SELECT * FROM donation";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border=1><tr><th>DID</th><th>Donor Name</th><th>Date   </th><th>Amount(in INR)</th><th>Payment Mode</th><th>Contact Number</th><th>Collected by</th></tr>";
            // output data of each row
            while($row =mysqli_fetch_assoc($result)) {
                echo "<tr><td>". $row["DID"]."</td><td>". $row["dname"]."</td><td>". $row["ddate"]."</td><td>". $row["amt"]."</td><td>". $row["paymode"]."</td><td>". $row["contact_no"]."</td><td>". $row["collected_by"]."</td></tr>";
            }
            echo "</table>";
        } else {
        echo "<p>Donation details unavailable</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
    <center><a href="donation.php">BACK</a></center>
    <footer></footer>
</body>
</html>