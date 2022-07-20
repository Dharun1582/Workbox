<?php include "connection.php" ?>
<?php
	if($_SESSION['CURRENTUSER'] != true)
	{
		mysqli_close($conn);
		header('Location:login.php');
	}
?>
<?php
    if(isset($_POST['HO'])){
        $sql="UPDATE projectstatus SET Status='1' WHERE Sno='".$_POST['CD']."'";
        $res=mysqli_query($conn,$sql);
        // $mres=mysqli_fetch_array($res);

        $sql="SELECT * FROM biddedprojects  WHERE Primkey='".$_POST['PK']."'";
        $res=mysqli_query($conn,$sql);
        $ass=mysqli_fetch_assoc($res);

        $sql="DELETE FROM biddedprojects  WHERE Sno='".$_POST['CD']."'";
        $res=mysqli_query($conn,$sql);

       
        $sql="INSERT INTO biddedprojects (Sno,UserName,ProjectName,Reason,OriginalBudget,MyBudget,Bidtime,Primkey) VALUES('".$ass['Sno']."','".$ass['UserName']."','".$ass['ProjectName'].
        "','".$ass['Reason']."','".$ass['OriginalBudget']."','".$ass['MyBudget']."','".$ass['Bidtime']."','".$ass['Primkey']."')";
        mysqli_query($conn,$sql);
        
        $flag=2;

        $sql="UPDATE postedprojects SET Status='COMPLETED' WHERE Sno='".$_POST['CD']."'";
        mysqli_query($conn,$sql);

    }
    
?>

<html>
    
    <head>
        <title>Bidders\WorkBox</title>
        <link rel="stylesheet" href="Bidderscss.css">
    </head>
<?php
    if(isset($_POST['SUBMIT'])){
        $c=$_POST['CODE'];
            $sql="DELETE FROM postedprojects WHERE Sno='".$c."'";
            mysqli_query($conn,$sql);
            $sql="DELETE FROM biddedprojects WHERE Sno='".$c."'";
            mysqli_query($conn,$sql);
            $sql="DELETE FROM projectstatus WHERE Sno='".$c."'";
            mysqli_query($conn,$sql);
            header('Location:postedprojects.php');
    }

    if(isset($_POST['VIEW'])){

        $sql="SELECT Status FROM projectstatus WHERE Sno='".$_POST['CODE']."'";
        $res=mysqli_query($conn,$sql);
        $res=mysqli_fetch_array($res);
        $flag=0;
        if($res[0]==1){
            
            $flag=1;
            $sql="SELECT * FROM biddedprojects WHERE Sno='".$_POST['CODE']."'";
            $code=$_POST['CODE'];
            
            $res=mysqli_query($conn,$sql);
            $ass=mysqli_fetch_assoc($res);
            
        }
        else{
        $sql="SELECT * FROM biddedprojects WHERE Sno='".$_POST['CODE']."'";
        $code=$_POST['CODE'];
        $res=mysqli_query($conn,$sql);
        $un=Array();
        $am=Array();
        $bt=Array();
        $rs=Array();
        $pk=Array();
        $prname;
        $length=0;
        if($res){
            while ($row = mysqli_fetch_assoc($res)) {
                
                
                $un[]=$row['UserName'];
                $am[]=$row['MyBudget'];
                $bt[]=$row['Bidtime'];
                $rs[]=$row['Reason'];
                $pk[]=$row['Primkey'];
                if($length==0){
                    $prname=$row['ProjectName'];
                }
                $length=$length+1;
            } 
            
        }
        }
    }
?>

    <body>
        <ul class="titlebar">
            <li style="float: left;" ><a href="Dashboard.php">DASHBOARD</a></li>
            <li style="float: left;" id="currentactive"><a href="myprojects.php">My Projects</a></li>
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
        

        <?php
        if($flag==0){
            if($length==0){
                echo "<div style='text-align:center;font-size:50px;'>No Bidders Yet </div>"; 
            }
            else{
                echo "<table>";
                echo "<tr><th colspan='6' class='tt'>$prname</th></tr>";
                echo "<tr><th>Username</th><th>Amount</th><th>Bidtime</th><th>Reason</th><th></th><th></th></tr>";
                for($i=0;$i<$length;$i++){
                    echo "<tr><form method='POST' action='Bidders.php'><td>$un[$i]</td><td>$am[$i]</td><td>$bt[$i]</td><td>$rs[$i]</td>
                    <td>
                    <input type='submit' name='HO' class='btnvw' value='HAND OVER' ><input type='text' value='".$pk[$i]."' name='PK' style='display:none'>
                    <input type='text' name='CD' value='".$code."' style='display:none'>
                    </td></form><td><form action='vp.php' method='POST' target='_blank'> <input type='text' name='VP' value='".$un[$i]."' style='display:none;'>
                    <input type='submit' name='SUBMIT' value='View profile' class='btnvwp'>
                </form></td></tr>";
                }
                echo "</table>";
            }
        }else if($flag==2){
            echo "<table>";
            echo "<tr><th colspan='6' class='tt'>".$ass['ProjectName']."</th></tr>";
            echo "<tr><th>Username</th><th>Amount</th><th>Bidtime</th><th>Reason</th><th></th><th></th></tr>";
            
                echo "<tr><form method='POST' action='payment.php'><td>".$ass['UserName']."</td><td>".$ass['MyBudget']."</td><td>".$ass['Bidtime']."</td><td>".$ass['Reason']."
                <input type='text' value='".$ass['Primkey']."' name='PRIMKEY' style='display:none'></td>";
                
               if($ass['PAYMENT']==0){
                echo "<td><input type='submit' name='SUBMIT' class='btnvw' value='PAY'>
                </form></td><td><form action='vp.php' method='POST' target='_blank'> <input type='text' name='VP' value='".$ass['UserName']."' style='display:none;'>
                <input type='submit' name='SUBMIT' value='View profile' class='btnvwp'>
            </form></td></tr>";
               } else{
                echo "<td><input type='button' name='HO' class='btn' value='PAID' readonly>
                </form></td><td><form action='vp.php' method='POST' target='_blank'> <input type='text' name='VP' value='".$ass['UserName']."' style='display:none;'>
                <input type='submit' name='SUBMIT' value='View profile' class='btnvwp'>
            </form></td></tr>";
               }
               
           
                echo "</table>";
        }else if($flag==1){
            echo "<table>";
            echo "<tr><th colspan='6' class='tt'>".$ass['ProjectName']."</th></tr>";
            echo "<tr><th>Username</th><th>Amount</th><th>Bidtime</th><th>Reason</th><th></th><th></th></tr>";
            
                echo "<tr><form method='POST' action='payment.php'><td>".$ass['UserName']."</td><td>".$ass['MyBudget']."</td><td>".$ass['Bidtime']."</td><td>".$ass['Reason']."
                <input type='text' value='".$ass['Primkey']."' name='PRIMKEY' style='display:none'></td>";
                
               if($ass['PAYMENT']==0){
                echo "<td><input type='submit' name='SUBMIT' class='btnvw' value='PAY'>
                </form></td><td><form action='vp.php' method='POST' target='_blank'> <input type='text' name='VP' value='".$ass['UserName']."' style='display:none;'>
                <input type='submit' name='SUBMIT' value='View profile' class='btnvwp'>
            </form></td></tr>";
               } else{
                echo "<td><input type='button' name='HO' class='btn' value='PAID' readonly>
                </form></td><td><form action='vp.php' method='POST' target='_blank'> <input type='text' name='VP' value='".$ass['UserName']."' style='display:none;'>
                <input type='submit' name='SUBMIT' value='View profile' class='btnvwp'>
            </form></td></tr>";
               }
               
           
                echo "</table>";
        }
        ?>
    </body>
</html>




<?php mysqli_close($conn); ?>