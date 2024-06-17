<?php
// Query to select all patients
include 'config.php';
include 'sb&hd.php';

$sql = "SELECT d.*, s.Specialization 
        FROM doctors d 
        INNER JOIN specializations s ON d.Spec_ID = s.Spec_ID";
$result = $conn->query($sql);

// Check if query is successful 
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display nurse table
echo "<table>";
echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>License Number</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Fee</th>
        <th>Specialization</th>
     </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Doctor_ID'] . "</td>";
    echo "<td>" . $row['D_FName'] . "</td>";
    echo "<td>" . $row['D_LName'] . "</td>";
    echo "<td>" . $row['D_LicenseNum'] . "</td>";
    echo "<td>" . $row['D_CNum'] . "</td>";
    echo "<td>" . $row['D_Email'] . "</td>";
    echo "<td>" . $row['D_Fee'] . "</td>";
    echo "<td>" . $row['Specialization'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Close connection
$conn->close();
?>

<a href="add_nurse.php" class="addnurse">Add Nurse_ID</a>