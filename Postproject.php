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
        <title>Post Project\WorkBox</title>
        <link rel="stylesheet" href="postproj.css">
    </head>
    <body>
        <ul class="titlebar">
            <li style="float: left;" ><a href="Dashboard.php">DASHBOARD</a></li>
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
        <br><br>
        <div class="card">
            <form action="Postproject.php" method="POST">
            <?php
                    if(isset($_POST['SUBMIT'])){
                        $username=$_SESSION['CURRENTUSER'];
                        $projname=$_POST['PROJNAME'];
                        $desc=$_POST['DESCRIPTION'];
                        $status=$_POST['STATUS'];
                        $budget=$_POST['BUDGET'];

                        $sql="INSERT INTO postedprojects (UserName,Projects,Description,Budget,Status) VALUES('".$username."','".$projname."','".$desc."','".$budget."','".$status."')";
               
                        if(!(mysqli_query($conn,$sql))){
                            echo "<div style='color:red;text-align:center;font-size:x-large'>ERROR</div>";
                            echo "$conn->error()";
                        }else{
                            $sql="SELECT LAST_INSERT_ID()";
                            $res=mysqli_query($conn,$sql);
                            $res=mysqli_fetch_array($res);
                            
                            $sql="INSERT INTO projectstatus (Sno,Status) VALUES ('".$res[0]."','0')";
                            $res=mysqli_query($conn,$sql);
                            header("Location:postedprojects.php");
                        }

                        
                    }
            ?>
                <table>
                    <tr>
                        <td class="left">Enter Project Name</td>
                        <td class="right"><input type="text" name="PROJNAME" required></td>
                    </tr>

    

                    <tr>
                        <td class="left">Description</td>
                        <td class="right"><textarea name="DESCRIPTION" style="margin: 0px; width: 317px; height: 165px;" required></textarea></td>
                    </tr>


                    <tr>
                        <td class="left">Budget</td>
                        <td class="right"><input type="text" name="BUDGET" required></td>
                    </tr>

                    <tr>
                        <td class="left">Status</td>
                        <td class="right">
                            <input type="text" name="STATUS" value="On Going" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="submit"  value="POST" name="SUBMIT" class="btn"></td>
                    </tr>

                </table>
            </form>
            <br>
        </div>


    </body>
</html>


<?php mysqli_close($conn); ?>

