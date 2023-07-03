<!DOCTYPE>
<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$EvID = "";
$title = "";
$manager = "";
$edate = "";
$stime = "";
$venue= "";
$edescription = "";
$sponsor = "";
$funds= "";
$status= "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['EvID'];
    $posts[1] = $_POST['title'];
    $posts[2] = $_POST['manager'];
    $posts[3] = $_POST['edate'];
    $posts[4] = $_POST['stime'];
    $posts[5] = $_POST['venue'];
    $posts[6] = $_POST['edescription'];
    $posts[7] = $_POST['sponsor'];
    $posts[8] = $_POST['funds'];
    return $posts;
}

if(isset($_POST['search']))
{
	$data = getPosts();
    if(isset($_GET['status']))
        $data[9] = $_GET['status'];
    
    $search_Query = "SELECT * FROM `event` WHERE EvID = $data[0]";
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $EvID = $row['EvID'];
                $title = $row['title'];
                $manager = $row['manager'];
                $edate = $row['edate'];
                $stime = $row['stime'];
                $venue = $row['venue'];
                $edescription = $row['edescription'];
                $sponsor = $row['sponsor'];
                $funds = $row['funds'];
                $status = $row['status'];
            }
        }else{
            echo '<script type="text/javascript"> alert("No event found for this ID!")</script>';
        }
    }else{
        echo 'Result Error';
    }
}

// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    if(isset($_POST['status']))
        $data[9] = $_POST['status'];
    
    $insert_Query = "INSERT INTO `event`(`EvID`, `title`, `manager`, `edate`, `stime`, `venue`, `edescription`,`sponsor`,`funds`,`status`) VALUES ($data[0],'$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]',$data[8],'$data[9]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Event details recorded!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Event details not recorded!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    if(isset($_POST['status']))
        $data[9] = $_POST['status'];
    
    $delete_Query = "DELETE FROM `event` WHERE `EvID` =$data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Event details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Event details not deleted!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    if(isset($_POST['status']))
        $data[9] = $_POST['status'];
    
    $update_Query = "UPDATE `event` SET `title`='$data[1]',`manager`='$data[2]',`edate`='$data[3]' ,`stime`='$data[4]',`venue`='$data[5]',`edescription`='$data[6]',`sponsor`='$data[7]',`funds`=$data[8],`status`='$data[9]' WHERE `EvID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Event details updated!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Event details not updated!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<html>
<head>
	<title>Events entry</title>
	<link rel="stylesheet" type="text/css" href="dashboardform.css">
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
    <br>
    <br>
	<div class="form" style="margin-top:420px; height:690px;">
    <form action="aevent.php" method="POST">
        <h2>EVENT ENTRY</h2>
        <table>
        <tr>
        <td>Event ID</td>
        <td><input type="number" name="EvID" class="input_field" placeholder="Enter event ID" value="<?php echo $EvID;?>"></td>
        </tr>
        <tr>
        <td>Event title</td>
        <td><input type="text" name="title" class="input_field" placeholder="Enter title of the event" value="<?php echo $title;?>"></td>
        </tr>
        <tr>
        <td>Manager </td>
        <td><input type="number" name="manager" class="input_field" placeholder="Enter EID of manager" value="<?php echo $manager;?>"></td>
        </tr>
        <tr>
        <td>Event date</td>
        <td><input type="date" name="edate" class="input_field" placeholder="Enter the event date" value="<?php echo $edate;?>"></td>
        </tr>
        <tr>
        <td>Start time</td>
        <td><input type="time" name="stime" class="input_field" placeholder="Enter start time" value="<?php echo $stime;?>"></td>
        </tr>
        <tr>
        <td>Venue</td>
        <td><input type="text" name="venue" class="input_field" placeholder="Enter venue details" value="<?php echo $venue;?>"></td>
        </tr>
        <tr>
        <td>Event Description</td>
        <td><input type="text" name="edescription" class="input_field" placeholder="Enter event description" value="<?php echo $edescription;?>"></td>
        </tr>
        <td>Sponsor</td>
        <td><input type="text" name="sponsor" class="input_field" placeholder="Enter the event sponsor" value="<?php echo $sponsor;?>"></td>
        </tr>
        <tr>
        <td>Funds Raised(in INR)</td>
        <td><input type="float" name="funds" class="input_field" placeholder="Enter the funds raised" value="<?php echo $funds;?>"></td>
        </tr>
        <tr>
        <td>Status</td>
        <td><input type="radio" name="status" class="input_field" <?php if($status=="pending"){?> checked="true" <?php } ?> value="<?php echo 'pending';?>">pending
        <input type="radio" name="status" class="input_field" <?php if($status=="complete"){?> checked="true" <?php } ?> value="<?php echo 'complete';?>">complete</td>
        </tr>
    </table>
    <br>
        		<!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" name="search" value="Find">

                <!-- Input For Find Values With The given ID -->
                <center><button class="b1"><a href="eventdisplay.php">View All</a></button></center>
    </form>
    </div>
            
    <footer style="margin-top:700px;"></footer>
</body>
</html>

