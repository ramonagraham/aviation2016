<?php

    //Use php to grab the maximum number of cards available
    if(isset($_GET['secid'])){
        $STM = $dbh->prepare("SELECT count(*) FROM Cards WHERE secid = " . $_GET['secid']);
    }
    $STM->execute();
    $STMrecords = $STM->fetchAll();
    //create a variable to store the maximum number of cards
    $numCards = $STMrecords[0];

    //Print out an error that there are not enough cards to play the game
    if ($numCards < 4) {
        print "<h1>THERE ARE NOT ENOUGH CARDS IN THIS SECTION TO PLAY THE GAME, PLEASE CONTACT YOUR INSTRUCTOR</h1>";
    }

print "
<script>
(function(){
    var question = 1; // Amount of questions to ask
    var correct = 0; // Number of correct
    var total = 3; // Total amount of questions
    var correctNum = null;
    var time; // Timer variable to set and clear function
    var timerOn = 0;
    var changeCounter = 30;
    var counter = 0;

    // Plays audio when click image
    function playAudio(){
        document.getElementById(\"audioPlay\").load();
        document.getElementById(\"audioPlay\").play();
    }

    // Remove the 'empty' and 'filled' part of the id's and compare the rest of the strings. 
    function checkShapeDrop(e, correctInt) { 
        var element = e;
         if (element != null)
         {
            // if we have a match, count correct
            if (element == (\"answer\"+ correctInt)) {

                correct = correct + 1;
                
            } 
            
            question = question + 1;
            $(\".select\").removeClass(\"click\")
            initialize();
        }
    }

      // When dragging starts, set dataTransfer's data to the element's id.
    function selectAnswer(e) {

        // Changes color on selection
        $(\".select\").on(\"click\", function(){
            $(\".select\").removeClass(\"click\").filter(this).addClass(\"click\");
        })
        
        return choice = e;
        
    }

        // Assign event listeners to the divs to handle dragging.
    function initialize() 
    {    
        // Boolean keeps track of question. If question is answered timer 
        // stops and resets.
        var anscard1 = null;
        var anscard2 = null;
        var anscard3 = null;
        var anscard4 = null;
        choice = null;

         // Removes any previous selecitons
        $(\".select\").removeClass(\"click\");
        
        // Once questions answered then result page loads.
        if(question > total){

            window.location = \"quizResult.php?var1=\" + correct;

        }
        else
        {
        
        // Randomize cards
        anscard1 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
            
        anscard2 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        while(anscard1 == anscard2){
            anscard2 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        }
        
        anscard3 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        while(anscard3 == anscard2 || anscard3 == anscard1){
            anscard3 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        }
        
        anscard4 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        while(anscard4 == anscard2 || anscard4 == anscard1 || anscard4 == anscard3){
            anscard4 = getCard(Math.floor((Math.random() * $numCards[0]) + 1));
        }

        var arrayAns = [anscard1, anscard2, anscard3, anscard4];


        // Pick answer
        correctNum = Math.floor((Math.random() * 4) + 1);

        // if it is the first question than the correct number is stored in previous correct.
        // This is used to compare newer questions with the previous to minimize duplicate questions.
        if (question == 1){

            prevCorrect = correctNum;
        }
        else if(question == 2){

            while (correctNum == prevCorrect){
                correctNum = Math.floor((Math.random() * 4) + 1);
            }
            secondCorrect = correctNum; 
        }
        else if (question == 3){

             while (correctNum == prevCorrect || correctNum == secondCorrect){
                correctNum = Math.floor((Math.random() * 4) + 1);
            }
        }

        

        //Initialize quetion based on answer
        $(\"#answer1\").text(arrayAns[0].word);
        $(\"#answer2\").text(arrayAns[1].word);
        $(\"#answer3\").text(arrayAns[2].word);
        $(\"#answer4\").text(arrayAns[3].word);

        //Counter that displays the question user is on
        document.getElementById(\"questionNum\").innerHTML = \"Question \" + question + \" of \" + total;

        
        // Questions image and audio
        $(\"#image\").attr(\"src\", arrayAns[(correctNum -1)].img);
        $(\"#audioPlay\").attr(\"src\", arrayAns[(correctNum -1)].audio);
       }      
    }

    document.getElementById(\"answer1\").addEventListener(\"click\", function(){selectAnswer(\"answer1\")}, false);
    document.getElementById(\"answer2\").addEventListener(\"click\", function(){selectAnswer(\"answer2\")}, false);
    document.getElementById(\"answer3\").addEventListener(\"click\", function(){selectAnswer(\"answer3\")}, false);
    document.getElementById(\"answer4\").addEventListener(\"click\", function(){selectAnswer(\"answer4\")}, false);
    document.getElementById(\"submit\").addEventListener(\"click\", function(){checkShapeDrop(choice, correctNum)}, false);
    document.getElementById(\"image\").addEventListener(\"click\", playAudio, false);
   document.addEventListener(\"DOMContentLoaded\", initialize, false);

}) ();
</script>
";

?>