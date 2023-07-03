<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$DID = "";
$dname = "";
$ddate = "";
$amt = "";
$paymode = "";
$contact_no = "";
$collected_by = "";

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
    $posts[0] = $_POST['DID'];
    $posts[1] = $_POST['dname'];
    $posts[2] = $_POST['ddate'];
    $posts[3] = $_POST['amt'];
    $posts[4] = $_POST['paymode'];
    $posts[5] = $_POST['contact_no'];
    $posts[6] = $_POST['collected_by'];
    return $posts;
}

// Search
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `donation` WHERE DID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $DID = $row['DID'];
                $dname = $row['dname'];
                $ddate = $row['ddate'];
                $amt = $row['amt'];
                $paymode = $row['paymode'];
                $contact_no = $row['contact_no'];
                $collected_by = $row['collected_by'];
            }
        }else{
            echo '<script type="text/javascript"> alert("No donation found for this ID!")</script>';
        }
    }else{
        echo 'Result Error';
    }
}

// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `donation` VALUES ($data[0],'$data[1]','$data[2]',$data[3],'$data[4]',$data[5],$data[6])";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Donation details recorded!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Donation details not recorded!")</script>';
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
    $delete_Query = "DELETE FROM `donation` WHERE `DID` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Donation details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Donation details not deleted!")</script>';
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
    $update_Query = "UPDATE `donation` SET `dname`='$data[1]',`ddate`='$data[2]',`amt`=$data[3] ,`paymode`='$data[4]',`contact_no`=$data[5],`collected_by`=$data[6] WHERE `DID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Donation details updated!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Donation details not updated!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<!DOCTYPE>
<html>
    <head>
        <title>DONATION FORM</title>
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
    </div>
    <div class="form" style="height:550px; margin-top:320px;">
    <form action="edon.php" method="POST">
    
        <h2>DONATION ENTRY</h2>
        <table>
        <tr>
        <td>DID</td>
        <td><input type="number" name="DID" class="input_field" placeholder="Enter donation ID" value="<?php echo $DID;?>"></td>
        </tr>
        <tr>
        <td>Donor name</td>
        <td><input type="text" name="dname" class="input_field" placeholder="Enter name of donor" value="<?php echo $dname;?>"></td>
        </tr>
        <tr>
        <td>Date </td>
        <td><input type="date" name="ddate" class="input_field" placeholder="Enter date of donation" value="<?php echo $ddate;?>"></td>
        </tr>
        <tr>
        <td>Donated amount</td>
        <td><input type="float" name="amt" class="input_field" placeholder="Enter the paid amount" value="<?php echo $amt;?>"></td>
        </tr>
        <tr>
        <td>Payment mode</td>
        <td><input type="text" name="paymode" class="input_field" placeholder="Enter the mode of payment" value="<?php echo $paymode;?>"></td>
        </tr>
        <tr>
        <td>Contact number</td>
        <td><input type="number" name="contact_no" class="input_field" placeholder="Enter phone number" value="<?php echo $contact_no;?>"></td>
        </tr>
        <tr>
        <td>Collected by</td>
        <td><input type="number" name="collected_by" class="input_field" placeholder="Enter EID" value="<?php echo $collected_by;?>"></td>
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

                <center><button class="b1"><a href="edonation.php">BACK</a></button></center>
    </form>
    </div>
            
    <footer style="margin-top:570px;"></footer>
</body>
</html>