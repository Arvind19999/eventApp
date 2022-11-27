<?php 
include "./connection.php";
include "./header.php";
include "./listOfData.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <title>List Display</title>
</head>
<body>
        <!-- filtering option form-->
        <div style ="
        margin : 15px;
        height:100px;
        width:35%;
        display:flex;
        align-items : center;
        box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.3);
        border-color: red;
        position : relative;
        left : 800px;
         ">
        <form  action="./listOfEvents.php" method ="POST">
        <label for="filtering">Option for filltering:</label>
        <select style="
            border-radius : 25px;
            height: 40px;
            "
         name="filters" id="filter">
        <option value="0">Select</option>
        <option value="1">Finished Events</option>
        <option value="2">Upcoming Events</option>
        <option value="3">Upcoming Events Within 7 days </option>
        <option value="4">Past Events within 7 days</option>
        </select>
  <br><br>
            <!-- for buttion portion -->
  <button style="
        position : relative;
        left : 150px;
        width : 55%;
        height : 30px;
        border-radius : 15px;
        background-color : #78d9f6;
        color: white;
        border-color:#78d9f6;
        cursor: pointer;
         " 
  type="submit">Submit</button>
</form>
 </div>

    <!-- Showing filtered events -->
 <?php
    error_reporting(0); //To get rid of Warning
    switch($_POST["filters"]){
        case "1":
            //Displaying List of Finished Events
            $presentDate = date("Y-m-d");
            $data ="SELECT * FROM `listevent` WHERE endDate  <'$presentDate' ORDER BY startDate ASC";
            $List_Header = "Finished Events.............";
            listOfData($data,$List_Header);
            break;

        case "2":
            //Displaying List of Upcoming Events
            $data = "SELECT * FROM `listevent` WHERE startDate > now() ORDER BY startDate ASC";
            $List_Header = "UpComing Events..........";
            listOfData($data,$List_Header);
            break;

        case "3":
            //Displaying List of List of UpComing Events within 7 Days
            $presentDate = date("Y-m-d");
            $dateAfter7days = date("Y-m-d",strtotime($presentDate."+7 days"));
            $data = "SELECT * FROM `listevent` WHERE startDate BETWEEN '$presentDate' AND '$dateAfter7days' ORDER BY startDate ASC ";
            $List_Header = "UpComing Events With in 7 Days..........";
            listOfData($data,$List_Header);
            break;

        case "4":
            //Displaying List of Past Last 7 days Events 
            $yesterdatDate = date("Y-m-d",strtotime(date("Y-m-d")."-1 days"));
            $dateBefore7days = date("Y-m-d",strtotime($yesterdatDate."-7 days"));
            $data = "SELECT * FROM `listevent` WHERE endDate  BETWEEN  '$dateBefore7days' AND '$yesterdatDate' ORDER BY startDate ASC";
            $List_Header = "Events of past last 7 days............";
            listOfData($data,$List_Header);
            break;

        default :   
            // Displaying all Events
            $presentDate = date("Y-m-d");
            $data ="SELECT * FROM `listevent` WHERE endDate >= '$presentDate' ORDER BY startDate ASC";
            $List_Header = "List of all Events.....................";
            listOfData($data,$List_Header);  
    }
 ?>
 
   <!-- Deleting Functionalities uisng ajax -->
    <script type = "text/javascript">
        function deleteData(id){
            $(document).ready(function(){

                $.ajax({
                    //Action
                    url:'function.php',
                    //Method
                    type:'POST',
                    data :{
                        //Get value
                        id : id,
                        action : "delete"
                    },
                   
                    success:function(response){
                        // response is the output of the action file
                        if(response == 1){
                          
                            document.getElementById(id).style.disply = "none";
                            location.reload();
                            alert("Data Deleted Successfully");
                            
                        }
                        else if(response == 0){
                            alert("Data cannot be Deleted");
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>