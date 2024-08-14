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
$db = "westyproject"; // Changed to the correct database name

// Create connection
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch company names
$sql = "SELECT company FROM appdata"; // Adjust the query if necessary
$result = mysqli_query($data, $sql);

$companies = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $companies[] = $row['company'];
    }
}

mysqli_close($data);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($companies);

// Handle search query
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($data, $_POST['search']);
    $searchQuery = " WHERE app_num LIKE '%$searchTerm%' OR company LIKE '%$searchTerm%'"; 
}

$sql = "SELECT * FROM appdata" . $searchQuery;
$result = mysqli_query($data, $sql);
?>

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
    <style type="text/css">
        .table_th {
            padding: 15px;
            font-size: 15px;
            text-align: center;
            background-color: #f2f2f2; /* Background color for header */
        }
        .table_td {
            padding: 10px;
            text-align: center;
            vertical-align: middle; /* Center align vertically */
        }
        .btn-group {
            display: flex;
            flex-wrap: wrap; /* Wrap buttons if they overflow */
            justify-content: center;
            gap: 10px; /* Space between buttons */
        }
        .btn-group .btn {
            margin: 5px; /* Space around each button */
        }
        .content {
            margin-left: 250px; /* Adjust according to your sidebar width */
            padding: 20px;
        }
        table {
            width: 100%; /* Make table full-width */
            border-collapse: collapse; /* Collapse borders */
        }
        table, th, td {
            border: 1px solid #ddd; /* Light border color */
        }
        h1 {
            text-align: center; /* Center-align the header */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <?php 
        if ($_SESSION['message']) {
            echo '<div class="alert alert-info" role="alert">' . $_SESSION['message'] . '</div>';
        }
        unset($_SESSION['message']);
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
            <?php while ($info = $result->fetch_assoc()) { ?>
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
                const response = await fetch('fetch_companies.php'); // Path to the PHP script
                const companies = await response.json();

                const datalist = document.getElementById('datalistOptions');
                datalist.innerHTML = ''; // Clear existing options

                companies.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company;
                    datalist.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching companies:', error);
            }
        }

        window.onload = loadCompanies; // Load companies when the page loads
    </script>
</body>
</html>

