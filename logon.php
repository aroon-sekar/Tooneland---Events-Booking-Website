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
    <title>Sign-in to Tooneland</title>           
</head>


<body>
 <!-- this php is for checking logged-in status to enable the navbar as javascript cannot directly access the httponly and secure cookie -->
    <?php
    session_start();
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

    <!-- Error message section -->
    <?php


    // Check for error message in the session
    if (isset($_SESSION['login-error'])) {
        echo '<div class="error-message">' . $_SESSION['login-error'] . '</div>';
        unset($_SESSION['login-error']);
    }

    // Check if a redirect URL is set in the session
    $redirectUrl = '';
    if (isset($_SESSION['redirect_url'])) {
        $redirectUrl = $_SESSION['redirect_url'];

    }
    ?>     
    
    
    <!-- Main Page --> 
    <div class="page_container">

        <div class="banner">
            <img src="/KF7013/assets/images/cover.webp" alt="event1">
        </div>
        <div class="booking-redir">
            <h2> Login to your Account </h2>
            <h3> Please make sure to enter your details correctly </h3>
        </div>

        <!-- Login form -->
        <div class="booking-form">
            <form id="userForm" method="post" action="loginProcess.php">
                EmailID/ Username: <input type="text" name="username" required><br>
                Password: <input type="password" name="password" required><br>
                <input type="submit" value="Login">
            </form>            
        </div>
        <div class="booking-redir">
            <h3></h3><a href="registration.php">  Don't have an account? Register here</a><h3></h3>
        </div>
    </div>


    <!-- Footer Section -->

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
