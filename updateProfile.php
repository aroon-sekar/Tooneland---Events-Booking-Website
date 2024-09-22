<?php
include 'dbconn.php';
session_start();

if (isset($_POST['submit'])) {
    $userId = $_SESSION['userId'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['username'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalCode = $_POST['postal_code'];

    // Prepare the SQL statement to update the user profile with new data

    $updateSql = "UPDATE users SET firstname = ?, surname = ?, username = ?, dob = ?, address = ?, city = ?, postal_code = ? WHERE userID = ?";
    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param("sssssssi", $firstname, $surname, $email, $dob, $address, $city, $postalCode, $userId);
        $stmt->execute();
        $stmt->close();
    }
    // Redirect back to profile page
    header("Location: userprofile.php"); // Redirect back to the profile page
    exit;
}
$conn->close();
?>
