<?php
//Start a session
session_start();
// Start the buffer
ob_start();

if ((isset($_SESSION)) && ($_SERVER["REQUEST_METHOD"] !== "POST"))
{
    session_unset();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

<style>
    p.error {
        color:darkred;
    }
</style>
</head>
<body>
    
    <?php if (isset($_SESSION['error'])) echo "<p class='error'>".$_SESSION["error"]."</p>"; ?>
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
   <form name="form1" method="post" action="checklogin.php">
    <td>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
    <td colspan="3"><strong>Member Login </strong></td>
    </tr>
    <tr>
    <td width="78">Email</td>
    <td width="6">:</td>
    <td width="294"><input name="myemail" type="text" id="myemail"></td>
    </tr>
    <tr>
    <td>Password</td>
    <td>:</td>
    <td><input name="mypassword" type="text" id="mypassword"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
    </table>
    </td>
   </form>
    </tr>
    </table>



</body>
</html>
<?php
     //Flush buffer
    ob_flush();
?>
