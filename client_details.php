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

if (!$data) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if 'ID' parameter is set in the URL
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $clientID = mysqli_real_escape_string($data, $_GET['ID']);
    
    // SQL query to fetch client details by ID
    $sql = "SELECT  c.*, a.*
    FROM appinfo a LEFT JOIN
    clientdata c ON
    a.company_name = c.ID
    WHERE a.company_name =
    '$clientID'";
    $result = mysqli_query($data, $sql); 

    if ($result) {
        $client = $result->fetch_assoc();
        if (!$client) {
            echo "No client found with the specified ID.";
            exit();
        }
    } else {
        echo "Error executing query: " . mysqli_error($data);
        exit();
    }
} else {
    echo "No client ID specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .details {
            padding: 20px;
        }
        .details .row {
            margin-bottom: 10px;
        }
        .details .col-md-3 {
            font-weight: bold;
        }
        .tabs-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <a href="addappinfo.php" class="btn btn-primary" style="margin-left: 88%; margin-top: auto;">+ Add Details</a>
        <h1>Client Details</h1>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#application-info">Application Info</a></li>
            <li><a data-toggle="tab" href="#pco-details">PCO Details</a></li>
            <li><a data-toggle="tab" href="#facility-info">Facility Info</a></li>
            <li><a data-toggle="tab" href="#haz-waste-profile">Haz Waste Profile</a></li>
        </ul>
        
        <!-- Tab Contents -->
        <div class="tab-content">
            <!-- Application Info -->
            <div id="application-info" class="tab-pane fade in active tabs-content">
                <h3>Application Information</h3>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Company Name:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['name']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Managing Head:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['managing_head']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Generator ID:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['generator_id']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Mobile Number:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['mobile_num']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Telephone Number:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['tel_num']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Nature of Business:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['nature_of_business']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Date Of Establishment:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($client['date_of_establishment']); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PCO Details -->
            <div id="pco-details" class="tab-pane fade tabs-content">
                <h3>PCO Details</h3>
                <div class="details">
                    <div class="row">
                        <div class="col-md-3">PCO Name:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appPCOName']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Mobile Number:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appPCOMobNum']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Telephone Number:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appPCOTelNum']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Email:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appPCOEmail']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Accreditation Number:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appPCOAccredNo']); ?></div>
                    </div>
                </div>
            </div>

            <!-- Facility Info -->
            <div id="facility-info" class="tab-pane fade tabs-content">
                <h3>Facility Information</h3>
                <div class="details">
                    <div class="row">
                        <div class="col-md-3">Address:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appFaciAddress']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Region:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appFaciRegion']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Province:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appFaciProvince']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">City:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appFaciCity']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Barangay:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['appFaciBarangay']); ?></div>
                    </div>
                </div>
            </div>

            <!-- Haz Waste Profile -->
            <div id="haz-waste-profile" class="tab-pane fade tabs-content">
                <h3>Hazardous Waste Profile</h3>
                <div class="details">
                    <div class="row">
                        <div class="col-md-3">Hazardous Waste Type:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['hazWasteType']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Waste Quantity:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['wasteQuantity']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Storage Method:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['storageMethod']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Disposal Method:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['disposalMethod']); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Safety Measures:</div>
                        <div class="col-md-9"><?php echo htmlspecialchars($client['safetyMeasures']); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="client.php" class="btn btn-default">Back to List</a>
    </div>
</body>
</html>
