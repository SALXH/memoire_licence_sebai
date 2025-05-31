<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password is empty
$dbname = "agence_immobiliere";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to ensure proper handling of special characters
$conn->set_charset("utf8mb4");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // You can add hidden fields in your form to capture these values
    // or modify as needed
    $property_id = $conn->real_escape_string(isset($_POST['property_id']) ? $_POST['property_id'] : 'unknown');
    $property_title = $conn->real_escape_string(isset($_POST['property_title']) ? $_POST['property_title'] : 'Apartment with Subunits');

    // Validate data
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If validation passes, insert data into database
    if (empty($errors)) {
        $sql = "INSERT INTO property_inquiries (name, email, phone, message, property_id, property_title) 
                VALUES ('$name', '$email', '$phone', '$message', '$property_id', '$property_title')";

        if ($conn->query($sql) === TRUE) {
            // Redirect back to the property page with success message
            header("Location: property-1.html?status=success");
            exit();
        } else {
            // Redirect back with error message
            header("Location: property-1.html?status=error&message=" . urlencode("Error: " . $conn->error));
            exit();
        }
    } else {
        // Redirect back with validation errors
        header("Location: property-1.html?status=error&message=" . urlencode(implode(", ", $errors)));
        exit();
    }
} else {
    // If someone tries to access this script directly without submitting the form
    header("Location: property-1.html");
    exit();
}

// Close the database connection
$conn->close();
?>