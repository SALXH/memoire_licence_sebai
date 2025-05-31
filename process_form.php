<?php
// Include database connection
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Validate inputs
    $errors = [];
    
    // Basic validation
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
    
    if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, insert data into database
    if (empty($errors)) {
        $sql = "INSERT INTO contact_inquiries (full_name, email, phone, subject, message) 
                VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            // Set success message
            $successMsg = "Your message has been sent successfully!";
        } else {
            // Set error message
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();

// Redirect back to the contact form page with status
$redirect = "index.php";
if (isset($successMsg)) {
    $redirect .= "?status=success";
} elseif (isset($errorMsg) || !empty($errors)) {
    $redirect .= "?status=error";
}

header("Location: $redirect");
exit();
?>