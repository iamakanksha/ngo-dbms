<!DOCTYPE>
<html>
    <head>
        <title>EMPLOYEES LIST</title>
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
    <div align="center">
        <h2><span>EMPLOYEE DETAILS</span></h2>
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
    
        $sql = "SELECT * FROM employee";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border=1><tr><th>EID</th><th>Employee Name</th><th>Designation </th><th>Salary(in INR) </th><th>Date of Birth </th><th>Age </th><th>Gender</th><th>Phone number</th><th>Address</th></tr>";
            // output data of each row
            while($row =mysqli_fetch_assoc($result)) {
                echo "<tr><td>". $row["EID"]."</td><td>". $row["name"]."</td><td>". $row["designation"]."</td><td>". $row["salary"]."</td><td>". $row["dob"]."</td><td>". $row["age"]."</td><td>".$row["sex"]."</td><td>". $row["phone"]."</td><td>". $row["address"]."</td></tr>";
            }
            echo "</table>";
        } else {
        echo "<p>Employee details unavailable</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
    <center><a href="aemployee.php">BACK</a></center>
    <footer></footer>
</body>
</html>