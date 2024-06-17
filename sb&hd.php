<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="appointments.php">Appointments</a></li>
                <li><a href="patient.php">Patients</a></li>
                <!-- Staff option with dropdown -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="staffDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Staff</a>
            <div class="dropdown-menu" aria-labelledby="staffDropdown">
            <a class="dropdown-item" href="nurse.php">Nurses</a>
            <a class="dropdown-item" href="doctors.php">Doctors</a>

</li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>