<?php include "connection.php" ?>
<?php
	if(isset($_SESSION['CURRENTUSER']))
	{
		header('location:Dashboard.php');
	}
?>

<html>
    <head>
        <title>WorkBox | Login</title>
        <link rel="stylesheet" href="commonstyle.css">
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
            
            <li style="float: right;" id="currentactive"><a href="login.php">Log in</a></li>
            <li style="float: right;"><a href="signup.php">Sign Up</a></li>
            <li style="float: right;"><a href="help.html" target="_blank">Help</a></li>
        </ul>
        <br><br>
        <div class="logo">
            <img src="logo.png" width="400px" height="300px">
        </div>

        <div class="form"> 
            <form method="POST" action="login.php">
                <?php
                    if(isset($_POST['SUBMIT'])){
                        $username=$_POST['USERNAME'];
                        $password=$_POST['PASSWORD'];
                        $sql="SELECT * FROM profile WHERE UserName='".$username."'";
                        $res=mysqli_query($conn,$sql);
                        
                        if($res){
                            $res=mysqli_fetch_assoc($res);
                            
                            if(!$res){
                                echo "<div style='color:red;text-align:center;font-size:x-large'>Invalid UserName</div>";
                            }else{
                            if($password==$res['Password']){
                                $_SESSION['CURRENTUSER']=$username;
                                header("Location:Dashboard.php");
                            }else{
                                echo "<div style='color:red;text-align:center;font-size:x-large'>Incorrect Password</div>";
                            }
                        }
                        }else{
                            echo "<b>Login Error</b>";
                        }
                    }
                ?>
                <input type="text" name="USERNAME" placeholder="Enter Username" required><br><br>
                <input type="password" name="PASSWORD" placeholder="Enter Password" required><br><br>
                <input type="submit" name="SUBMIT" value="Log In" style="color:white;background-color:rgb(1, 101, 252);"><br><br>
                <a href="signup.php" style="font-size: large;color:rgb(1, 101, 252)">Do not have an account? SignUp</a>
            </form>
            
        </div>
        
    </body>
</html>


<?php mysqli_close($conn); ?>