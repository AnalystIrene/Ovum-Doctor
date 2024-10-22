<table>
    <tr>
        <th>Cycle dates</th>
        <th>Period status(late/early/ontime/missed)</th>
        <th>MenstrualPeriod Dates</th>
        <th>bloodflow</th>
        <th>fertile window</th>
        <th>Ovulation date</th>
        <th>Period Length</th>
        <th>Cycle Length</th>
        <th>Symptoms</th>
        
    </tr>
    <tr>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
</table>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

//create a connection 
$conn = new mysqli($servername,$username,$password,$dbname);
//check connection
if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}
$sql = "SELECT cycle_dates ,Menstrual_Period_dates,Period_status,Bloodflow ,Fertile_window,ovulation_date,period_lenth,symptoms,FROM my_symptoms";
$result = $conn->query($sql);
 
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "cycle_dates:" .$row["cycle_dates"]."Menstrual_Period_dates:".$row["Menstrual_Period_dates"]."Period_status:".$row["Period_status"]."Bloodflow:" .$row["Bloodflow"]."Fertile_window:" .$row["Fertile_window"]."ovulation_date:" .$row["ovulation_date"]."period_lenth:" .$row["period_lenth"]."symptoms:" .$row["symptoms"]."< br>";   }
}else{
    echo "0 results";
}
$conn->close();
?>