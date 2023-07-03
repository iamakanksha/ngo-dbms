<!DOCTYPE>
<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$BID = "";
$bname = "";
$prob = "";
$contactno = "";
$tracker = "";

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
    $posts[0] = $_POST['BID'];
    $posts[1] = $_POST['bname'];
    $posts[2] = $_POST['prob'];
    $posts[3] = $_POST['contactno'];
    $posts[4] = $_POST['tracker'];
    return $posts;
}

if(isset($_POST['search']))
{
	$data = getPosts();
    
    $search_Query = "SELECT * FROM `beneficiary` WHERE BID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $BID = $row['BID'];
                $bname = $row['bname'];
                $prob = $row['prob'];
                $contactno = $row['contactno'];
                $tracker = $row['tracker'];
            }
        }else{
            echo '<script type="text/javascript"> alert("No beneficiary found for this ID!")</script>';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `beneficiary`(`BID`, `bname`, `prob`, `contactno`, `tracker`) VALUES ($data[0],'$data[1]','$data[2]','$data[3]',$data[4])";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Beneficiary details recorded!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Beneficiary details not recorded!")</script>';
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
    $delete_Query = "DELETE FROM `beneficiary` WHERE `BID` =$data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Beneficiary details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Beneficiary details not deleted!")</script>';
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
    $update_Query = "UPDATE `beneficiary` SET `bname`='$data[1]',`prob`='$data[2]',`contactno`='$data[3]' ,`tracker`=$data[4] WHERE `BID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Beneficiary details updated!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Beneficiary details not updated!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<html>
<head>
	<title>Beneficiaries</title>
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
	<div class="form" style="height:480px; margin-top:310px;">
    <form action="abeneficiary.php" method="POST">
    
        <h2>BENEFICIARY ENTRY</h2>
        <table>
        <tr>
        <td>Beneficiary ID</td>
        <td><input type="number" name="BID" class="input_field" placeholder="Enter beneficiary ID" value="<?php echo $BID;?>"></td>
        </tr>
        <tr>
        <td>Beneficiary name</td>
        <td><input type="text" name="bname" class="input_field" placeholder="Enter name of beneficiary" value="<?php echo $bname;?>"></td>
        </tr>
        <tr>
        <td>Problem(s) faced </td>
        <td><input type="text" name="prob" class="input_field" placeholder="Enter the problem faced by the beneficiary" value="<?php echo $prob;?>"></td>
        </tr>
        <tr>
        <td>Contact Number</td>
        <td><input type="text" name="contactno" class="input_field" placeholder="Enter any relevant contact number" value="<?php echo $contactno;?>"></td>
        </tr>
        <tr>
        <td>Tracker</td>
        <td><input type="number" name="tracker" class="input_field" placeholder="Enter EID of the tracker" value="<?php echo $tracker;?>"></td></tr>
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
                <center><button class="b1"><a href="beneficiarydisplay.php">View All</a></button></center>
    </form>
    </div>
            
    <footer style="margin-top:500px;"></footer>
</body>
</html>

