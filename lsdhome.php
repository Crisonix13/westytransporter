<?php 
session_start();

if(!isset($_SESSION['username']))
{
    header("location:index.php");
}//Add usertypes for later stages(?)
elseif($_SESSION['usertype']=='admin')
{
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSD</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
 	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<header class="header">

<a href="">Westy</a>

<div class="logout">
<a href="logout.php" class="btn btn-primary">Logout</a>
</div>
</header>

<aside>
<ul>
    <li>
        <a href="">Services</a>
        <ul class="dropdown">
            <li><a href="">Applications</a></li>
            <li><a href="">PTT Form</a></li>
            <li><a href="">Manifest</a></li>
            <li><a href="">HW Inventory</a></li>
        </ul>
    </li>
    <li>
        <a href="">Transporter</a>
        <ul class="dropdown">
            <li><a href="">Inventory</a></li>
            <li><a href="">Manifest</a></li>
        </ul>
    </li>
    <li>
        <a href="">TSD Facility</a>
        <ul class="dropdown">
            <li><a href="">Application</a></li>
            <li><a href="">Manifest</a></li>
        </ul>
    </li>
</ul>
</aside>
</body>
</html>