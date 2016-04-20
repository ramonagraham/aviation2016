<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
ob_start();
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Card Input</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <?php
    //Connect to the database
    require "db.php";

    try {
        $dbh = new PDO("mysql:host=$hostname;
        dbname=caseym_Aviation", $username, $password);
        echo "Connected to database.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        echo "Form was submitted.";
        
        //Flag variable for valid data
        $valid = true;
    
  
      //Image upload process
        $target_dir = "section1/";
        $target_file = $target_dir . basename($_FILES["inputFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["inputFile"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["inputFile"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
  ?>
    <form role="form" action="addCard.php" method="post" enctype="multipart/form-data">
     <div class="form-group">
        <label>Choose a Section to save too:</label>
        <select class="inputFormat" name="section" id="section">
          
          <?php
            //Display the Available sections to add too
              $sql="SELECT MAX(secid) FROM Section";
              $result = $dbh->query($sql);
              $row = $result->fetch();
                  
              for ($i = 1; $i <= $row[0]; $i++)
              {
                  printf("<option value='%s'>Section %s</option>", $i, $i);
              }
          ?>
        </select>
                        
      </div>
      <div class="form-group">
        <label for="inputTerm">Term</label>
        <input type="text" class="form-control" id="inputTerm" placeholder="Enter Term">
      </div>
      <div class="form-group">
        <label for="inputSentence">Term used in a sentence:</label>
        <input type="text" class="form-control" id="inputSentence" placeholder="Enter Sentence">
      </div>
      <div class="form-group">
        <label for="inputFile">File input</label>
        <input type="file" name="inputFile" id="inputFile">
        <p class="help-block">Make sure the file format is .png or jpg</p>
      </div>
      <button type="submit" class="btn btn-default">Upload Card</button>
    </form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<?php
 //Flush buffer
 ob_flush();
?>
