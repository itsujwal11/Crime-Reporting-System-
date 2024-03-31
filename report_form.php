<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define a variable to hold the message
$message = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_type = $_POST["report-type"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $description = $_POST["description"];

    // Image upload
    $image = NULL;
    if (!empty($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
    }

    // Video upload
    $video = NULL;
    if (!empty($_FILES["video"]["tmp_name"]) && is_uploaded_file($_FILES["video"]["tmp_name"])) {
        $video = file_get_contents($_FILES["video"]["tmp_name"]);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO report_crime (report_type, name, phone, address, description, image, video) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssb", $report_type, $name, $phone, $address, $description, $image, $video);

    if ($stmt->execute()) {
        $message = "New record created successfully";
        // JavaScript for SweetAlert notification
        echo '<script>Swal.fire("Success", "Your report has been submitted successfully!", "success");</script>';
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="reporting.css">
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">CRS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="report_form.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Report Crime</span>
                </a></li>
                <li><a href="view_status.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">View Status</span>
                </a></li>
                <li><a href="contact.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Contact us</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="logout">Logout</span>
                </a></li>
                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </ul>
        </div>
    </nav>
    <div class="anonymous-reporting">
        <div class="title">
            <i class="uil uil-thumbs-up"></i>
            <span class="text">Report Your Problem</span>
        </div>
        
        <!-- Display the message -->
        <div id="message"><?php echo $message; ?></div>
        
        <form class="report-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label for="report-type">Type of Incident:</label>
            <select id="report-type" name="report-type">
                <option value="assault">Assault</option>
                <option value="theft">Theft</option>
                <option value="scam">Scam</option>
                <option value="vandalism">Vandalism</option>
            </select>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Phone Number:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" >

            <label for="video">Upload Video:</label>
            <input type="file" id="video" name="video" accept="video/*" >

            <button type="submit">Submit Report</button>
        </form>
    </div>


<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    // Form submission handling with SweetAlert
    document.querySelector('.report-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        Swal.fire({
            title: "Processing...",
            text: "Please wait...",
            icon: "info",
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Perform the form submission
        fetch(this.action, {
            method: this.method,
            body: new FormData(this)
        })
        .then(response => {
            if (response.ok) {
                Swal.fire("Success", "Your report has been submitted successfully!", "success");
                this.reset(); // Clear the form fields
                // You may also redirect to another page or perform any other action here
            } else {
                throw new Error('Network response was not ok.');
            }
        })
        .catch(error => {
            console.error('Error during form submission:', error);
            Swal.fire("Error", "An error occurred while submitting your report. Please try again later.", "error");
        });
    });
</script>


</body>
</html>
