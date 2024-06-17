<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $license = $_POST['licnum'];
        $contact = $_POST['cnum'];
        $email = $_POST['email'];
        $specs = $_POST['specialization'];
        $fee = $_POST['fee'];

        $stmt = $conn->prepare("INSERT INTO doctors (D_FName, D_LName, D_LicenseNum, D_CNum, D_Email, D_Fee, Spec_ID) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssii", $firstname, $lastname, $license, $contact, $email, $fee, $specs);
        $stmt->execute();

        if (!$stmt->error) {
            $_SESSION['message'] = "Added succesfully";
            header("Location: doctors.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }

// Get specializations from database
$sql = "SELECT Spec_ID, Specialization FROM specializations";
$result = $conn->query($sql);
$specializations = array();
while ($row = $result->fetch_assoc()) {
    $specializations[$row['Spec_ID']] = $row['Specialization'];
}
?>

<!-- HTML form -->
<form action="add_doctor.php" method="post">
    <input type="text" name="fname" placeholder="First Name" required>
    <input type="text" name="lname" placeholder="Last Name" required>
    <input type="text" name="licnum" placeholder="License Number" required>
    <input type="text" name="cnum" placeholder="Contact Number" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="number" name="fee" placeholder="Fee" required>
    <select name="specialization" required>
        <option value="">Select Specialization</option>
        <?php foreach ($specializations as $id => $name) { ?>
            <option value="<?php echo $id ?>"><?php echo $name ?></option>
        <?php } ?>
    </select>
    <button type="submit">Add</button>
</form>