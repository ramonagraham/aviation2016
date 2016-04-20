<?php

//Start a session
session_start();
// Start the buffer
ob_start();
 
$tbl_name="UserInfo"; // Table name 

//Connect to the database
    require "db.php";

    try {
        $dbh = new PDO("mysql:host=$hostname;
                       dbname=caseym_Aviation", $username, $password);
        echo "Connected to database.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

if(isset($_POST[Submit]))
{
    // username and password sent from form 
     $myemail=$_POST['myemail']; 
     $mypassword=$_POST['mypassword']; 
    
    // To protect MySQL injection
    $myemail = htmlspecialchars($myemail);
    $mypassword = htmlspecialchars($mypassword);
    
    $sql="SELECT * FROM $tbl_name WHERE email='$myemail' and password='$mypassword'";
    $result = $dbh->query($sql);
    
    
    
    // Counting table row
     $count=$result->rowCount();
    
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($count==1){
    
    // Register $myusername, $mypassword and redirect to file "login_success.php"
     $_SESSION["myemail"] = $myemail;
     header("Location:login_success.php");
     }
     else {
     // Records an error and goes back to index
     $_SESSION["error"] = "Wrong Username or Password";
     header("Location:adminIndex.php");
     }
}

//Flush buffer
ob_flush();
 ?>
