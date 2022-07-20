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
        <title> Transaction Status </title>
        <style>
        body{
            background-color: rgba(172, 172, 179, 0.95);
            background-repeat: no-repeat;
            background-size: 100%;
        }
        #logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
				width: 200px;
				height: 200px;
                
            }
        </style>
    </head>
    <body>
        <img src = "logo.png" alt = "sorry! Couldn't load" id = "logo">
    </body>
</html>

<?php
    if(isset($_POST['SUBMIT'])){
        $username=$_SESSION['CURRENTUSER'];
        $amt = $_POST['amt'];
        $PRIMKEY = $_POST['PRIMKEY'];
        $sql="SELECT * FROM profile WHERE UserName='".$username."'";
        $res=mysqli_query($conn,$sql);
        
        if($res){
            $res=mysqli_fetch_assoc($res);
            $wallet = $res['Wallet'] + $amt;

            $sql1 = "UPDATE profile SET Wallet = '".$wallet."' WHERE UserName = '".$username."'";
            $res1 = mysqli_query($conn,$sql1);
            if ($res1) {
                echo "<div style='color:green;text-align:center;font-size:x-large;'>Transaction Succesful</div><br>";
                echo "<div><form method = 'POST' action = 'payment.php'> <input style = 'display: none;' name = 'PRIMKEY' type = 'number' id = 'PRIMKEY' value ='".$PRIMKEY."'> <button type = 'submit' id = 'submit' name = 'SUBMIT' onclick = 'location: payment.php' style = 'text-align:center; font-size:x-large; border: none; border-radius: 25px;'>Payment Portal</button></form></div>";
                echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";

            } 
            else{
                echo "<div style='color:red;text-align:center;font-size:x-large'>Transaction Error</div><br>";
                echo "<div> <a href = 'addmoney.php' style = 'text-align:center; font-size:x-large;'> Try Again?</a></div><br>";
                echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";

            }
        }
        else{
            echo "<div style='color:red;text-align:center;font-size:x-large'>Error Occured </div><br>";
            echo "<div> <a href = 'addmoney.php' style = 'text-align:center; font-size:x-large;'> Try Again?</a></div><br>";
            echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";

        }
    }
?>
<?php mysqli_close($conn); ?>