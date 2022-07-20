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
        <title>Dashboard | WorkBox</title>
        <link rel="stylesheet" href="dashboardcss.css">
		<script type = "text/javascript" >
				function preventBack()
				{
					window.history.forward()
				}
				setTimeout("preventBack", 0);
				window.onunload = function(){null;}
		</script>
    </head>
    <body>
        <ul class="titlebar">
            <li style="float: left;" id="currentactive" ><a href="Dashboard.php">DASHBOARD</a></li>
            <li style="float: left;" ><a href="myprojects.php">My Projects</a></li>
            <li style="float: right;" >
                <span class="dropdown">
                    Profile
                    <span class="dropdown-content">
                        <a href="viewprofile.php">View Profile</a>
                        <a href="editprofile.php">Edit Profile</a>
                        <a href="changepassword.php">Change Password</a>
                        <a href="logout.php">Logout</a>
                    </span>
                </span>
            </li>
            <li style="float: right;" ><a href="help.html" target="_blank">Help</a></li>
        </ul>
        <br><br><br><br><br><br><br><br>
    
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
        <a href="myprojects.php" style="color:black">
        <div class="card">
            <img src="myp.png"  style="width:100%;height:200px">
            <div class="container">
                <h4 style="font-size: xx-large;text-align:center"><b>My Projects</b></h4> 
                
            </div>
        </div>
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="Postproject.php" style="color:black">
        <div class="card">
            <img src="post.png" style="width:100%;height:200px">
            <div class="container">
                <h4 style="font-size: xx-large;text-align:center"><b>Post a Project</b></h4> 
                 
            </div>
        </div>
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="Bidproject.php" style="color:black">
        <div class="card">
            <img src="bid.jpg"  style="width:100%;height:200px">
            <div class="container">
                <h4 style="font-size: xx-large;text-align:center"><b>Bid a Project</b></h4> 
                
            </div>
        </div>
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       
    </body>
</html>


<?php mysqli_close($conn); ?>