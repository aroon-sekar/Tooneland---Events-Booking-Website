<?php
session_start();
session_unset();
session_destroy(); // Destroying the session
setcookie("logged-in", "", time() - 3600); // Deleting the cookie
header("Location: logon.php"); // Redirect to the login page
exit;
