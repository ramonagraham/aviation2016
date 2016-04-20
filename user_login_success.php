<?php
 session_start();
 ob_start();
 
ini_set('display_errors',1); 
 error_reporting(E_ALL);



 ?>

 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
 </head>
 <body>
 <p>Login Successful</P>
 	<br>
 <form action="main.php">
 <button class="btn btn-lg btn-primary btn-block" type="submit" value="Onward">Proceed to Website</button>
</form>
 </body>
 </html>
 <?php
 //Flush buffer
 ob_flush();
?>