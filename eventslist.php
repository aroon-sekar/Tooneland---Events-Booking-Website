<?php
include 'dbconn.php';

// Query to select data from the events table
$sql = "SELECT eventID, event_title, description, event_date, ppp, event_imagepath FROM events";
$result = $conn->query($sql);
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
    <title>Events List - TOONE</title>           
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

        <!-- Hero Section of the Page -->

        <div class="hero_section">
            <div class="hero_text">
                <h1>EVENTS - TOONE</h1>
                <p>Check out the latest events taking place at the Toone Park.</p>
            </div>
        </div>
    </header>       

    <main class="list-container">
        <!-- Events List Section -->
        <div class="events-container">
            <?php 
            if ($result->num_rows > 0) {
                // Loop through each row and display the HTML with data
                while($row = $result->fetch_assoc()) {
                    // Convert the event date to a DateTime
                    $date = new DateTime($row["event_date"]);
                    // Format the date as "Month - Date at Time"
                    $formattedDate = $date->format('F - d \a\t H:i');
                    ?>
                    <!-- event cards -->
                    <div class="event-card">
                        <img src="/KF7013/assets/images/<?php echo $row["event_imagepath"]; ?>" alt="<?php echo $row["event_title"]; ?>" class="event-image">
                        <div class="event-details">
                            <h3 class="event-title"><?php echo $row["event_title"]; ?></h3>
                            <p class="event-desc"><?php echo $row["description"]; ?></p>
                            <p class="event-time"><?php echo $formattedDate; ?></p>
                            <p class="event-price">&pound;<?php echo $row["ppp"]; ?></p>
                            <a href="eventdetails.php?eventID=<?php echo $row['eventID']; ?>"><button>More info</button></a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "0 events found";
            }
            ?>
        </div>

        
        <!-- Side Banner Section -->
        <aside class="promotion">
            <img src="/KF7013/assets/images/rep.webp" alt="Virginia Prize for Fiction" class="event-image">
            <img src="/KF7013/assets/images/sidebanner2.webp" alt="Virginia Prize for Fiction" class="event-image">
        </aside>
    </main>


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
// Close connection
$conn->close();
?>