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
        <title>PostedProjects\WorkBox</title>
        <link rel="stylesheet" href="myproj.css">
    </head>
    <body>
        <ul class="titlebar">
            <li style="float: left;" ><a href="Dashboard.php">DASHBOARD</a></li>
            <li style="float: left;" id="currentactive"><a href="myprojects.php">My Projects</a></li>
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
            <li style="float: right;" ><a href="#">Help</a></li>
        </ul>
        <br><br>

        <?php
            $username=$_SESSION['CURRENTUSER'];
            $sql="SELECT Projects FROM postedprojects WHERE UserName='".$username."'";
            $res=mysqli_query($conn,$sql);

            $postedproj = Array();
            $length=0;
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $postedproj[] =  $row['Projects'];
                $length=$length+1;  
            }   

            $sql="SELECT Description FROM postedprojects WHERE UserName='".$username."'";
            $res=mysqli_query($conn,$sql);
            $projdesc = Array();
           
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $projdesc[] =  $row['Description'];
                 
            } 

            $sql="SELECT Status FROM postedprojects WHERE UserName='".$username."'";
            $res=mysqli_query($conn,$sql);

            $projstatus = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $projstatus[] =  $row['Status'];   
            } 
            
            $sql="SELECT CreatedTime FROM postedprojects WHERE UserName='".$username."'";
            $res=mysqli_query($conn,$sql);

            $projtime = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $projtime[] =  $row['CreatedTime']; 
            } 

            $sql="SELECT Sno FROM postedprojects WHERE UserName='".$username."'";
            $res=mysqli_query($conn,$sql);

            $code = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $code[] =  $row['Sno'];   
            } 
            
        ?>

        <?php
            for($i=0;$i<$length;$i++){
                echo "&nbsp;";
                echo "<div class='card'>";
                echo "<img src='metallicblue.jpg' alt='Avatar' style='width:100%'>";
                echo " <div class='container'>";
                echo "<h3><b>".$postedproj[$i]."</b></h3>";
                echo "<h8>Posted at ".$projtime[$i]."</h8>";
                echo "<h4><b>Status : ".$projstatus[$i]."</b></h3>";
                echo "<textarea rows='2' width='500px' style='margin: 0px; width: 234px; height: 67px;' readonly>".$projdesc[$i]."</textarea>";
                echo "<br><br></div>";
                echo "</div>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if($i==4){
                    echo "<br><br><br><br>";
                }
            }
        ?>
        <br><br>
        <input class="btn" type="button" value="Edit" onclick="location.href='editpostedprojects.php'" >
    </body>
</html>


<?php mysqli_close($conn); ?>