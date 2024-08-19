<?php
error_reporting(0); 
session_start();

if (!isset($_SESSION['username'])) {
    header("location:index.php");
} elseif ($_SESSION['usertype'] == 'LSD') {
    header("location:index.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "westyproject";

$data = mysqli_connect($host, $user, $password, $db);

// Handle search query
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($data, $_POST['search']);
    $searchQuery = " WHERE name LIKE '%$searchTerm%' OR address LIKE '%$searchTerm%'"; 
}

$sql = "SELECT * FROM clientdata" . $searchQuery;
$result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style type="text/css">
        .table_th {
            padding: 15px;
            font-size: 15px;
        }
        .table_td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <a href="newman.php" class="btn btn-primary" style="margin-left: 88%; margin-top: auto;">+ New Manifest</a>

        <!-- Search Bar Form -->
        <form method="post" action="" class="form-inline" style="margin-top: 20px;">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>

        <h1>List of Clients</h1>

        <?php 
        if ($_SESSION['message']) {
            echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
        ?>

        <table border="1px">
            <tr>
                <th class="table_th">Application #</th>
                <th class="table_th">Company</th>
                <th class="table_th">Reference Code</th>
                <th class="table_th">Approved Date</th>
                <th class="table_th">Expiry Date</th>
                <th class="table_th">Actions</th>
            </tr>

            <?php
            while ($info = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="table_td"><?php echo "{$info['name']}"; ?></td>
                <td class="table_td"><?php echo "{$info['address']}"; ?></td>
                <td class="table_td"><?php echo "{$info['typeof_establishment']}"; ?></td>
                <td class="table_td"><?php echo "{$info['contact_person']}"; ?></td>
                <td class="table_td"><?php echo "{$info['date_approved']}"; ?></td>
                <td class="table_td">
    <div class="btn-group">
        <a href="edit.php?ID=<?php echo $info['ID']; ?>" class="btn btn-primary btn-sm">Manage Manifest</a>
    </div>
</td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
