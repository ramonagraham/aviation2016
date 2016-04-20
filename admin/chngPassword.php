<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
    ob_start();
    
    // Function trims, removes slashes, and any additional html characters from parameter given and returns parameter
    function filterInput($info)
    {
        // If magic quotes not turned on add slashes
        if(!get_magic_quotes_gpc())
        {
            //Adds slashes
            $info = addslashes($info);
        }
        $info = strip_tags($info);
        $info = trim($info);
        $info = stripslashes($info);
        $info = htmlspecialchars($info);
            
            return $info;
        }

 
    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Isset used for buttons
        //echo "Form was submitted.";
        
        //Flag variable for valid data
        $valid = true;     
    
        

        //If the data is valid, write to DB
        /*
        if ($valid) {
           $sql = "INSERT INTO AdminInfo (adminFirst, adminLast, email, password)
            VALUES (:first, :last, :email, :password)";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':first', $first, PDO::PARAM_STR);
            $statement->bindParam(':last', $last, PDO::PARAM_STR);
            $statement->bindParam(':email', $emailSanitized, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->execute();
            echo "Sent to database";
        }
        */
        
    }
    
?>

<h2>List of Administrators:</h2>

 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>Change Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>New Password</th>
                <th>Confirm Password</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Change Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>New Password</th>
                <th>Confirm Password</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT adminFirst, adminLast, email FROM AdminInfo ORDER BY adminLast, adminFirst";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    printf("<tr><td><button value='%s'>Change Password</td>", $row['email']);
                    printf("<td>%s</td>", $row['adminFirst']);
                    printf("<td>%s</td>", $row['adminLast']);
                    printf("<td>%s</td>", $row['email']);
                    printf("<td><input type='text' class='form-control' name='newPass'></td>");
                    printf("<td><input type='text' class='form-control' name='newPass2'></td></tr>");
                }
            ?>
        </tbody>
    </table>
        

</html>

<?php
 //Flush buffer
 ob_flush();
?>