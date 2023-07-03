<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$EID= "";
$name = "";
$designation = "";
$salary = "";
$dob = "";
$phone = "";
$address = "";
$sex = "";

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
    $posts[0] = $_POST['EID'];
    $posts[1] = $_POST['name'];
    $posts[2] = $_POST['designation'];
    $posts[3] = $_POST['salary'];
    $posts[4] = $_POST['dob'];
    $posts[5] = $_POST['phone'];
    $posts[6] = $_POST['address'];

    return $posts;
}

// Search
if(isset($_POST['search']))
{
    $data = getPosts();
    if(isset($_GET['sex']))
        $data[7] = $_GET['sex'];
    $search_Query = "SELECT * FROM `employee` WHERE EID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $EID = $row['EID'];
                $name = $row['name'];
                $designation = $row['designation'];
                $salary = $row['salary'];
                $dob = $row['dob'];
                $phone = $row['phone'];
                $address = $row['address'];
                $sex = $row['sex'];
            }
        }else{
            echo '<script type="text/javascript"> alert("No employee found for this ID!")</script>';
        }
    }else{
        echo 'Result Error';
    }
}

// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    if(isset($_POST['sex']))
        $data[7] = $_POST['sex'];
    $insert_Query = "INSERT INTO `employee`(`EID`, `name`, `designation`, `salary`, `dob`, `phone`, `address`,`sex`) VALUES ($data[0],'$data[1]','$data[2]',$data[3],'$data[4]',$data[5],'$data[6]','$data[7]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Employee details recorded!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Employee details not recorded!")</script>';
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
    if(isset($_POST['sex']))
        $data[7] = $_POST['sex'];
    $delete_Query = "DELETE FROM `employee` WHERE `EID` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Employee details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Employee details not deleted!")</script>';
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
    if(isset($_POST['sex']))
        $data[7] = $_POST['sex'];
    $update_Query = "UPDATE `employee` SET `name`='$data[1]',`designation`='$data[2]',`salary`=$data[3] ,`dob`='$data[4]',`phone`=$data[5],`address`='$data[6]',`sex`='$data[7]' WHERE `EID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Employee details updated!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Employee details not updated!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<html>
<head>
	<title>Employee entry</title>
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
	<div class="form" style="margin-top:370px; height:600px;">
    <form action="aemployee.php" method="POST">
    
        <h2>EMPLOYEE ENTRY</h2>
        <table>
        <tr>
        <td>EID</td>
        <td><input type="number" name="EID" class="input_field" placeholder="Enter employee ID" value="<?php echo $EID;?>"></td>
        </tr>
        <tr>
        <td>Employee name</td>
        <td><input type="text" name="name" class="input_field" placeholder="Enter name of employee" value="<?php echo $name;?>"></td>
        </tr>
        <tr>
        <td>Designation </td>
        <td><input type="text" name="designation" class="input_field" placeholder="Enter designation of employee" value="<?php echo $designation;?>"></td>
        </tr>
        <tr>
        <td>Salary(per month)</td>
        <td><input type="float" name="salary" class="input_field" placeholder="Enter the salary" value="<?php echo $salary;?>"></td>
        </tr>
        <tr>
        <td>Date of Birth</td>
        <td><input type="date" name="dob" class="input_field" placeholder="Enter the date of birth" value="<?php echo $dob;?>"></td>
        </tr>
        <tr>
        <td>Phone number</td>
        <td><input type="number" name="phone" class="input_field" placeholder="Enter phone number" value="<?php echo $phone;?>"></td>
        </tr>
        <td>Address</td>
        <td><input type="text" name="address" class="input_field" placeholder="Enter the address of employee" value="<?php echo $address;?>"></td>
        </tr>
        <tr>
        <td>Gender</td>
        <td><input type="radio" name="sex" class="input_field" <?php if($sex=="male"){?> checked="true" <?php } ?> value="<?php echo 'male';?>">male
        <input type="radio" name="sex" class="input_field" <?php if($sex=="female"){?> checked="true" <?php } ?> value="<?php echo 'female';?>">female</td>
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
                <center><button class="b1"><a href="employeedisplay.php">View All</a></button></center>
    </form>
    </div>       
    <footer></footer>
</body>
</html>

