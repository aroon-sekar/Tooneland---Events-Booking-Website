<?php

session_start();

// Check if enquiry details are set in the session
if (!isset($_SESSION['enquiry_details'])) {
    // Redirect to the contact page if not
    header("Location: contact.html");
    exit();
}

$enquiryDetails = $_SESSION['enquiry_details'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/KF7013/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/KF7013/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/KF7013/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/KF7013/assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/KF7013/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">  
    <link rel="stylesheet" href="/KF7013/assets/stylesheets/styles.css" />
    <title>Enquiry Submitted - Tooneland</title>
</head>

<body>
 <!-- this php is for checking logged-in status to enable the navbar as javascript cannot directly access the httponly and secure cookie -->
    <?php
  
    echo '<script type="text/javascript">';
    if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] === true) {
        echo 'var isLoggedIn = true;';
    } else {
        echo 'var isLoggedIn = false;';
    }
    echo '</script>';
    ?>

    <header class="header_container">
        <!-- Navigation bar -->
        <nav class="navbar">
            <a href="index.php"><img src="/KF7013/assets/images/logo.png" alt="logo"></a>
            <ul class="navbar_list">
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
    </header>

    <!-- Page content -->
    <div class="page_container">
        <div class="booking-redir">
            <h2>Enquiry Submitted Successfully</h2>
            <p>Your enquiry has been sent. Here are the details:</p>
            <p>Save your Enquiry ID if you're not a Registered User</p>

            <div class="enquiry-details">
                <p><strong>Enquiry ID:</strong> <?php echo htmlspecialchars($enquiryDetails['enquiryID']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($enquiryDetails['name']); ?></p>
                <p><strong>Email ID:</strong> <?php echo htmlspecialchars($enquiryDetails['email']); ?></p>
                <p><strong>Enquiry:</strong> <?php echo nl2br(htmlspecialchars($enquiryDetails['enquiry'])); ?></p>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="footer">
        <div class="footer-text">
            <div class="footer-section">
                <h4>Browse</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="eventslist.php">All Events</a></li>
                    <li><a href="credits.php">Credits</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Address</h4>
                <p>The Toone Park, <br>TL7 7AR, <br>Toonland</p>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p>+44 78945 12356 <br> tooneevents@email.com</p>
            </div>
        </div>
        <div class="footer-img">
            <a href="index.php"><img src="/KF7013/assets/images/logodark.png" alt="logo"></a>
        </div>
    </footer>

    <script src="/KF7013/assets/scripts/scripts.js"></script>
</body>
</html>

<?php
// Clear the session variable for enquiry details after displaying them
unset($_SESSION['enquiry_details']);
?>
