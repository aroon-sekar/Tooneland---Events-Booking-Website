<!DOCTYPE html>
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
    <link rel="stylesheet" href="/KF7013/assets/stylesheets/styles.css">
    <title>User Registration</title>
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
            <ul class="navbar_list"></ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <button class="close-nav">&#10005;</button>
        </nav>
    </header>

    <div class="page_container">
        <div class="banner">
            <img src="/KF7013/assets/images/cover.webp" alt="event1">
        </div>

        <?php
        // connectin to the database
        include 'dbconn.php';

        $registrationSuccessful = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

	    $firstname = $_POST['firstname'] ?? ''; // Default to an empty string if not set
            $firstname = htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8');

	    $lastName = $_POST['surname'] ?? ''; // Default to an empty string if not set
            $lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');

            $dob = $_POST['dob'];
            $gender = $_POST['gender'];

            $email = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);

            $password = $_POST['password']; // Consider hashing the password

	    $address = $_POST['address'] ?? ''; // Default to an empty string if not set
            $address = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');

	    $city = $_POST['city'] ?? ''; // Default to an empty string if not set
            $city= htmlspecialchars($city, ENT_QUOTES, 'UTF-8');

            $postal_code = $_POST['postal_code'] ?? ''; // Default to an empty string if not set
            $postal_code = htmlspecialchars($postal_code, ENT_QUOTES, 'UTF-8');

   
            // Check if email already exists
            $checkEmailQuery = "SELECT username FROM users WHERE username = ?";
            $stmt = $conn->prepare($checkEmailQuery);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Email already exists
                echo '<div class="error-message">Email already exists. Please use a different email.</div>';
            } else {


                // Email does not exist, proceed to insert data into the users table
                $userID = generateUserID();
                $age = calculateAge($dob);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (userID, firstname, surname, dob, age, gender, username, password_hash, address, city, postal_code)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssiissssss", $userID, $firstname, $lastName, $dob, $age, $gender, $email, $hashedPassword, $address, $city, $postal_code);

                if ($stmt->execute()) {
                    $registrationSuccessful = true;
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }


        // Function to generate a random two-digit User ID
        function generateUserID()
        {
            // Generate a random User ID
            $number = mt_rand(00000, 99999);
            return strval($number);
        }

        // Function to calculate age from date of birth
        function calculateAge($dob)
        {
            $dob = new DateTime($dob);
            $now = new DateTime();
            return $dob->diff($now)->y;
        }
        ?>



        <!-- Registration form -->
        <?php if (!$registrationSuccessful): ?>
        <form method="POST" action="submit_user.php">
            First Name: <input type="text" name="firstname" required><br>
            Last Name: <input type="text" name="surname" required><br>
            DOB: <input type="date" name="dob" required><br>

            <label for="gender">Select your gender:</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            Email ID: <input type="email" name="username" required><br>
            Confirm Email ID: <input type="email" name="confirm_email" required><br>

            Password: <input type="password" name="password" required minlength="8"><br>
            Confirm Password: <input type="password" name="confirm_password" required minlength="8"><br>

            Address: <input type="text" name="address" required><br>
            City: <input type="text" name="city" required><br>
            Postcode: <input type="text" name="postal_code" required><br>

            <input type="submit" value="Create User">
        </form>


        <?php endif; ?>

        <?php if ($registrationSuccessful): ?>
        <div class="booking-redir">
            <h2> Successfully Registered! </h2>
            <h3> Welcome, <?php echo $firstname ?></h3>
            <h3> Login to use your account. </h3>
            <a href="userprofile.php"> <button>Visit your Profile</button></a>
            <a href="index.php"> <button>Explore</button></a>
        </div>
        <?php endif; ?>
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

    <script src="/KF7013/assets/scripts/form-validation.js"></script>
    <script src="/KF7013/assets/scripts/scripts.js"></script>

</body>
</html>
