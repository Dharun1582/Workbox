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
        <title>Bidding Details\WorkBox</title>
        <link rel="stylesheet" href="biddetails.css">
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
            <form action="Biddingdetails.php" method="POST">
            <?php
                    if(isset($_POST['SUBMIT'])){
                        $code=$_POST['CODE'];
                        
                        $username=$_SESSION['CURRENTUSER'];
              
                        $sql="SELECT * FROM postedprojects where Sno='".$code."'";
                        $res=mysqli_query($conn,$sql);
                        $res=mysqli_fetch_assoc($res);
                        $projname=$res['Projects'];
                        $desc=$res['Description'];
                        $orgbud=$res['Budget'];
                        
                    }
                    if(isset($_POST['BIDBTN'])){
                        $username=$_SESSION['CURRENTUSER'];
                        $reason=$_POST['REASON'];
                        $bud=$_POST['BUDGET'];
                        $orb=$_POST['ORB'];
                        $pn=$_POST['PN'];
                        $cd=$_POST['SNO'];
                        
                        $sql="Insert into biddedprojects (Sno,UserName,ProjectName,Reason,MyBudget,OriginalBudget) values ('".$cd.
                        "','".$username."','".$pn."','".$reason."','".$bud."','".$orb."')";

                        mysqli_query($conn,$sql);

                        header('Location:BiddedProjects.php');
                    }
            ?>
                <table>


    

                    <tr>
                        <td class="left">Say Why you are suitable for this project</td>
                        <td class="right"><textarea name="REASON" style="margin: 0px; width: 317px; height: 165px;" required></textarea></td>
                    </tr>


                    <tr>
                        <td class="left">Enter Your Budget</td>
                        <td class="right"><input type="text" name="BUDGET" required></td>
                    </tr>


                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="submit"  value="BID" name="BIDBTN" class="btn"></td>
                    </tr>

                </table>
                <input type="text" name="ORB" value=<?php echo "'$orgbud'"?> style="display: none;" >
                <input type="text" name="PN" value=<?php echo "'$projname'"?> style="display: none;" >
                <input type="number" name="SNO" value=<?php echo "'$code'"?> style="display: none;" >
            </form>
            <br>
        </div>


    </body>
</html>


<?php mysqli_close($conn); ?>

