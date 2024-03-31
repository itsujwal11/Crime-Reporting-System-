

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="admin_prac.css">
    <style>
      
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
            <li class="sidebar-list-item">
                    <a href="archive_report.php">
                        <span class="material-icons-outlined">archive</span> Archived Reports
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
                <h1>Dashboard</h1>
            </div>
            <div class="container">
                <h2>Reported Crimes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Submission Date</th>
                            <th>Report Type</th>
                            <th>Address</th>
                            <th>View More</th>
                            <th>Verified</th>
                            <th>Actions</th>
                            <th>Solved Cases</th>
                            <th>Archive</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // PHP code to fetch and display reported crimes will go here
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

                        // Fetch reported crimes data
                        $sql = "SELECT *, (SELECT COUNT(*) FROM report_crime AS rc2 WHERE rc2.status = 'Solved' AND rc2.id = report_crime.id) AS solved_cases FROM report_crime";
                        $result = $conn->query($sql);

                        // Display data in the table
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['submission_date'] . "</td>";
                                echo "<td>" . $row['report_type'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";

                                  // View More button
                                  echo "<td>";
                                  echo "<button class='view-more-btn' data-id='" . $row['id'] . "'>View More</button>";
                                  echo "</td>";
                                echo "<td>" . $row['verified'] . "</td>"; // Display verified status
                                
                                
                                // Actions column
                                echo "<td class='toggle-actions-btn'>";
                                echo "<form method='post' action='toggle_verification.php' onsubmit='showAlert(\"Verification status toggled successfully\")'>
                                            <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                            <button class='toggle-btn' type='submit' name='toggle_btn'><span class='material-icons-outlined'>sync_alt</span></button>
                                        </form>";
                                echo "<form method='post' action='update_status.php'>
                                            <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                            <button class='solve-btn' type='submit' name='action' value='solve'><span class='material-icons-outlined'>done</span></button>
                                        </form>";
                                echo "</td>";
                                
                                echo "<td>" . $row['solved_cases'] . "</td>"; // Display the number of solved cases
                                
                        
                                // Archive button
                                echo "<td>
                                <form method='post' action='archive_process.php' onsubmit='return confirm(\"Are you sure you want to archive this report?\")'>
                                    <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                    <button class='archive-btn' type='submit' name='archive_btn'><span class='material-icons-outlined'>archive</span></button>
                                </form>
                            </td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No reported crimes found.</td></tr>";
                        }

                        // Close database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="../js/script.js"></script>

    
    
</body>
</html>
