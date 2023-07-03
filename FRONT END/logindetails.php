<!DOCTYPE>
<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "ngo";
$EID = "";
$username = "";
$password = "";
$access_per= "";

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
    $posts[1] = $_POST['username'];
    $posts[2] = $_POST['password'];
    return $posts;
}

if(isset($_POST['search']))
{
	$data = getPosts();
    if(isset($_GET['access_per']))
        $data[3] = $_GET['access_per'];
    
    $search_Query = "SELECT * FROM `login` WHERE EID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $EID = $row['EID'];
                $username = $row['username'];
                $password = $row['password'];
                $access_per = $row['access_per'];
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
    if(isset($_POST['access_per']))
        $data[3] = $_POST['access_per'];
    
    $insert_Query = "INSERT INTO `login`(`EID`, `username`, `password`, `access_per`) VALUES ($data[0],'$data[1]','$data[2]','$data[3]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Login details recorded!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Login details not recorded!")</script>';
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
    if(isset($_POST['access_per']))
        $data[3] = $_POST['access_per'];
    
    $delete_Query = "DELETE FROM `login` WHERE `EID` =$data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {

            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Login details deleted!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Login details not deleted!")</script>';
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
    if(isset($_POST['access_per']))
        $data[3] = $_POST['access_per'];

    $update_Query = "UPDATE `login` SET `username`='$data[1]',`password`='$data[2]',`access_per`='$data[3]' WHERE `EID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo '<script type="text/javascript"> alert("Login details modified!")</script>';
            }else{
                echo '<script type="text/javascript"> alert("Login details not modified!")</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>

<html>
<head>
	<title>Login Details</title>
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
		<button><a href="donation.php">DONATION</a></button>
		<button><a href="loginpage.php">LOGOUT</a></button>
		</nav>
	</div>
	<center><img src="logo.png" alt="Logo" height=200px width=150px/></center>
<br>
<br>
	<div class="form" style="margin-top:290px; height:450px;">
    <form action="logindetails.php" method="POST">
    
        <h2>LOGIN ENTRY</h2>
        <table>
        <tr>
        <td>Employee ID</td>
        <td><input type="number" name="EID" class="input_field" placeholder="Enter employee ID" value="<?php echo $EID;?>"></td>
        </tr>
        <tr>
        <td>Username </td>
        <td><input type="text" name="username" class="input_field" placeholder="Enter username of the employee" value="<?php echo $username;?>"></td>
        </tr>
        <tr>
        <td>Password </td>
        <td><input type="text" name="password" class="input_field" placeholder="Enter password of employee" value="<?php echo $password;?>"></td>
        </tr>
        <tr>
        <td>Access permission</td>
        <td><input type="radio" name="access_per" class="input_field" <?php if($access_per=="non-admin"){?> checked="true" <?php } ?> value="<?php echo 'non-admin';?>">non-admin
        <input type="radio" name="access_per" class="input_field" <?php if($access_per=="admin"){?> checked="true" <?php } ?> value="<?php echo 'admin';?>">admin</td>
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

                <center><button class="b1"><a href="logindisplay.php">View All</a></button></center>
    </form>
    </div>            
</body>
<footer style="margin-top:450px"></footer>
</html>

