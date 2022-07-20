<?php include "connection.php" ?>
<?php
	if(isset($_SESSION['CURRENTUSER']))
	{
		header('location:Dashboard.php');
	}
?>
<html>
    <head>
        <title>SignUp\WorkBox</title>
        <link rel="stylesheet" href="commonstyle.css">
    </head>
    <body>
    <ul class="titlebar">
           
            
            <li style="float: right;" ><a href="login.php">Log in</a></li>
            <li style="float: right;" id="currentactive"><a href="signup.php">Sign Up</a></li>
            <li style="float: right;"><a href="help.html" target="_blank">Help</a></li>
        </ul>
        <br><br>
        <div class="logo">
        <img src="logo.png" width="400px" height="300px">
        </div>

        <div class="form"> 
            <form method="POST" action="signup.php">
                <?php
                    if(isset($_POST['SUBMIT'])){
                        $sql="Insert into profile (Name,UserName,Email,MobileNumber,City,Country,Designation,SkillSet,Password) values ('".$_POST['NAME'].
                        "','".$_POST['USERNAME']."','".$_POST['MAILID']."','".$_POST['NUMBER']."','".$_POST['CITY']."','".$_POST['COUNTRY']."','".$_POST['DESIGNATION']."','".$_POST['SKILLS']."','".$_POST['PASSWORD']."')";
                        if(!(mysqli_query($conn,$sql))){
                            echo "<b style='color:red'>Username or mail already exists try a new username</b>";
                        }else{
                            header("Location:login.php");
                        }
                    }
                ?>


                <input type="text" name="NAME" placeholder="Enter Name" required><br><br>
                <input type="text" name="USERNAME" placeholder="Enter Username" required><br><br>
                <input type="email" name="MAILID" placeholder="Enter MAIL-ID" required><br><br>
                <input type="number" name="NUMBER" placeholder="Enter Mobile Number" required><br><br>

                <input type="text" name="CITY" placeholder="CITY" required><br><br>
                <input type="text" name="COUNTRY" placeholder="COUNTRY" required><br><br>

                <input type="text" name="DESIGNATION" placeholder="Designation" required><br><br>

                <textarea name="SKILLS" placeholder="Enter your Skill Set" rows="6" style="margin: 0px; width: 745px; height: 172px;" required=""></textarea><br><br>
                <input type="password" name="PASSWORD" placeholder="Enter Password" id="p1" required><br><br>
                <input type="password"  placeholder="Enter Password again" id="p2" onkeyup="chkpass()" required><br>
                <span style="color:red;display:none" id="incpass">The two passwords does not match</span>
                <br><br>
                
                <script>
                    function chkpass(){
                        var p1=document.getElementById('p1').value;
                        var p2=document.getElementById('p2').value;
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
                <input type="button" style="color:white;background-color:rgb(1, 101, 252);display:none" value="Sign Up" id="fake">
                <input type="submit" name="SUBMIT" value="Sign Up" style="color:white;background-color:rgb(1, 101, 252);" id="real"><br><br>
                
            </form>
            
        </div>
        
    </body>
</html>


<?php mysqli_close($conn); ?>