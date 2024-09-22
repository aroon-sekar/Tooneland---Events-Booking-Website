<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon Icons for various devices and sizes -->
    <link rel="apple-touch-icon" sizes="180x180" href="/KF7013/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/KF7013/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/KF7013/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/KF7013/assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/KF7013/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">  

    <link rel="stylesheet" href="/KF7013/assets/stylesheets/styles.css" />
    <title>Event Booking - Tooneland</title>           
</head>


<body>

<?php
    //this php is for checking logged-in status to enable the navbar as javascript cannot directly access the httponly and secure cookie -->


    // connecting to the database
    include 'dbconn.php';

    //starting the session and setting the user logged-in flags for navbar script
    session_start();

    echo '<script type="text/javascript">';
    if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] === true) {
        echo 'var isLoggedIn = true;';
    } else {
        echo 'var isLoggedIn = false;';
    }
    echo '</script>';
    

    // $eventID is passed via GET request from the event details page

   
    $eventID = filter_input(INPUT_GET, 'eventID', FILTER_SANITIZE_NUMBER_INT);

    

    //starting the session and checking if the user is logged in
    

    if (!isset($_SESSION['logged-in']) || !$_SESSION['logged-in']) {
        // Set the current URL as the redirect URL in the session
        $_SESSION['redirect_url'] = 'booking.php?eventID=' . $eventID;
        header("Location: logon.php");
        exit;
    }

    // Check if a username is set
    if (isset($_POST['username'])) {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL); // sanitizing the username for security

        // Check if the username exists and also we are using prepared statements to prevent SQL injection attacks
        $stmt = $conn->prepare("SELECT userID FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Username does not exist
            echo "The username does not exist. Please register or try a different username.";
        }
    }

    // Fetching event details from the database
    $stmt = $conn->prepare("SELECT event_title, event_date, ppp FROM events WHERE eventID = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $event = $result->fetch_assoc();
    } else {
        // Handle the case where the event does not exist
        echo "Event not found.";
        exit();
    }
?>

<header class="header_container">
    <!-- Navigation bar -->
    <nav class="navbar">
        <a href="index.php"><img src="/KF7013/assets/images/logo.png" alt="logo"></a>
        <ul class="navbar_list"> </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <button class="close-nav">&#10005;</button>
    </nav>
</header>


<!-- Main Page --> 
<div class="page_container">
    <div class="banner">
        <img src="/KF7013/assets/images/cover.webp" alt="event1">
    </div>
    <div class="booking-redir">
        <h2> Book your tickets here </h2>
        <h3> Book Now. Pay Later </h3>
        <p> Only registered users can book the tickets. <br> Please make sure to enter your details correctly </p>
    </div>

<!-- Booking Form which will store the details in the database-->
    <div class="booking-form">  
        <form action="submit_booking_s.php" method="post">
            <h2>Booking for: <?php echo htmlspecialchars($event['event_title']); ?></h2>
            <p>Event Date: <?php echo htmlspecialchars($event['event_date']); ?></p>

            <input type="hidden" name="eventID" value="<?php echo htmlspecialchars($eventID); ?>"><!-- eventID is hidden for users -->

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="numberOfPeople">Number of People:</label>
            <input type="number" id="numberOfPeople" name="numberOfPeople" required min="1">

            <p>Price per Person: <span id="ppp"><?php echo htmlspecialchars($event['ppp']); ?></span></p>

            <label for="totalPrice">Total Price: </label>
            <input type="text" id="totalPrice" name="totalPrice" readonly>

            <label for="bookingNotes">Booking Notes:</label>
            <textarea id="bookingNotes" name="bookingNotes"></textarea>

            <button type="submit" name="submit">Book</button>
        </form>
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
