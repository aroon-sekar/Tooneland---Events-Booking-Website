<?php

include 'dbconn.php';


session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged-in']) || !$_SESSION['logged-in']) {
    // Redirect to login page if not logged in
    header("Location: logon.php");
    exit;
}

// Get the user ID from the session
$userId = $_SESSION['userId'];

// Fetch user details
$userSql = "SELECT firstname, surname, username, dob, age, address, city, gender, postal_code FROM users WHERE userID = ?";
$stmt = $conn->prepare($userSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Calculate age
$dob = new DateTime($user['dob']);
$now = new DateTime();
$age = $now->diff($dob)->y;

// Fetch booking details with additional information
$bookingSql = "SELECT 
               booking.bookingID, 
               events.event_title, 
               events.event_date,
               booking.number_people, 
               booking.total_booking_cost 
           FROM 
               booking 
           JOIN 
               events ON booking.eventID = events.eventID 
           WHERE 
               booking.userID = ?
           ORDER BY 
               events.event_date ASC";

$stmt = $conn->prepare($bookingSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$bookingResult = $stmt->get_result();

// Fetch user enquiries
$enquirySql = "SELECT enquiryID, enquiry FROM contact WHERE username = ?";
$enquiryStmt = $conn->prepare($enquirySql);
$enquiryStmt->bind_param("s", $user['username']);
$enquiryStmt->execute();
$enquiryResult = $enquiryStmt->get_result();

// Close user result set and prepared statement
$userResult->free();
$stmt->close();
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
    <title>Your Profile - Toone</title>           
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
            <ul class="navbar_list"> </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <button class="close-nav">&#10005;</button>
        </nav>

        <div class="page_container">

            <div class="acc-container">
                <h2> Hello, <?php echo htmlspecialchars($user['firstname']); ?> !! </h2>
                <h3> Your details. </h3>

                <!-- Account details form -->
                <form action="updateProfile.php" method="POST">
                    <div class="acc-details">
                        <p>First Name: <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>"></p>
                        <p>Surname: <input type="text" name="surname" value="<?php echo htmlspecialchars($user['surname']); ?>"></p>
                        <p>Username: <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"></p>
                        <p>Age: <?php echo htmlspecialchars($age); ?></p> 
                        <p>DOB: <input type="date" name="dob"  value="<?php echo htmlspecialchars($user['dob']); ?>"></p>
                        <p>Gender: <?php echo htmlspecialchars($user['gender']); ?></p>
                        <p>Address: <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>"></p>
                        <p>City: <input type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>"></p>
                        <p>Postcode: <input type="text" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>"></p>
                    </div>
                    <input type="submit" name="submit" value="Save Changes">
                </form>
            </div>
        </div>


        <!-- Booking table -->

        <div class="acc-container">
            <h3> Your Bookings. </h3>
            <p> Date ordered. </p>
            <div class="acc-table">
                <!-- Table showing Booking ID, Event Title, Event date, Number of people, total cost -->
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event Title</th>
                            <th>Event Date</th>
                            <th>Number of People</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($bookingResult->num_rows > 0) {
                            while($booking = $bookingResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($booking['bookingID']) . "</td>";
                                echo "<td>" . htmlspecialchars($booking['event_title']) . "</td>";
                                echo "<td class='date'>" . htmlspecialchars($booking['event_date']) . "</td>"; // Add class 'date' here
                                echo "<td>" . htmlspecialchars($booking['number_people']) . "</td>";
                                echo "<td class='currency'>&pound" . htmlspecialchars($booking['total_booking_cost']) . "</td>"; // Add class 'currency' here
                                echo "</tr>";
                            }                        
                        } else {
                            echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- enquires table -->

        <div class="acc-container">
            <h3> Your Enquires. </h3>
            <div class="acc-table">
                <table>
                    <thead>
                        <tr>
                            <th>Enquiry ID</th>
                            <th>Enquiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($enquiryResult->num_rows > 0) {
                            while($enquiry = $enquiryResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($enquiry['enquiryID']) . "</td>";
                                echo "<td>" . htmlspecialchars($enquiry['enquiry']) . "</td>";
                                echo "</tr>";
                            }                        
                        } else {
                            echo "<tr><td colspan='3'>No enquiries found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Footer section -->
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
// Close booking result set and database connection
$bookingResult->free();
$conn->close();
?>