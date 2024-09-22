<?php
//connect to the database
/* The following statements set up the 4 variables needed to
connect to your account on the MySQL database on nuwebspace.*/
$servername = 'nuwebspace_db';
$username = 'w22062575';
$password = 'L5VhHDtH7QtMLg%';
$dbname = 'w22062575';
$conn = mysqli_connect($servername,$username, $password, $dbname)
or die("Can not connect to DB");
//echo "Successful connection";
?>