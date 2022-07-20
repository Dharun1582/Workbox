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
        <title>Bidproject\WorkBox</title>
        <link rel="stylesheet" href="Bidproj.css">
    </head>
    <body>
        <ul class="titlebar">
            <li style="float: left;"  ><a href="Dashboard.php">DASHBOARD</a></li>
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
        <br><br><br><br>
        
        <?php
            $sql="SELECT * FROM postedprojects WHERE Status='On Going' AND UserName<>'".$_SESSION['CURRENTUSER']."' ORDER BY CreatedTime DESC";
            $postedproj = Array();
            $projdesc = Array();
            $projtime = Array();
            $code = Array();
            $projbudget=Array();
            $length=0;
            $res=mysqli_query($conn,$sql);

            if($res){
                while ($row = mysqli_fetch_assoc($res)) {
                    $postedproj[]=$row['Projects'];
                    $projdesc[]=$row['Description'];
                    $projtime[]=$row['CreatedTime'];
                    $code[]=$row['Sno'];
                    $projbudget[]=$row['Budget'];
                    $length=$length+1;
                } 
            }
        ?>

        <?php
            for($i=0;$i<$length;$i++){
                
                echo "&nbsp";
                echo "<form action='BiddingDetails.php' method='POST' style='width:fit-content;display:inline-block'>";
                echo "<div class='card'>";
                echo "<img src='2.jpg'  style='width:100%;height:200px'>";
                echo " <div class='container'>";
                echo "<h3><b>".$postedproj[$i]."</b></h3>";
                echo "<h8>Posted at ".$projtime[$i]."</h8><br><br>";
                echo "<h3>Budget:".$projbudget[$i]."</h3>";
                echo "<textarea rows='2' width='500px' style='margin: 0px; width: 234px; height: 67px;' readonly>".$projdesc[$i]."</textarea>";
                echo "<br><br></div>";
                echo "<input type='number' name='CODE' value='".$code[$i]."' readonly style='display:none;'>";
                echo "<input type='submit' name='SUBMIT' value='BID' class='btn'>";
                echo "</div>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp";
                echo "</form>";
     
            }
        ?>
        <br><br>
    </body>
</html>


<?php mysqli_close($conn); ?>