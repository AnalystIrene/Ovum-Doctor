<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Cycle Analysis</title>
    <script src="./index.js" defer></script>
    <link rel="stylesheet" href="./stylesheets/stylesheets/rene.css">
    <style>
        *{
            margin: 0px;
            padding: 0px;

        }
        .c1{
            display: inline;
            margin-bottom: 5px;
            margin-top: 25px;
            margin-left: 120px;
            font-size: 30px;;
        }

        .c2{
            margin-top: 35px;
            text-align: center;
            margin-bottom: 25px;
            font-size: 30px; 
        }


        .MyDiv{
            margin-left: 80px;
            font-size: 20px;
        }

        .MyDiv:hover{
            color:rgb(13, 35, 238);
            cursor: pointer;
        }

        .title{
            display: flex;
            align-items: center;

        }
        .left{
            background-color: beige;
            width: 55vw;
            padding-left: 20px;
            
        }

        #nod1{
            color: rgb(253, 8, 49);
        }
        #sp1{
            color: rgb(246, 17, 17);

        }
        #sp2{
            color: #f20404;
        }
        #sp3{
            color: #f20404;
        }
        #sp4{
            color: #f20404;
        }

        #sp5{
            color: #f20404;
        }

        #sp6{
            color: #f20404;
        }

        #sp7{
            color: #f20404;
        }

        #sp8{
            color: #f20404;
        }

        #sp9{
            color: #f20404;
        }

        #sp10{
            color: #f20404;
        }

        #sp11{
            color: #f20404;
        }

        #sp12{
            color: #f20404;
        }

        #sp13{
            color: #f20404;
        }

        #sp14{
            color: #f20404;
        }

        #sp15{
            color: #f20404;
        }

        #sp16{
            color: #f20404;
        }
        .right{
            position: relative;
            background-color: beige;
            width: 45vw;
            height: calc(100vh - 70px);
        
            
        }

        .mybtn1{

            width: 100%;
            text-align: center;
            padding-bottom: 10px;
            position: absolute;
            bottom: 0px;
            right: 0px;
            left: 0px;
            margin-bottom: 20px;
            
        }

        #b1{
            font-size: 18px;
            padding: 5px 24px;
            border: 2px solid black;
            border-radius: 10px;
        }

        .mybtn2{
            width: 100%;
            text-align: center;
            padding-top: 10px;

        }

        #b2{
            font-size: 18px;
            padding: 5px 24px;
            border: 2px solid black;
            border-radius: 10px;
        }
            
        .MyDiv2, .MyDiv3, .MyDiv4, .MyDiv7, .MyDiv8, .MyDiv9, .MyDiv10, .MyDiv11, .MyDiv12, .MyDiv13, .MyDiv14{
        margin-top: 34px;
        
    }

    .MyDiv5{
        margin-bottom: 20px;
    }
    .MyDiv15{
    margin-top: 34px;
    margin-bottom: 34px;
    }
    body{
        display: flex; 
        flex-direction: column;          
        background-color: antiquewhite;
    }

    .first_category {
            border: 1px solid white;
            padding-left: 20px;
            width: 70%;
            border-radius: 20px;
            margin-left: 10%;
            background-color: white;
        }

    .second_category{
            border: 2px solid white;
            padding-left: 30px;
            margin-left: 10%;
            width: 70%;
            border-radius: 20px;
            padding-top: 20px;
            padding-bottom: 15px;
            background-color: white;

    }
    .third_category{
            border: 2px solid white;
            padding-left: 30px;
            width: 75%;
            margin-left: 10%;
            border-radius: 20px;
            margin-top: 20px;
            padding-bottom: 20px;
            background-color: white;
    }
    .fourth_category{
            border: 2px solid white;
            
            padding-left: 30px;
            border-radius: 20px;
            margin-top: 150px;
            padding-bottom: 2px;
            background-color: white;
    }

    .MyDiv4{
        margin-bottom: 30px;
    }
    </style>
</head>
<body>

<?php

include './databaseoptions.php';

//create a connection 
$conn = new mysqli($servername,$username,$password,$dbname,$port);
//check connection
if($conn->connect_error){
    die("connection failed:".$conn->connect_error);
}
?> 

    <div class="heading">

        <div class="doctorsOptions">
            <div class="space">
                
            </div>
            <p id="overview" class="overview">Doctor's Name</p>
            <p id="summary" class="summary">Patient's Summary</p>
        </div>
    </div>

    <div class="main">

        <div class="navbar">
            
                <div class="options">
                    <p class="patient_id">PatientID: 2938d</p>
                    <p class="optionButton" id='view_trends'>View trends</p>
                    <p class="optionButton" id='view_appointments'>Current Appointments</p>
                    <p class="optionButton" id = 'schedule_appointments'> Schedule Appointment </p>
                    <p class="optionButton" >More details</p>
                </div>

            <div class="logout">
                <p class="logoutButton" id='logout'>Sign Out</p>
            </div>
        </div>

        <div class="left">

            <div class="title">

                <h3 class="c1"> Cycle history </h3>


                <div class = "MyDiv" id="seall">
                    <p id='seealllink'>see all</p>
                </div>
            </div>

            <div class="first_category">
            <div class = "MyDiv2">
            <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Current Cycle:  <span id="sp1"><?php            
    $sql1 = "SELECT cycle_dates, cycle_length  FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["cycle_dates"] . " , ".$row["cycle_length"] ;
                
        }   
        echo "".$resulting;  
        }
    else{
        echo "0 results";
    }
    ?>  days<span></p> 

            </div>
            <div class = "MyDiv3">
                <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Former Cycle:  <span id="sp2"><?php            
                $sql1 = "SELECT cycle_dates,cycle_length  FROM my_symptoms;";
                $result1 = $conn->query($sql1);
    
                if($result1->num_rows>0){

                    $resulting = [];
                    $number = 0;

                while($row=$result1->fetch_assoc()){
                
                $resulting[$number] = $row["cycle_dates"] . " , ".$row["cycle_length"] ;
                $number = $number + 1;
                
                }   
                echo "".$resulting[3];  
                }
                else{
                echo "0 results";
                }
    ?>days<span></p> 
            </div>

            <div class = "MyDiv4">
                <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Former Cycle:  <span id="sp3"><?php            
                $sql1 = "SELECT cycle_dates,cycle_length  FROM my_symptoms;";
                $result1 = $conn->query($sql1);
    
                if($result1->num_rows>0){

                    $resulting = [];
                    $number = 0;

                while($row=$result1->fetch_assoc()){
                $resulting[$number] = $row["cycle_dates"] . " , ".$row["cycle_length"] ;
                $number = $number + 1;
                
                }   
                echo "".$resulting[2];  
                }
                else{
                echo "0 results";
            }
    ?> days<span></p>
            </div>
            </div>

            <div>
            <h3 class="c2"> Cycle history Details </h3>
            </div>


            <div class="second_category">
            <div class = "MyDiv5">
                <p class ="nod" style="display: inline; margin-left: 10px; font-size: 16px"> Your last Period began:  <span id="sp4">
                <?php            
    $sql1 = "SELECT cycle_dates FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["cycle_dates"];
        }

        for($i = 0; $i < strlen($resulting); $i = $i + 1){

                if($resulting[$i] == "-" && $resulting[$i + 1] == " "){
                    echo "".substr($resulting, 0, $i);
                    break;
                }
        }
    }else{
        echo "0 results";
    }
    ?>
                </span>  </p>
            </div>


            <div class = "MyDiv6" style="display: flex; align-items: center; margin-bottom: 15px">
                <img src="./images/clock.png" height="32px" width="32px">
            <p class ="nod" style="display: inline; margin-left: 10px; font-size: 16px"> Your period lasted:  <span id="sp5">
    <?php            
    $sql1 = "SELECT period_length FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["period_length"];
        }

        echo $resulting;
    }else{
        echo "0 results";
    }
    ?>
    days<span></p>  
            </div>


            <div class = "MyDiv0" style = "display: flex; align-items:center">
                <img style="border: 2px solid black; border-radius: 15px" src ="./images/blood-droplet.png" height = "30px" width="30px">
                <p class ="nod" style="display: inline; margin-left: 10px; font-size: 16px"> your blood flow was:  <span id = "sp6">
                <?php            
    $sql1 = "SELECT Bloodflow FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["Bloodflow"];
        }

        echo $resulting;
    }else{
        echo "0 results";
    }
    ?>
                </span> </p>

            </div>
        </div>


            <div class="third_category">

            <div class=" MyDiv8" style="display: flex; align-items: center">
                <img src="./images/calendar.png" height="24px" width="24px">
                <p class ="nod" style="display: inline; margin-left: 10px; font-size: 16px">Your cycle length was: <span id="sp8"> <?php            
                $sql1 = "SELECT cycle_dates,cycle_length  FROM my_symptoms;";
                $result1 = $conn->query($sql1);
    
                if($result1->num_rows>0){

                $resulting = 0;

                while($row=$result1->fetch_assoc()){
                $resulting = $row["cycle_length"] ;
                
        }   
        echo "".$resulting;  
        }
        else{
        echo "0 results";
        }
    ?> days</span>   </p>
            </div>

            <div class=" MyDiv9">
                <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Your last cycles was:  <span id="sp9"><?php            
    $sql1 = "SELECT period_status FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["period_status"]  ;
                
        }   
        echo "".$resulting;  
        }
    else{
        echo "0 results";
    }
    ?><span></p>
            </div>



            <div class=" MyDiv10">
                <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> You mostly likely ovulated on:  <span id="sp10">
                <?php            
    $sql1 = "SELECT ovulation_date FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["ovulation_date"];
        }

        echo $resulting;
    }else{
        echo "0 results";
    }
    ?>
                </span></p>
                
            </div>
            </div>


        
            

        </div>

            <div class = "right">
                <div class="fourth_category">
                    <div class=" MyDiv11">
                        <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Your predicted fertile window was:  <span id="sp11"><?php            
    $sql1 = "SELECT Fertile_window FROM my_symptoms;";
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){

        $resulting = 0;

        while($row=$result1->fetch_assoc()){
                $resulting = $row["Fertile_window"];
                
        }   
        echo "".$resulting;  
        }
    else{
        echo "0 results";
    }
    ?><span></p>
                    </div>
            
                    <div class=" MyDiv12">
                        <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Your missed periods were in cycles of :  <span id="sp12"><?php            
                        $sql1 = "SELECT  cycle_dates FROM my_symptoms WHERE period_status = 'missed';";
                        $result1 = $conn->query($sql1);
    
                        if($result1->num_rows>0){

                        $resulting = 0;

                        while($row=$result1->fetch_assoc()){
                        $resulting = $row["cycle_dates"];
                
                    }   
                        echo "".$resulting;  
                        }
                        else{
                        echo "No cycles when period was missed";
                        }
                        ?><span></p>
                        
                    </div>
            
                    <div class=" MyDiv13">
                        <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Number of months with missed periods:  <span id="sp13"><?php            
                        $sql1 = "SELECT  cycle_dates FROM my_symptoms WHERE period_status = 'missed';";
                        $result1 = $conn->query($sql1);
    
                        if($result1->num_rows>0){

                        $resulting = 0;

                        while($row=$result1->fetch_assoc()){
                        $resulting = $result1->num_rows;
                
                    }   
                        echo "".$resulting;  
                        }
                        else{
                        echo "".$result1->num_rows;
                        }
                        ?><span></p>
                        
                    </div>
            
                    <div class=" MyDiv14">
                        <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Your cycle of late periods were:  <span id="sp14"><?php            
                        $sql1 = "SELECT  cycle_dates FROM my_symptoms WHERE period_status = 'late';";
                        $result1 = $conn->query($sql1);
    
                        if($result1->num_rows>0){

                        $resulting = 0;

                        while($row=$result1->fetch_assoc()){
                        $resulting = $row["cycle_dates"];
                
                    }   
                        echo "".$resulting;  
                        }
                        else{
                        echo "No cycles when period was late";
                        }
                        ?><span></p>
                        
                    </div>
            
                    <div class=" MyDiv15">
                        <p class ="nod" style="display: inline; margin-left: 5px; font-size: 16px"> Number of days in a month by which the period was late:  <span id="sp15"><?php            
                        $sql1 = "SELECT cycle_dates FROM my_symptoms;";
                        $result1 = $conn->query($sql1);
    
                        if($result1->num_rows>0){

                        $resulting = [];
                        $number = 0;

                        while($row=$result1->fetch_assoc()){
                        $resulting[$number] = $row["cycle_dates"];
                        $number = $number + 1;
                    }

                    $startingDate = 0;
                    $startMonth = "";

                    $endDate = 0;
                    $endMonth = "";

                    $inter = 0;
                    $inter2;

                        echo "".$resulting[3];  
                        }
                        else{
                        echo "No cycles when period was missed";
                        }
                        ?><span></p>
                        
                    </div>
    </div>
        
</body>

<script>
    document.getElementById('seall').addEventListener('click', () => {
        window.location = './seeallfinal.php'
    })

    document.getElementById('summary').addEventListener('click', () => {
        window.location = './currentAppointment.html'
    })

</script>
</html>