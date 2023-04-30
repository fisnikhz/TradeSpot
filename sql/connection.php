// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ueb2";
   
$conn = mysqli_connect($servername, $username, $password, $dbname);
// check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
