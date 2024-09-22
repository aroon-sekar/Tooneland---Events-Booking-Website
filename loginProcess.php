<?php
// Make a database connection
include 'dbconn.php';

session_start();

// Get the username and password from the POST request from the login form

// Get the username and password from the POST request
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

// Input validation and sanitization

$username = $_POST['username'] ?? ''; // Default to an empty string if not set
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');


$password = $_POST['password'] ?? ''; // Default to an empty string if not set
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');


//Preparing the SQL statements to prevent SQL Injections
$querySQL = "SELECT userID, password_hash FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $querySQL);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$queryresult = mysqli_stmt_get_result($stmt);
$userRow = mysqli_fetch_assoc($queryresult);


// Check if the username exists in the database
if ($userRow) {
    $hashedPassword = $userRow['password_hash'];
    // Check if the password matches the hashed password in the database
    if (password_verify($password, $hashedPassword)) {
        // Correct password

	// Here we are regenerating the session id after successful login to prevent session fixation attacks
	session_regenerate_id();


        $_SESSION['logged-in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $userRow['userID']; // Storing user ID in session

        // Set a cookie to remember the user for 1 hour
         setcookie("logged-in", "true", time() + 3600, "/", "", true, true);


        header("Location: index.php");
        exit;


    } else {
        // Incorrect password
        $_SESSION['login-error'] = "Username or Password Invalid.";
        header("Location: logon.php");
        exit;
    }

} else {
    // Username not found
    $_SESSION['login-error'] = "Username or Password Invalid.";
    header("Location: logon.php");
    exit;
}

// After successful login, checking if we have a redirect URL to redirect to that page 
if (!empty($_POST['redirect_url'])) {
    $redirectUrl = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_URL);
    header("Location: $redirectUrl");
} else {
    // Redirect to the index page if there's no redirect URL
    header("Location: index.php");
}
exit();
?>
