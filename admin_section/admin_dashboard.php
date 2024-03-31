<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/admin1.css">
</head>
<body>
<div class="grid-container">
    <!-- Header -->

        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>
       
     
  

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="sidebar-title">
            <div class="sidebar-brand">
                <span class="material-icons-outlined"></span> CRS ADMIN
            </div>
        </div>

        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <a href="#" >
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </a>
            </li>
            <li class="sidebar-list-item">
    <a href="admin_prac.php">
        <span class="material-icons-outlined">groups</span> 
        <span>List of Reports</span>
    </a>
</li>
<li class="sidebar-list-item">
                    <a href="archive_report.php">
                        <span class="material-icons-outlined">archive</span> Archived Reports
                    </a>
                </li>
         
           
        </ul>
        <ul class="logout-mode">
                <li><a href="../logout.php">
             
                    <span class="logout">Logout</span>
                </a></li>

    </aside>
<style>
/* CSS for logout link */
.logout-mode {
    list-style-type: none;
    padding: auto;
margin: 5px;
margin-top: 155%;
}

.logout-mode li {
    display: inline-block;
    margin-right: 10px;
}

.logout-mode li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 8px 16px; /* Adjust padding as needed */
    border: 1px solid white; /* Border style */
    border-radius: 5px; /* Rounded corners */
    transition: all 0.3s; /* Smooth transition */
}

.logout-mode li a:hover {
    background-color: red; /* Background color on hover */
    color: #fff; /* Text color on hover */
}


</style>

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">
            <div class="card">
                <div class="card-inner">
                    <h3>TOTAL CASES REPORTED</h3>
                    <span class="material-icons-outlined">reports</span>
                </div>
                <h1 id="total-cases"></h1>
            </div>
            <div class="card">
                <div class="card-inner">
                    <h3>PENDING CASES</h3>
                    <span class="material-icons-outlined">pending</span>
                </div>
                <h1 id="pending-cases"></h1>
            </div>
            <div class="card">
                <div class="card-inner">
                    <h3>SOLVED CASES</h3>
                    <span class="material-icons-outlined">done</span>
                </div>
                <h1 id="solved-cases"></h1>
            </div>
            <!-- Other cards here -->
        </div>

        <div class="charts">
            <div class="charts-card">
                <h2 class="chart-title">Cases This month</h2>
                <div id="bar-chart"></div>
            </div>
            <div class="charts-card">
                <h2 class="chart-title">Graph of cases</h2>
                <div id="area-chart"></div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<!-- Custom JS -->
<script src="../js/dash_scripts.js"></script>
</body>
</html>
