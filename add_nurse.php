<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $license = $_POST['licnum'];
    $contact = $_POST['cnum'];
    $email = $_POST['email'];
    $specs = $_POST['specialization'];
    
    $stmt = $conn->prepare("INSERT INTO nurses (N_FName, N_LName, N_LicNumber, N_CNum, N_Email, Spec_ID) 
                             VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstname, $lastname, $license, $contact, $email, $specs);
    $stmt->execute();

    if (!$stmt->error) {
        $_SESSION['message'] = "Added successfully";
        header("Location: nurse.php");
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
<!DOCTYPE html>
<html>
<head>
    <title>Add Nurse</title>
    <style>
         html { 
            background: url(assets/img.jpg) no-repeat center fixed; 
            background-size: cover;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        input::placeholder,
        select {
            color: #999;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <form action="add_nurse.php" method="post">
        <h2>Add Nurse</h2>
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="text" name="licnum" placeholder="License Number" required>
        <input type="text" name="cnum" placeholder="Contact Number" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="specialization" required>
            <option value="">Select Specialization</option>
            <?php foreach ($specializations as $id => $name) { ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php } ?>
        </select>
        <button type="submit">Add</button>
    </form>
    <?php
    // Close connection
    $conn->close();
    ?>
</body>
</html>
