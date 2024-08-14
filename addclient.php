<?php 
session_start();

if(!isset($_SESSION['username']))
{
    header("location:index.php");
}
elseif($_SESSION['usertype']=='LSD')
{
    header("location:index.php");
}

$host="localhost";
$user="root";
$password="";
$db="westyproject";

$data=mysqli_connect($host,$user,$password,$db);

if(isset($_POST['addclient']))
{
    $cliName=$_POST['name'];
    $cliAddress=$_POST['address'];
    $cliType=$_POST['toe'];
    $cliContactPerson=$_POST['contactperson'];
    $cliContactNum=$_POST['contactnumber'];
    $cliCRS=$_POST['crsid'];
    $cliHW=$_POST['hwid'];
    $clidt=$_POST['date-approved'];

    $check = "SELECT * FROM clientdata WHERE name = '$cliName'";

    $check_clientdata=mysqli_query($data, $check);

    $row_count=mysqli_num_rows($check_clientdata);

    if($row_count == 1)
    {
        echo "Client Already Exists.";
    }
    else
    {
    $sql="INSERT INTO clientdata(
    name,address,typeof_establishment,contact_person,contact_number,crs_id,hw_id,date_approved) 
    VALUES('$cliName','$cliAddress','$cliType','$cliContactPerson','$cliContactNum','$cliCRS','$cliHW','$clidt')";

    $result=mysqli_query($data,$sql);

    if($result)
    {
        echo " <script type='text/javascript'>
        alert('Client Successfully Added');
        </script> ";
    }
    else
    {
        echo "failed";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style type="text/css">
        label
        {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg
        {
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;

        }
    </style>
    <link rel="stylesheet" type="text/css" href="admin.css">
 	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
     
    include 'admin_sidebar.php'

    ?>
    
    <div class="content">
        <center>
        <h1>Add Clients</h1>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label>Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" name="address">
                </div>
                <div>
                    <label>Type of Establishment</label>
                    <input type="text" name="toe">
                </div>
                <div>
                    <label>Contact Person</label>
                    <input type="text" name="contactperson">
                </div>
                <div>
                    <label>Contact Number</label>
                    <input type="text" name="contactnumber">
                </div>
                <div>
                    <label>CRS ID</label>
                    <input type="text" name="crsid">
                </div>
                <div>   
                    <label>HW ID</label>
                    <input type="text" name="hwid">
                </div>
                <div>
                    <label for="date-approved">Date Approved</label>
                    <input type="datetime-local" id="date-approved" name="date-approved">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="addclient" value="Submit">
                </div>
            </form>
        </div>
        </center>
    </div>
</body>
</html> 