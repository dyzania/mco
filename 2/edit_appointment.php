<?php
include 'config.php';

// Get the appointment ID from the URL parameter
$appointment_id = $_GET['id'];

// Retrieve the appointment details from the database
$sql = "SELECT * FROM appointments WHERE APTM_ID = '$appointment_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Display the appointment details in a form for editing
echo "<form action='update_appointment.php' method='post'>";
echo "<label for='status'>Status:</label>";
echo "<select id='status' name='status'>";
echo "<option value='" . $row['APTM_Status'] . "'>" . $row['APTM_Status'] . "</option>";
echo "<option value='Completed'>Completed</option>";
echo "<option value='Cancelled'>Cancelled</option>";
echo "<option value='Delayed'>Delayed</option>";
echo "</select>";
echo "<br>";
echo "<input type='hidden' name='appointment_id' value='" . $appointment_id . "'>";
echo "<input type='submit' value='Update Status'>";
echo "</form>";