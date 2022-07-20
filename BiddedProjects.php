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
        <title>BiddedProjects\WorkBox</title>
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
            <li style="float: right;" ><a href="help.html" target="_blank">Help</a></li>
        </ul>
        <br><br>

        <?php
            if(isset($_POST['SUBMIT'])){
                $c=$_POST['CODE'];
                $sql="DELETE FROM biddedprojects WHERE Primkey='".$c."'";
                mysqli_query($conn,$sql);
            }


            $username=$_SESSION['CURRENTUSER'];
            $sql="SELECT ProjectName FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);

            $biddedproj = Array();
            $length=0;
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $biddedproj[] =  $row['ProjectName'];
                $length=$length+1;  
            }   

            $sql="SELECT Reason FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);
            $reasons = Array();
           
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $reasons[] =  $row['Reason'];
                 
            } 

            $sql="SELECT OriginalBudget FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);

            $ogb = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $ogb[] =  $row['OriginalBudget'];   
            } 

            
            $sql="SELECT MyBudget FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);

            $myb = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $myb[] =  $row['MyBudget'];   
            } 
            
 

            $sql="SELECT Primkey FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);

            $code = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $code[] =  $row['Primkey'];   
            } 

            $sql="SELECT Bidtime FROM biddedprojects WHERE UserName='".$username."' ORDER BY Bidtime DESC";
            $res=mysqli_query($conn,$sql);

            $bdtim = Array();
            
            while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                $bdtim[] =  $row['Bidtime'];   
            } 
            
        ?>

        <?php
            for($i=0;$i<$length;$i++){
                
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<form action='BiddedProjects.php' method='POST' style='width:fit-content;display:inline-block'>";
                echo "<div class='card'>";
                echo "<img src='3.jpg'  style='width:100%;height:200px'>";
                echo " <div class='container'>";
                echo "<h3><b>".$biddedproj[$i]."</b></h3>";
                echo "<h8>Bidded at ".$bdtim[$i]."</h8>";
                echo "<h3>Original Budget:".$ogb[$i]."</h3>";
                echo "<h3>My Budget:".$myb[$i]."</h3>";
                echo "<textarea rows='2' width='500px' style='margin: 0px; width: 234px; height: 67px;' readonly>".$reasons[$i]."</textarea>";
                echo "<br><br></div>";
                echo "<input type='number' name='CODE' value='".$code[$i]."' readonly style='display:none;'>";
                echo "<input type='submit' name='SUBMIT' value='DELETE BID' class='btn'>";
                echo "</div>";
                echo "</form>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if($i==4){
                    echo "<br><br><br><br>";
                }
            }
        ?>
        <br><br>

    </body>
</html>


<?php mysqli_close($conn); ?>