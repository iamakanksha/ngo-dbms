<!DOCTYPE>
<html>
    <head>
        <title>VOLUNTEER LIST</title>
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
    </div>
    <div class='wrapper' align='center'>
        <div class="form">
        <form action="einvolvesdisplay.php" method="POST">
        <input type="number" name="EvID" class="input_field" placeholder="Enter event ID" value="<?php echo $EvID;?>">
        <input type="submit" name="Search" value="Search" >
        </form>
    </div>
        <?php
        flush();
        ob_flush();
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
        function getPosts()
        {
            $posts = array();
            $posts[0] = $_POST['EvID'];
            return $posts;
        }

        if(isset($_POST['Search']))
        {
            $data = getPosts();
            $sql = "SELECT i.VID, v.vname,v.phno from volunteer v, involves i where i.EvID=$data[0] and i.VID=v.VID";
            $result = mysqli_query($conn,$sql);

        if(!$result)
            echo "<p>details unavailable</p>";
        else{
        if (mysqli_num_rows($result) > 0) {
            echo "<h2><span>VOLUNTEER LIST</span></h2>";
            echo "<table border=1><tr><th>VID</th><th>Volunteer Name</th><th>Contact number </th></tr>";
            // output data of each row
            while($row =mysqli_fetch_assoc($result)) {
                echo "<tr><td>". $row["VID"]."</td><td>". $row["vname"]."</td><td>".$row["phno"]."</td></tr>";
            }
            echo "</table>";
        } else {
        echo "<p>Either the Event ID is invalid or No volunteers have been assigned for this event</p>";
        }
        }
        }
        mysqli_close($conn);

        ?>
    </div>
    <center><a href="einvolves.php">BACK</a></center>
    <footer></footer>
</body>
</html>