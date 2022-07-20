<?php
    $host="localhost";
    $useraccount="root";
    $dbname="workbox";
    $dbpassword="";
    $port=3307;
    $conn=mysqli_connect($host,$useraccount,$dbpassword,$dbname,$port);

    session_start();
?>
