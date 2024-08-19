<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'LSD') {
    header("location:index.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "westyproject";

// Create connection
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle search query
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($data, $_POST['search']);
    $searchQuery = " WHERE app_num LIKE '%$searchTerm%' OR company LIKE '%$searchTerm%'";
}

// Fetch company names
$sqlCompanies = "SELECT company FROM appdata";
$resultCompanies = mysqli_query($data, $sqlCompanies);

$companies = [];
if ($resultCompanies) {
    while ($row = mysqli_fetch_assoc($resultCompanies)) {
        $companies[] = $row['company'];
    }
}

// Fetch data based on search query
$sqlData = "SELECT * FROM appdata" . $searchQuery;
$resultData = mysqli_query($data, $sqlData);

mysqli_close($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .table_th {
            padding: 15px;
            font-size: 15px;
            text-align: center;
            background-color: #f2f2f2;
        }
        .table_td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .btn-group .btn {
            margin: 5px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <?php 
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info" role="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <table>
            <tr>
                <th class="table_th">
                    <a href="previous_step.php?ID=<?php echo $info['ID']; ?>" class="btn btn-default">Previous</a>
                </th>
                <th class="table_th">Step 1 Choose a Generator</th>
                <th class="table_th">Step 2 Select Waste</th>
                <th class="table_th">Step 3 Choose a Transport</th>
                <th class="table_th">Step 4 Choose a TSD Facility</th>
                <th class="table_th">Step 5 Upload Required Documents</th>
                <th class="table_th">
                    <a href="next_step.php?ID=<?php echo $info['ID']; ?>" class="btn btn-default">Next</a>
                </th>
            </tr>
            <?php while ($info = $resultData->fetch_assoc()) { ?>
            <?php } ?>
        </table>

        <table>
            <h4>General Information</h4>
            <label for="exampleDataList" class="form-label">Company Name</label>
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="">
            <datalist id="datalistOptions"></datalist>
        </table>
    </div>

    <script>
        async function loadCompanies() {
            try {
                const response = await fetch('fetch_companies.php'); // Ensure this path is correct
                const companies = await response.json();

                const datalist = document.getElementById('datalistOptions');
                datalist.innerHTML = '';

                companies.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company;
                    datalist.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching companies:', error);
            }
        }

        window.onload = loadCompanies;
    </script>
</body>
</html>
