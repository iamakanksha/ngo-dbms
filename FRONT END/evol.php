<!DOCTYPE>
<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$VID = "";
$vname = "";
$qualification = "";
$email = "";
$phno = "";
$addr= "";
$dob = "";
$gender = "";
$guide = "";


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
    $posts[0] = $_POST['VID'];
    $posts[1] = $_POST['vname'];
    $posts[2] = $_POST['qualification'];
    $posts[3] = $_POST['email'];
    $posts[4] = $_POST['phno'];
    $posts[5] = $_POST['addr'];
    $posts[6] = $_POST['dob'];
    $posts[7] = $_POST['guide'];
    return $posts;
}

if(isset($_POST['search']))
{
    $data = getPosts();
    if(isset($_GET['gender']))
        $data[8] = $_GET['gender'];
    $search_Query = "SELECT * FROM `volunteer` WHERE VID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $VID = $row['VID'];
                $vname = $row['vname'];
                $qualification = $row['qualification'];
                $email = $row['email'];
                $phno = $row['phno'];
                $addr = $row['addr'];
                $dob = $row['dob'];
                $guide = $row['guide'];
                $gender = $row['gender'];
            }
        }else{
            echo '<script type="text/javascript"> alert("No volunteer found for this VID!")</script>';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    if(isset($_POST['gender']))
        $data[8] = $_POST['gender'];

    $insert_Query = "INSERT INTO `volunteer`(`VID`, `vname`, `qualification`, `email`, `phno`, `addr`, `dob`,`guide`,`gender`) VALUES ($data[0],'$data[1]','$data[2]','$data[3]',$data[4],'$data[5]','$data[6]',$data[7],'$data[8]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Volunteer details inserted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Volunteer details not inserted!")</script>';
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
    if(isset($_POST['gender']))
        $data[8] = $_POST['gender'];
    $delete_Query = "DELETE FROM `volunteer` WHERE `VID` =$data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Volunteer details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Volunteer details not deleted!")</script>';
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
     if(isset($_POST['gender']))
        $data[8] = $_POST['gender'];
    $update_Query = "UPDATE `volunteer` SET `vname`='$data[1]',`qualification`='$data[2]',`email`='$data[3]' ,`phno`=$data[4],`addr`='$data[5]',`dob`='$data[6]',`guide`=$data[7],`gender`='$data[8]' WHERE `VID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Volunteer details updated!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Volunteer details not updated!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<html>
<head>
    <title>VOLUNTEER FORM</title>
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
</br>
</br>
    <div class="form" style="margin-top:385px; height:640px;">
    <form action="evol.php" method="POST">
    
        <h2>VOLUNTEER ENTRY</h2>
        <table>
        <tr>
        <td>VID</td>
        <td><input type="number" name="VID" class="input_field" placeholder="Enter volunteer ID" value="<?php echo $VID;?>"></td>
        </tr>
        <tr>
        <td>Volunteer name</td>
        <td><input type="text" name="vname" class="input_field" placeholder="Enter name of volunteer" value="<?php echo $vname;?>"></td>
        </tr>
        <tr>
        <td>Qualification </td>
        <td><input type="text" name="qualification" class="input_field" placeholder="Enter qualification of volunteer" value="<?php echo $qualification;?>"></td>
        </tr>
        <tr>
        <td>E-mail</td>
        <td><input type="email" name="email" class="input_field" placeholder="Enter the email address" value="<?php echo $email;?>"></td>
        </tr>
        <tr>
        <td>Phone number</td>
        <td><input type="number" name="phno" class="input_field" placeholder="Enter contact number" value="<?php echo $phno;?>"></td>
        </tr>
        <tr>
        <td>Address</td>
        <td><input type="text" name="addr" class="input_field" placeholder="Enter address of the volunteer" value="<?php echo $addr;?>"></td>
        </tr>
        <tr>
        <td>Date of Birth</td>
        <td><input type="date" name="dob" class="input_field" placeholder="Enter date of birth" value="<?php echo $dob;?>"></td>
        </tr>
        <tr>
        <td>Guide</td>
        <td><input type="number" name="guide" class="input_field" placeholder="Enter EID of the guide" value="<?php echo $guide;?>"></td>
        </tr>
        <tr>
        <td>Gender</td>
        <td><input type="radio" name="gender" class="input_field" <?php if($gender=="male"){?> checked="true" <?php } ?> value="<?php echo 'male';?>">male
        <input type="radio" name="gender" class="input_field" <?php if($gender=="female"){?> checked="true" <?php } ?> value="<?php echo 'female';?>">female</td>
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
                <center><button class="b1"><a href="evolunteer.php">BACK</a></button></center>
    </form>
    </div>           
    <footer style="margin-top:660px;"></footer>
</body>
</html>

