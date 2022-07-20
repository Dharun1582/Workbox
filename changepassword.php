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
    $password=$res['Password'];
    $designation=$res['Designation'];

    $jointime=$res['JoinTime'];

?>
<html>
    <head>
        <title>Change Password\WorkBox</title>
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
                        <a href="viewprofile.php">View Profile</a>
                        <a href="editprofile.php">Edit Profile</a>
                        <a href="changepassword.php" class="active">Change Password</a>
                        <a href="logout.php">Logout</a>
                    </span>
                </span>
            </li>
            <li style="float: right;" ><a href="help.html" target="_blank">Help</a></li>
    </ul>

    <br><br>

    <form method="POST" action="changepassword.php">
            <?php
                    if(isset($_POST['SUBMIT'])){
                        if($password!=$_POST['OP']){
                            echo "<div style='color:red;text-align:center;font-size:x-large'>Old Password does not match</div>";
                        }else{
                            $sql="UPDATE profile SET Password='".$_POST['NP']."' WHERE Username='".$_SESSION['CURRENTUSER']."'"; 
                            echo $sql;
                            if(!(mysqli_query($conn,$sql))){
                                echo "ERROR";
                            }else{
                                header("Location:viewprofile.php");
                            }
                        }
                    }
            ?>
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
                    <td class="left">Old Password</td>
                    <td class="right"><input type="password" name="OP"  required></td>
                </tr>
                <tr >
                    <td class="left">New Password</td>
                    <td class="right"><input type="password" name="NP" id="NP1"  required></td>
                </tr>
                <tr>
                    <td class="left">Confirm New Password</td>
                    <td class="right"><input type="password"  id="NP2" onkeyup="chkpass()" required></td>
                </tr>
                <tr id="incpass" style="display: none;">
                    <td colspan="2" style="color:red;font-size:large;">The two passwords do not match</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="button"  value="Change" class="btn" id="fake" style="display: none;">
                        <input type="submit"  name="SUBMIT" value="Change" class="btn" id="real"></td>
                </tr>

                <script>
                    function chkpass(){
                        var p1=document.getElementById('NP1').value;
                        var p2=document.getElementById('NP2').value;
                        console.log(p1)
                    if(p1!=""){
                        if(p1!=p2){
                            document.getElementById('incpass').style.display="inline";
                            document.getElementById('fake').style.display="inline";
                            document.getElementById('real').style.display="none";

                        }else if(p1==p2){
                            document.getElementById('incpass').style.display="none";
                            document.getElementById('fake').style.display="none";
                            document.getElementById('real').style.display="inline";
                        }
                    }
                    }

                </script>
          
                

            </table>
        </form>

    </body>
</html>


<?php mysqli_close($conn); ?>