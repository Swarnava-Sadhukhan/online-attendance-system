<?php
//establishing connection with database.
/
*
//localhost database
$host = "localhost";
$username = "root";
$pass = "";
$db="attsystem";

*/


//remote database
$host = "remotemysql.com";
$username = "QFUckEO5eQ";
$pass = "WwbDq5zKub";
$db="QFUckEO5eQ";


$con=mysqli_connect($host,$username, $pass, $db) or die('Cannot connect to server');
mysqli_select_db($con,$db) or die ('Cannot found database');

?>