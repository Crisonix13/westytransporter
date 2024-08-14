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
$host = "localhost";
$user = "root";
$password = "";
$db = "westyproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['addappinfo'])) {
    // Get form inputs
    $companyName = mysqli_real_escape_string($data, $_POST['company_name']);
    $managingHead = mysqli_real_escape_string($data, $_POST['managing_head']);
    $generatorID = mysqli_real_escape_string($data, $_POST['generator_id']);
    $mobileNumber = mysqli_real_escape_string($data, $_POST['mobile_num']);
    $telephoneNumber = mysqli_real_escape_string($data, $_POST['tel_num']);
    $natureOfBusiness = mysqli_real_escape_string($data, $_POST['nature_of_business']);
    $dateOfEstablishment = mysqli_real_escape_string($data, $_POST['date_of_establishment']);
    $numberOfEmployees = mysqli_real_escape_string($data, $_POST['number_of_employees']);


    // Insert into clientdata
    $insertClientQuery = "INSERT INTO appinfo (company_name, managing_head, generator_id, mobile_num, tel_num, nature_of_business, date_of_establishment, number_of_employees) 
                          VALUES ('$companyName', '$managingHead', '$generatorID', '$mobileNumber', '$telephoneNumber', '$natureOfBusiness', '$dateOfEstablishment', '$numberOfEmployees')";

    if (mysqli_query($data, $insertClientQuery)) {
        echo "<script type='text/javascript'>
        alert('Client Successfully Added');
        window.location.href = 'client.php'; // Redirect to client list
        </script>";
    } else {
        echo "Failed to add client.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 200px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .form-container {
            background-color: skyblue;
            width: 500px;
            padding: 30px;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 10px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <center>
            <h1>Add Client</h1>
            <div class="form-container">
                <form action="#" method="POST">
                    <div>
                        <label>Company Name</label>
                        <input type="text" name="company_name" required>
                    </div>
                    <div>
                        <label>Managing Head</label>
                        <input type="text" name="managing_head" required>
                    </div>
                    <div>
                        <label>Generator ID</label>
                        <input type="text" name="generator_id" required>
                    </div>
                    <div>
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_number" required>
                    </div>
                    <div>
                        <label>Telephone Number</label>
                        <input type="text" name="telephone_number" required>
                    </div>
                    <div>
                        <label>Nature of Business</label>
                        <input type="text" name="nature_of_business" required>
                    </div>
                    <div>
                        <label>Date Of Establishment</label>
                        <input type="datetime-local" name="date_of_establishment" required>
                    </div>
                    <div>
                        <label>No. of Employees</label>
                        <input type="number" name="number_of_employees" required>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="addappinfo" value="Submit">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
