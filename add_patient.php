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

<!-- HTML form with internal CSS -->
<form action="add_patient.php" method="post">

    <style>
        /* General Styles */
        header{
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
        input[type="date"],
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
<h2>Add Patient</h2>
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="cnum" placeholder="Email Address" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Add</button>
    

</form>
