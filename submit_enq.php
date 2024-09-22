<?php
    // Start the session to store session variables
    session_start();

    // Connect to your database (replace with your connection parameters)
    include 'dbconn.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Generate a random 4-digit enquiry ID
        $enquiryID = rand(1000, 9999);

        // Retrieve form data using the 'name' attributes
        $name = $_POST['name'] ?? ''; // Default to an empty string if not set
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

        $email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);

        $enquiry = $_POST['enquiry'] ?? ''; // Default to an empty string if not set
        $enquiry = htmlspecialchars($enquiry, ENT_QUOTES, 'UTF-8');

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO contact (enquiryID, name, username, enquiry) VALUES (?, ?, ?, ?)");
        
        // Bind parameters to the SQL statement
        $stmt->bind_param("isss", $enquiryID, $name, $email, $enquiry);

        // Execute the statement and check for successful insertion
        if ($stmt->execute()) {
            // Close the statement and the connection
            $stmt->close();
            $conn->close();

            // Store details in session variables to display on the next page
            $_SESSION['enquiry_details'] = [
                'enquiryID' => $enquiryID,
                'name' => $name,
                'email' => $email,
                'enquiry' => $enquiry
            ];

            // Redirect to enquiry successful page
            header("Location: enquiry_success.php");
            exit();
        } else {
            // Handle error here
            echo "Error: " . $stmt->error;
            $stmt->close();
            $conn->close();
        }
    } else {
        // Redirect back to the form if it wasn't submitted
        header("Location: contact.php");
        exit();
    }
?>
