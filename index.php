
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
    <title>TOONE</title>
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

        <!-- Hero Section of the Page -->
        <div class="hero_section">
            <div class="hero_text">
                <h1>AT THE TOONE</h1>
                <p>Welcome to The Toone Park, where the city's vibrant pulse meets the embrace of nature. Our outdoor space is home to a variety of noteworthy events,
                    including thrilling kid-friendly fairs, thrilling music performances, and hilarious comedic performances suitable for all age groups.</p>
                <a href="eventslist.php"><button>BROWSE EVENTS</button></a>
            </div>
        </div>
    </header>


    <!-- Main events display section -->
    <main class="main_container">

        <?php
        include 'dbconn.php';

        // SQL query to include a JOIN with the category table
        $sql = "SELECT e.eventID, e.event_title, e.description, e.event_date, e.ppp, e.event_imagepath, c.category_name
                FROM events e
                JOIN category c ON e.categoryID = c.categoryID
                ORDER BY c.category_name, e.event_date";
        $result = $conn->query($sql);

        $eventsByCategory = [];

        if ($result->num_rows > 0) {
            // Organize events by category
            while ($row = $result->fetch_assoc()) {
                $eventsByCategory[$row['category_name']][] = $row;
            }

            // Now, you can loop through each category and display its events
            foreach ($eventsByCategory as $categoryName => $events) {
                echo "<h2>" . htmlspecialchars($categoryName) . "</h2>"; // Display the category name
                echo "<div class=\"scrolling-wrapper\">";
                foreach ($events as $event) {
                    // Convert the event date to a DateTime
                    $date = new DateTime($event["event_date"]);
                    // Format the date as "Month - Date at Time"
                    $formattedDate = $date->format('F - d \a\t H:i');

                    // Display each event card
                    echo "<div class=\"card\">";
                    echo "<img src=\"/KF7013/assets/images/" . htmlspecialchars($event["event_imagepath"]) . "\" alt=\"" . htmlspecialchars($event["event_title"]) . "\" class=\"event-image\">";
                    echo "<div class=\"card-info\">";
                    echo "<h3 class=\"event-title\">" . htmlspecialchars($event["event_title"]) . "</h3>";
                    echo "<p class=\"event-desc\">" . htmlspecialchars($event["description"]) . "</p>";
                    echo "<p class=\"event-time\">" . htmlspecialchars($formattedDate) . "</p>";
                    echo "<p class=\"event-price\">&pound;" . htmlspecialchars($event["ppp"]) . "</p>";
                    echo "<a href=\"eventdetails.php?eventID=" . htmlspecialchars($event['eventID']) . "\"><button>More info</button></a>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No events found</p>";
        }

        // Close connection
        $conn->close();
        ?>

    </main>

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
