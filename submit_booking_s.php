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
    <title>Successful Booking</title>           
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
        
        <?php
        // Include your database connection file
        include 'dbconn.php';
    
        

        if (!isset($_SESSION['logged-in']) || !$_SESSION['logged-in']) {
            // Redirect to login page if not logged in
            header("Location: logon.php");
            exit;
        }

        
        // Function to generate a random four-digit booking ID
        function generateBookingID() {
            return rand(1000, 9999);
        }
        
        // Initialize variables
        $bookingSuccessful = false;
        $bookingDetails = [];
        $errorMessage = '';

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitizin and validating the input data from the form to avoid SQL injection

            $firstName = $_POST['firstName'] ?? ''; // Default to an empty string if not set
            $firstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            $eventID = filter_input(INPUT_POST, 'eventID', FILTER_SANITIZE_NUMBER_INT);


	    $numberOfPeople = filter_input(INPUT_POST, 'numberOfPeople', FILTER_SANITIZE_NUMBER_INT);

            $bookingNotes = $_POST['bookingNotes'] ?? '';
            $bookingNotes = htmlspecialchars($bookingNotes, ENT_QUOTES, 'UTF-8');

            $bookingID = generateBookingID();
        
            // Validate username exists
            $stmt = $conn->prepare("SELECT userID FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $userID = $row['userID'];
        
                // Get event price per person
                $stmt = $conn->prepare("SELECT ppp FROM events WHERE eventID = ?");
                $stmt->bind_param("i", $eventID);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $eventData = $result->fetch_assoc();
                    
                    // Calculate total cost
                    $totalCost = $eventData['ppp'] * $numberOfPeople;
        
                    // Insert booking into database
                    $stmt = $conn->prepare("INSERT INTO booking (userID, eventID, number_people, total_booking_cost, booking_notes, bookingID) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiidsi", $userID, $eventID, $numberOfPeople, $totalCost, $bookingNotes, $bookingID);
                    $stmt->execute();
        
                    if ($stmt->affected_rows === 1) {
                        // Booking was successful
                        $bookingSuccessful = true;
                        $bookingDetails = [
                            'bookingID' => $bookingID,
                            'firstName' => $firstName,
                            'username' => $username,
                            'eventID' => $eventID,
                            'numberOfPeople' => $numberOfPeople,
                            'totalCost' => $totalCost,
                            'bookingNotes' => $bookingNotes
                        ];
                    }
                }
            }
            
        }


    
        
        // If booking was successful, display booking details
        if ($bookingSuccessful) {
        ?>


        <div class="booking-redir">
            <h1>Booking Successful!</h1>
            <p>Booking ID: <?php echo htmlspecialchars($bookingDetails['bookingID']); ?></p>
            <p>Name: <?php echo htmlspecialchars($bookingDetails['firstName']); ?></p>
            <p>Username: <?php echo htmlspecialchars($bookingDetails['username']); ?></p>
            <p>Event ID: <?php echo htmlspecialchars($bookingDetails['eventID']); ?></p>
            <p>Number of People: <?php echo htmlspecialchars($bookingDetails['numberOfPeople']); ?></p>
            <p>Total Cost: $<?php echo htmlspecialchars(number_format($bookingDetails['totalCost'], 2)); ?></p>
            <p>Booking Notes: <?php echo nl2br(htmlspecialchars($bookingDetails['bookingNotes'])); ?></p>
            <a href='index.php'><button>Return to Home</button></a>
        </div>
        <?php
        
        } else {
             // If booking failed, redirect to an error page
            header("Location: booking_error.php");
            exit();

            exit();
        }
        ?>
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
