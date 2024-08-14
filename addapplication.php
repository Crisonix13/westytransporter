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

if(isset($_POST['appdata']))
{
    $appnum=$_POST['app_num'];
    $appcompany=$_POST['company'];
    $apptype=$_POST['type'];
    $appstatus=$_POST['status'];
    $appcurproc=$_POST['cur_proc'];
    $appremarks=$_POST['remarks'];
    $appdt=$_POST['date_sub'];
    $appact=$_POST['action'];

    $check = "SELECT * FROM appdata WHERE app_num = '$appnum'";

    $check_appdata=mysqli_query($data, $check);

    $row_count=mysqli_num_rows($check_appdata);

    if($row_count == 1) 
    {
        echo "Application Already Exists.";
    }
    else
    {
    $sql="INSERT INTO appdata(
    app_num,company,type,status,cur_proc,remarks,date_sub,action) 
    VALUES('$appnum','$appcompany','$apptype','$appstatus','$appcurproc','$appremarks','$appdt','$appact')";

    $result=mysqli_query($data,$sql);

    if($result)
    {
        echo " <script type='text/javascript'>
        alert('Application Successfully Added');
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
                    <label>Application #</label>
                    <input type="number" name="app_num">
                </div>
                <div>
                    <label>Company</label>
                    <input type="text" name="company">
                </div>
                <div>
                    <label>Type</label>
                    <input type="text" name="type">
                </div>
                <div>
                    <label>Status</label>
                    <input type="text" name="status">
                </div>
                <div>
                    <label>Currently Processing</label>
                    <input type="text" name="cur_proc">
                </div>
                <div>
                    <label>Remarks</label>
                    <input type="text" name="remarks">
                </div>
                <div>   
                    <label for="date-submitted">Date Submitted</label>
                    <input type="datetime-local" id="date-approved" name="date_sub">
                </div>
                <div>
                    <label>Actions</label>
                    <input type="text" name="action">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="appdata" value="Submit">
                </div>
            </form>
        </div>
        </center>
    </div>
</body>
</html> 