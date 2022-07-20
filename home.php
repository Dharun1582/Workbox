<?php include "connection.php" ?>
<?php
	if($_SESSION['CURRENTUSER'] != true)
	{
		mysqli_close($conn);
		header('Location:login.php');
	}
?>
<html>
    <head>
        <title>Home\WorkBox</title>
        <link rel="stylesheet" href="commonstyle.css">
    </head>
    <body>
        <ul class="titlebar">
            <li style="float: left;" id="currentactive"><a href="home.php">HOME</a></li>
            <li style="float: left;"><a href="#">HOW IT WORKS</a></li>
            <li style="float: right;"><a href="login.php">Log in</a></li>
            <li style="float: right;"><a href="signup.php">Sign Up</a></li>
        </ul>
    
    </body>
</html>

<?php mysqli_close($conn); ?>