<?php
include './includes/db.php';

// Server-side validation
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $joining_date = $_POST['joining-date'];
    $shift_time = $_POST['shift-time'];
    $employee_id = (int)$_POST['employee-id'];
    $department = $_POST['department'];
    $skills = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';
    $availability = isset($_POST['availability']) ? 1 : 0;
    $notes = trim($_POST['notes']);

    // Validations
    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    if (empty($joining_date)) {
        $errors[] = "Joining date is required.";
    }

    if (empty($shift_time)) {
        $errors[] = "Shift time is required.";
    }

    if ($employee_id <= 0) {
        $errors[] = "Employee ID must be a positive number.";
    }

    if (empty($department)) {
        $errors[] = "Department is required.";
    }

    // Check if employee ID or email already exists
    $stmt = $conn->prepare("SELECT id FROM employees WHERE employee_id = ? OR email = ?");
    $stmt->bind_param("is", $employee_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Employee ID or Email already exists.";
    }
    $stmt->close();

    if (empty($errors)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO employees (name, email, address, joining_date, shift_time, employee_id, department, skills, availability, notes) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssissss", $name, $email, $address, $joining_date, $shift_time, $employee_id, $department, $skills, $availability, $notes);

        if ($stmt->execute()) {
            echo "Employee details saved successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$conn->close();
?>