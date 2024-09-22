

<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    // User is logged in, redirect to the booking form with the eventID
    $eventID = isset($_GET['eventID']) ? $_GET['eventID'] : 'default'; // Replace 'default' with appropriate handling
    header("Location: booking.php?eventID=$eventID");
    exit();
} else {
    // User is not logged in, redirect to the login page
    // Use JavaScript to alert the user and then redirect
    echo "<script>alert('Please log in to book tickets.'); window.location.href = 'logon.php';</script>";
    exit();
}
?>
