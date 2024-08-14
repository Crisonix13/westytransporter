<?php 
session_start();

if(!isset($_SESSION['username']) || $_SESSION['usertype'] == 'LSD') {
    header("location:index.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "westyproject";

$data = mysqli_connect($host, $user, $password, $db);

$ID = $_GET['ID'];

$sql = "SELECT * FROM clientdata WHERE id='$ID'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();

if(isset($_POST['update'])) {
    $cliName=$_POST['name'];
    $cliAddress=$_POST['address'];
    $cliType=$_POST['typeof_establishment'];
    $cliContactPerson=$_POST['contact_person'];
    $cliContactNum=$_POST['contact_number'];
    $cliCRS=$_POST['crsid'];
    $cliHW=$_POST['hwid'];
    $clidt = isset($_POST['date_approved']) ? $_POST['date_approved'] : '';

    $query = "UPDATE clientdata SET name='$cliName', 
    address='$cliAddress', 
    typeof_establishment='$cliType', 
    contact_person='$cliContactPerson', 
    contact_number='$cliContactNum', 
    crs_id='$cliCRS', 
    hw_id='$cliHW', 
    date_approved='$clidt' 
    WHERE id='$ID'";

    $result2 = mysqli_query($data, $query);

    if($result2) {
        header("location:client.php");
     } 
}
?>

<style type="text/css">
    label {
        display: inline-block;
        width: 100px;
        text-align: right;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .div_deg {
        background-color: lightgreen;
        width: 400px;
        padding-bottom: 70px;
        padding-top: 70px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <center>
            <h1>Update Page</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo isset($info['name']) ? $info['name'] : ''; ?>">
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" name="address" value="<?php echo isset($info['address']) ? $info['address'] : ''; ?>">
                    </div>
                    <div>
                        <label>Type of Establishment</label>
                        <input type="text" name="typeof_establishment" value="<?php echo isset($info['typeof_establishment']) ? $info['typeof_establishment'] : ''; ?>">
                    </div>
                    <div>
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" value="<?php echo isset($info['contact_person']) ? $info['contact_person'] : ''; ?>">
                    </div>
                    <div>
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" value="<?php echo isset($info['contact_number']) ? $info['contact_number'] : ''; ?>">
                    </div>
                    <div>
                        <label>CRS ID</label>
                        <input type="text" name="crsid" value="<?php echo isset($info['crsid']) ? $info['crsid'] : ''; ?>">
                    </div>
                    <div>
                        <label>HW ID</label>
                        <input type="text" name="hwid" value="<?php echo isset($info['hwid']) ? $info['hwid'] : ''; ?>">
                    </div>
                    <div>
                        <label for="date-approved">Date Approved</label>
                        <input type="datetime-local" name="date_approved" id="date-approved" value="<?php echo isset($info['date_approved']) ? $info['date_approved'] : ''; ?>">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="update" value="Update">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
