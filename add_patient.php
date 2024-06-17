<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $contact = $_POST['cnum'];
        $email = $_POST['email'];
        
        $stmt = $conn->prepare("INSERT INTO patient (PT_FName, PT_LName, PT_Address, PT_Age, PT_CNumber, PT_Email) 
                             VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $firstname, $lastname, $address, $age, $contact, $email,);
        $stmt->execute();

        if (!$stmt->error) {
            $_SESSION['message'] = "Added succesfully";
            header("Location: patient.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
?>

<!-- HTML form -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="addpatient.css">
</head>
<body>
<div class="wrapper">
    <form action="add_patient.php" method="post">
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="cnum" placeholder="Contact Number" required>
        <input type="email" name="email" placeholder="Email" required> <br>
   
        <button type="submit">Add</button>
    </form>
</div>


</body>
</html>
