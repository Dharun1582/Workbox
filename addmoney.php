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
        $PRIMKEY = $_POST['PRIMKEY'];
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
    <body>
        <img src = "logo.png" alt = "sorry! Couldn't load" id = "logo">
        <br><br>
        <form method = "POST" action = "addmoney_status.php">
            <input style = "display: none;" name = "PRIMKEY" type = "number" id = "PRIMKEY" value = <?php echo "'".$PRIMKEY."'"?>>

            <table style = "width: 30%; margin-top: 2%; margin-left: auto; margin-right: auto;">
                <tr>
                    <th colspan = "2" style = "text-align: centre; font-size: 45px;">Work Box Pay</th>
                </tr>
                <tr>
                    <th colspan = "2" style = "text-align: centre; font-size: 27px;">Add Money</th>
                </tr>
                <tr>
                    <td><label for = "amt">Amount</label></td>
                    <td><input type = "number" min = "0" max = "20000" name = "amt" id = "amt"></td>
                </tr>
                <tr>
				    <th colspan = "2"><button type = "submit" name = "SUBMIT" value = "Add" id = "submit" >Add</button></th>
			    </tr>
            </table>
        </form>
    </body>
</html>
<?php mysqli_close($conn); ?>
