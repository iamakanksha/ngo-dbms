<!DOCTYPE>
<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$EvID = "";
$VID = "";

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
    $posts[1] = $_POST['VID'];
    return $posts;
}

// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `involves`(`EvID`, `VID`) VALUES ($data[0],$data[1])";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Volunteer has been successfully assigned!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Volunteer has not been assigned!")</script>';
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
    $delete_Query = "DELETE FROM `involves` WHERE `EvID` =$data[0] and `VID`=$data[1]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Volunteer has been successfully removed!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Volunteer has not removed!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
?>

<html>
<head>
	<title>Assigning volunteer</title>
	<link rel="stylesheet" type="text/css" href="empform.css">
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
	<div class="form" style="height:320px; margin-top:200px;">
    <form action="einvolves.php" method="POST">    
        <h2>ASSIGNING VOLUNTEER</h2>
        <table>
        <tr>
        <td>Event ID</td>
        <td><input type="number" name="EvID" class="input_field" placeholder="Enter event ID" value="<?php echo $EvID;?>"></td>
        </tr>
        <tr>
        <td>Volunteer ID</td>
        <td><input type="number" name="VID" class="input_field" placeholder="Enter volunteer ID" value="<?php echo $VID;?>"></td>
        </tr>
    </table>
    <br>
        		<!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <button class="b1"><a href="einvolvesdisplay.php">View List</a></button>
    </form>
    </div>    
    <footer style="margin-top:350px;"></footer>
</body>
</html>

