<?php include "connection.php" ?>
<?php
	if($_SESSION['CURRENTUSER'] != true)
	{
		mysqli_close($conn);
		header('Location:login.php');
	}
?>
<?php 
    if(isset($_POST['SUBMIT'])){
        $username=$_SESSION['CURRENTUSER'];
        $PRIMKEY=$_POST['PRIMKEY'];
    }
?>
<html>
    <head> 
        <title> Payment Portal | Work Box </title>
        <style>

        table ,th,td {					
                    padding : 3px;
                    font-family:gabriola;
                    font-size : 27px;
                }
		#logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
				width: 200px;
				height: 200px;
                
            }
        #submit {
		
        padding: 15px 32px;
        text-align: center;
        background-color: #008CBA;
        border: none;
        font-size: 20px;
        border-radius: 30px;
    
        }
		</style>

    </head>

    <body  style = "background-color: #333; color: white;">

    <img src = "logo.png" alt = "sorry! Couldn't load" id = "logo">

    <form method = "POST" action = "payment_status.php">
        <input style = "display: none;" name = "PRIMKEY" type = "number" id = "PRIMKEY" value = <?php echo "'".$PRIMKEY."'"?>>
        <table  style = "width: 30%; margin-top: 2%; margin-left: auto; margin-right: auto;">
            <tr>
                <th colspan = "2" style = "text-align: centre; font-size: 45px;">Work Box Pay</th>
            </tr>
            <tr>
                <td><label for = "payto">Pay to</label></td>
                <td><input type = "text" name = "payto" id = "payto" placeholder = "username"></td>
            </tr>
            <tr>
                <td><label for = "amt">Amount</label></td>
                <td><input type = "number" min = "0" max = "50000" name = "amt" id = "amt"></td>
            </tr>
            <tr>
                <td><label for = "pword">Password</label></td>
                <td><input type = "password" name = "pword" id = "pword"></td>
            </tr>
            <tr>
				<th colspan = "2"><button type = "submit" name = "SUBMIT" value = "Pay" id = "submit" >Pay</button></th>
			</tr>
        </table>
    </form>
    </body>
</html>

<?php mysqli_close($conn); ?>