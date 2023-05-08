
<?php 
 

$domain = "localhost/short/"; 
$host = "localhost";
$user = "root"; //Database username
$pass = ""; //Database password
$db = "urlShortener"; //Database name

$conn = mysqli_connect("localhost", "root", "", "urlshortner");
if(!$conn){
    echo "Database connection error".mysqli_connect_error();
}

?>
