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
     <title>TOONE - Event Details</title>           
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
        <div class="page_container">

            <!-- php to get the event details from the database dynamically and display them -->
            <?php

            // connecting to the database
            include 'dbconn.php';


            if (isset($_GET['eventID'])) {
                $eventId = $_GET['eventID'];


                $sql = "SELECT e.event_title, e.description, e.event_date, e.ppp, e.event_imagepath, e.details, c.category_name 
                FROM events e
                INNER JOIN category c ON e.categoryID = c.categoryID 
                WHERE e.eventID = ?";

                // Prepare the statement and bind the eventID parameter for security
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("i", $eventId);
                    $stmt->execute();
                    // Bind the result to include $category_name
                    $stmt->bind_result($eventTitle, $description, $eventDate, $ppp, $eventImagepath, $details, $category_name);

                    if ($stmt->fetch()) {
                        $date = new DateTime($eventDate);
                        $formattedDate = $date->format('F - d \a\t H:i');
                        ?>


                        <div class="banner">
                            <!-- The image path is also set dynamically from the database -->
			    <!-- The credits for the images used are give in the credits.php page -->
                            <img src="/KF7013/assets/images/<?php echo htmlspecialchars($eventImagepath); ?>" alt="<?php echo htmlspecialchars($eventTitle); ?>">
                        </div>

                        <div class="overview">
                            <h2><?php echo htmlspecialchars($eventTitle); ?></h2>
                            <h3>Date and Time: <?php echo $formattedDate; ?></h3>
                            <h4>Category: <?php echo htmlspecialchars($category_name); ?></h4>
                            <p><?php echo nl2br(htmlspecialchars($description)); ?></p>
                            <h2>About the Event</h2>
                            <p><?php echo nl2br(htmlspecialchars($details)); ?></p>
                        </div>
                        
                        <!-- Link to Booking Page -->
                        <div class="booking-redir">
                            <h2> Book your tickets HERE </h2>
                            <h3> Book now. Pay Later. </h3>

                            <!-- checking if the user is logged in to display the sign in message-->
                            <?php
                           
                            

                            // Check if the 'logged-in' session variable is set and is true
                            if (!isset($_SESSION['logged-in']) || !$_SESSION['logged-in']) {
                                // Only show this paragraph if the user is not logged in
                                echo '<p> Sign in to Book </p>';
                            }
                            ?>

                            <!-- Pass the eventID -->
                            <a href="booking.php?eventID=<?php echo $eventId; ?>"><button>Book now!</button></a>

                        </div> 

                        <?php
                    } else {
                        echo "<p>Event not found.</p>";
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing the statement: " . htmlspecialchars($conn->error);
                }
                $conn->close();
            } else {

                echo "<p>No event ID specified.</p>";
            }
            ?>
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
