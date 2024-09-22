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
        <title>Credits</title>           
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
            

            <!-- Credits List --> 
        <div class="page_container">
            <div class="banner">
                <img src="/KF7013/assets/images/cover.webp" alt="event1">
            </div>
            <div class="booking-redir">
                <h2> Credits </h2>
                <h3> Images </h3>
                <p> Fever. (2024). ?? Candlelight Concerts in Newcastle upon Tyne Tickets 2024 | Fever. [online] Available at: https://feverup.com/en/newcastle-upon-tyne/candlelight [Accessed 11 Jan. 2024]. </p>
                <p>Fletcher, R. (2014). Holi Festival Newcastle: Holi One colour festival hits Newcastle June 2014. [online] Chronicle Live. Available at: https://www.chroniclelive.co.uk/whats-on/whats-on-news/holi-festival-newcastle-holi-one-6775227 [Accessed 11 Jan. 2024].000000</p>
                <p>Flickr. (2024a). Flickr. [online] Available at: https://www.flickr.com/photos /danramarch/5736208414 [Accessed 11 Jan. 2024]</p>
                <p>Flickr. (2024b). Flickr. [online] Available at: https://www.flickr.com/photos /80824546@N00/5748044727 [Accessed 11 Jan. 2024].</p>
                <p>Flickr. (2024c). Flickr. [online] Available at: https://www.flickr.com/photos /64097751@N00/1128994314 [Accessed 11 Jan. 2024].</p>
                <p>Flickr. (2024d). Flickr. [online] Available at: https://www.flickr.com/photos /98640399@N08/9378188512 [Accessed 11 Jan. 2024].</p>
                <p>Flickr. (2024e). Flickr. [online] Available at: https://www.flickr.com/photos /58820009@N05/5521461532 [Accessed 11 Jan. 2024].</p>
                <p>Flickr. (2024f). Flickr. [online] Available at: https://www.flickr.com/photos /26781812@N00/13805007365 [Accessed 11 Jan. 2024].</p>
                <p>https://www.facebook.com/peoplemag (2020). Drive-In Theaters Experience Popularity Surge amid Coronavirus: �A Welcome Relief for Families�. [online] Peoplemag. Available at: https://people.com/human-interest/ drive-in-theaters-experience-popularity-surge-coronavirus/ [Accessed 11 Jan. 2024].</p>
                <p>rawpixel. (2024). Red circus tent. Free public | Free Photo - rawpixel. [online] Available at: https://www.rawpixel.com/ image/6039135/red-circus- tent-free-public-domain-cc0-photo [Accessed 11 Jan. 2024].</p>
                <p>The Bookseller. (2022). London Book Fair 2022 saw 10,000 fewer attendees than pre-pandemic norm. [online] Available at: https://www.thebookseller.com/news /london-book-fair-2022-saw-10000-fewer-attendees-than-pre-pandemic-norm [Accessed 11 Jan. 2024].</p>
                <p>Wikimedia.org. (2008). File:Slipknot concert (cropped).jpg - Wikimedia Commons. [online] Available at: https://commons.wikimedia.org/ wiki/File:Slipknot_concert_ %28cropped%29.jpg [Accessed 11 Jan. 2024].</p>
                <p>Flickr. (2024). Flickr. [online] Available at: https://www.flickr.com/photos /98640399@N08/9378188512 [Accessed 16 Jan. 2024].?</p>
                <p>Hotels.com. (2024). 10 Places Where Locals Go at Night in Manchester - Where Do Mancunians Go at Night? - Go Guides. [online] Available at: https://uk.hotels.com /go/england/locals-go-at-night-manchester [Accessed 16 Jan. 2024].</p>
                <h3> Favicon Generated using </h3>
		<p>RealFaviconGenerator.net. (2023). Your generated favicon. [online] Available at: https://realfavicongenerator.net/ favicon_result?file_id= p1hk83gbh71vv81oa01iikc361oer6 [Accessed 16 Jan. 2024].</p>
		<h3> Fonts </h3>
		<p>JetBrains: Developer Tools for Professionals and Teams. (2019). JetBrains: Developer Tools for Professionals and Teams. [online] Available at: https://www.jetbrains.com/ lp/mono/#license [Accessed 16 Jan. 2024].</p>
            </div>
        </div>
            
            <!-- Footer -Section -->
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
    
