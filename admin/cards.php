<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
ob_start();

 if(empty($_SESSION["myemail"])){
    session_unset();
    header("location:index.php");
 }
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cards</title>
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css">  

    
  </head>
  <body>
    <?php
    
        $tbl_name="Cards"; // Table name 
    
        //Connect to the database
        require "../db.php";
    
        try {
            $dbh = new PDO("mysql:host=$hostname;
                           dbname=caseym_Aviation", $username, $password);
           
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    
    ?>
    <h2>Card Maintenance</h2>
    <div class="row">
        <div class="col-md-2" >
            <ul class="nav nav-pills nav-stacked">

            <?php
              // Nav buttons
              $options = array("list cards" => "cardsList", "add card" => "cardAdd", "delete card" => "cardDelete");
              
              foreach ($options as $index => $detail) {
                echo "<li ";
                if ($_GET['nav'] == $detail){
                  echo "class='active' ";
                };
                echo "><a href='?page=cards&nav=".$detail."'>";
                echo ucwords($index);
                echo "</a></li>";
              }
            ?>
            </ul>
        </div>
        <div class="col-md-10">
            <!-- Page content goes here -->
            <?php
              if (isset($_GET['nav']))
              {
                $nav = $_GET['nav'];
              }else{
                $nav = "cardsList"; //Default
              }
              include ($nav.".php");
            ?>
        </div>
    </div>


    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    
    
  </body>
</html>

<?php
 //Flush buffer
 ob_flush();
?>