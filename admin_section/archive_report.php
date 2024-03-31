<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Reports</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="admin_prac.css">
    <style>
        /* Your additional CSS styles here */
      
            .logout-mode {
                list-style-type: none;
                padding: auto;
                margin: 5px;
                margin-top: 180%;
            }

            .logout-mode li {
                display: inline-block;
                margin-right: 10px;
            }

            .logout-mode li a {
                text-decoration: none;
                color: white;
                font-weight: bold;
                padding: 8px 16px;
                border: 1px solid white;
                border-radius: 5px;
                transition: all 0.3s;
            }

            .logout-mode li a:hover {
                background-color: red;
                color: #fff;
            }
        
        .toggle-actions-btn {
            display: flex;
            gap: 5px;
        }

        .toggle-actions-btn button {
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .toggle-actions-btn button:hover {
            background-color: #ddd;
        }

        .toggle-actions-btn .toggle-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .toggle-actions-btn .solve-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .toggle-actions-btn .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
        </header>
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined"></span> CRS ADMIN
                </div>
            </div>
            <ul  class="sidebar-list">
            <a href="admin_dashboard.php">
                <li class="sidebar-list-item">
                 
                        <span class="material-icons-outlined">dashboard</span> Dashboard
                    </a>
                </li>
                <li class="sidebar-list-item">
                <a href="admin_prac.php" >
                    <span class="material-icons-outlined">groups</span> List of Reports
                </a>
            </li>
                <ul class="logout-mode">
                    <li><a href="../logout.php">
                        <span class="logout">Logout</span>
                    </a></li>
                </ul>
            </ul>
        </aside>

        <div class="main-content">
            <div class="header">
                <h1>Archived Reports</h1>
            </div>
            <div class="container">
                <h2>Archived Reports Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Submission Date</th>
                            <th>Report Type</th>
                            <th>Address</th>
                            <th>Restore</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                         // Database connection
                         $servername = "localhost";
                         $username = "root";
                         $password = "";
                         $database = "login";
                         $conn = new mysqli($servername, $username, $password, $database);
                         if ($conn->connect_error) {
                             die("Connection failed: " . $conn->connect_error);
                         }
                    $sql = "SELECT * FROM archived_reports";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Display each row of data in table rows
                                echo "<tr>";
                                // Add columns for archived reports
                                echo "<td>" . $row['submission_date'] . "</td>";
                                echo "<td>" . $row['report_type'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                // Add other columns as needed
                                // Add restore and delete buttons
                                echo "<td><button class='restore-btn'><span class='material-icons-outlined'>restore</span></button></td>";
                               
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No archived reports found.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
