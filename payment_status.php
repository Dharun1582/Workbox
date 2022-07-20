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
        $payto=$_POST['payto'];
        $password=$_POST['pword'];
        $amt = $_POST['amt'];
        $PRIMKEY = $_POST['PRIMKEY'];
        $sql1="SELECT * FROM profile WHERE UserName='".$username."'";
        $sql2="SELECT * FROM profile WHERE UserName='".$payto."'";
        $res1=mysqli_query($conn,$sql1);
        $res2=mysqli_query($conn,$sql2);
        
        if($res1 && $res2){
            $res1=mysqli_fetch_assoc($res1);
            $res2=mysqli_fetch_assoc($res2);
            $wallet = $res1['Wallet'];
            $pwallet = $res2['Wallet'];
            
            if($wallet <= $amt){
                echo "<div style='color:red;text-align:center;font-size:x-large;'>Check Your Balance</div>";
                echo "<div><form method = 'POST' action = 'addmoney.php'> <input style = 'display: none;' name = 'PRIMKEY' type = 'number' id = 'PRIMKEY' value ='".$PRIMKEY."'> <button type = 'submit' id = 'submit' name = 'SUBMIT' onclick = 'location: addmoney.php' style = 'text-align:center; font-size:x-large; border: none; border-radius: 25px;'> Add money</button></form></div>";
            }else{
            if($password==$res1['Password']){
                $wallet1 = $wallet - $amt;
                $wallet2 = $pwallet + $amt;
                $sql11 = "UPDATE profile SET Wallet = '".$wallet1."' WHERE UserName = '".$username."'";
                $sql22 = "UPDATE profile SET Wallet = '".$wallet2."' WHERE UserName = '".$payto."'";
                $res11 = mysqli_query($conn,$sql11);
                $res22 = mysqli_query($conn,$sql22);
                if ($res11 && $res22) {
                    echo "<div style='color:green;text-align:center;font-size:x-large;'>Transaction Succesful!</div><br><br>";
                    $sql12 = "UPDATE biddedprojects SET PAYMENT = 1 WHERE Primkey = '".$PRIMKEY."'";
                    $res12 = mysqli_query($conn, $sql12);
                    echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";
                  } 
            }else{
                echo "<div style='color:red;text-align:center;font-size:x-large'>Incorrect Password</div><br>";
                echo "<div> <a href = 'payment.php' style = 'text-align:center; font-size:x-large;'> Try Again?</a></div><br>";
                echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";

            }
        }
        }else{
            echo "<div style='color:red;text-align:center;font-size:x-large'>Transaction Error</div><br>";
            echo "<div> <a href = 'payment.php' style = ' text-align:center; font-size:x-large;'> Try Again?</a></div><br>";
            echo "<div> <a href = 'dashboard.php' style = 'text-align:center; font-size:x-large;'> Go To Home</a></div>";

        }
    }
?>
<?php mysqli_close($conn); ?>