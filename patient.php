
<?php
include 'config.php';
include 'sb&hd.php';

// Query to select all patients
$sql = "SELECT * FROM patient";
$result = $conn->query($sql);

// Check if query is successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display patient table
echo "<table>";
echo "<tr><th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Address</th>
      <th>Age</th>
      <th>Phone Number</th>
      <th>Email</th>
      </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['PT_ID'] . "</td>";
    echo "<td>" . $row['PT_FName'] . "</td>";
    echo "<td>" . $row['PT_LName'] . "</td>";
    echo "<td>" . $row['PT_Address'] . "</td>";
    echo "<td>" . $row['PT_Age'] . "</td>";
    echo "<td>" . $row['PT_CNumber'] . "</td>";
    echo "<td>" . $row['PT_Email'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Close connection
$conn->close();
?>

<a href="add_patient.php" class="addpatient">Add Patient</a>
