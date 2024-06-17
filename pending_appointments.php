<?php

include 'config.php';
include 'sb&hd.php';

$stmt = $conn->prepare("SELECT 
        a.APTM_ID, 
        CONCAT(p.PT_FName, ' ', p.PT_LName) AS Patient, 
        CONCAT(d.D_FName, ' ', d.D_LName) AS Doctor, 
        CONCAT(n.N_FName, ' ', n.N_LName) AS Nurse,
        s.Serv_Title AS Service, 
        a.APTM_Date, 
        a.APTM_Status, 
        u.User_UName AS AppointedBy
            FROM 
             appointments a
            LEFT JOIN 
                patient p ON a.PT_ID = p.PT_ID
            LEFT JOIN 
                doctors d ON a.Doctor_ID = d.Doctor_ID
            LEFT JOIN 
                nurses n ON a.Nurse_ID = n.Nurse_ID
            LEFT JOIN 
                services s ON a.Serv_ID = s.Serv_ID
            LEFT JOIN 
                adminstaff u ON a.User_ID = u.User_ID
            WHERE APTM_Status ='Pending'");

$stmt->execute();
$result = $stmt->get_result();

echo "<table>";
echo "<tr>
        <th>ID</th>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Nurse</th>
        <th>Service</th>
        <th>Date</th>
        <th>Status</th>
        <th>AppointedBy</th>
     </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['APTM_ID'] . "</td>";
    echo "<td>" . $row['Patient'] . "</td>";
    echo "<td>" . $row['Doctor'] . "</td>";
    echo "<td>" . $row['Nurse'] . "</td>";
    echo "<td>" . $row['Service'] . "</td>";
    echo "<td>" . $row['APTM_Date'] . "</td>";
    echo "<td>" . $row['APTM_Status'] . "</td>";
    echo "<td>" . $row['AppointedBy'] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();

?>

    <a href="add_appointment.php" class="add appointments">Add Appointments</a>
    <a href='completed_appointment.php'>Completed</a>
    <a href='cancelled_appointments.php'>Cancelled</a>
    <a href='pending_appointments.php'>Pending</a>