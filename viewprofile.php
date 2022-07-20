<?php include "connection.php" ?>
<?php
	if($_SESSION['CURRENTUSER'] != true)
	{
		mysqli_close($conn);
		header('Location:login.php');
	}
?>
<?php
    $username=$_SESSION['CURRENTUSER'];
    $sql="SELECT * FROM profile where UserName='".$username."'";
    $res=mysqli_query($conn,$sql);
    if($res){
        $res=mysqli_fetch_assoc($res);
    }
    $name=$res['Name'];
    $email=$res['Email'];
    $mobilenumber=$res['MobileNumber'];
    $city=$res['City'];
    $country=$res['Country'];
    $designation=$res['Designation'];
    $skillset=$res['SkillSet'];
    $jointime=$res['JoinTime'];
?>
<html>
    <head>
        <title>ViewProfile\WorkBox</title>
        <link rel="stylesheet" href="profile.css">
    </head>
    <body>
    <ul class="titlebar">
            <li style="float: left;" ><a href="Dashboard.php">DASHBOARD</a></li>
            <li style="float: left;" ><a href="myprojects.php">My Projects</a></li>
            <li style="float: right;" id="currentactive">
                <span class="dropdown">
                    Profile
                    <span class="dropdown-content">
                        <a href="viewprofile.php" class="active">View Profile</a>
                        <a href="editprofile.php">Edit Profile</a>
                        <a href="changepassword.php">Change Password</a>
                        <a href="logout.php">Logout</a>
                    </span>
                </span>
            </li>
            <li style="float: right;" ><a href="help.html" target="_blank">Help</a></li>
    </ul>
    <br><br>

    <form method="POST">
            <table >
                <tr >
                    <th colspan="2" >
                        <?php echo "$username" ?><br>
                        <div style="font-size: small;font-family:'Courier New', Courier, monospace">
                           <?php echo "$designation" ?><br>
                            Joined at <?php echo "$jointime" ?><br>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="left">Name</td>
                    <td class="right"><input type="text" name="NAME" value="<?php echo $name ?>" readonly></td>
                </tr>
                <tr >
                    <td class="left">UserName</td>
                    <td class="right"><input type="text" name="USERNAME" value="<?php echo $username ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">Email</td>
                    <td class="right"><input type="email" name="MAILID" value="<?php echo $email ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">MobileNumber</td>
                    <td class="right"> <input type="number" name="NUMBER" value="<?php echo $mobilenumber ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">City</td>
                    <td class="right"><input type="text" name="CITY" value="<?php echo $city ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">Country</td>
                    <td class="right"> <input type="text" name="COUNTRY" value="<?php echo $country ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">Designation</td>
                    <td class="right"><input type="text" name="DESIGNATION" value="<?php echo $designation ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left">SkillSet</td>
                    <td class="right">
                        <textarea name="SKILLS" rows="6" style="margin: 0px; width: 312px; height: 128px;" readonly=""><?php echo $skillset ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="button" onclick="location.href='editprofile.php'" value="Edit" class="btn"></td>
                </tr>

            </table>
        </form>

    </body>
</html>


<?php mysqli_close($conn); ?>