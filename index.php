<?php
// echo (4+3)."<br>";
include "./connection.php";
include "./header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <title>AppEvent</title>
</head>
<body>

     <!-- Button css styling -->
     <div class="btn-container">
        <div class="text-box">
		 <a href="./listOfEvents.php" class="btn btn-white btn-animate">View Lists</a>
	    </div>
    </div>

        <!--form container -->
    <div class="form-container">
    <div  class="cont">
        <div class="form-header">
            <h2>Add Enteries</h2>
        </div>
     <form action="./index.php" method="post">
     
        <div class="input-class">
            <label for="textInput" class ="label-class">Enter Id:-</label>
            <!-- <br> -->
            <input id="textInput" 
             type = "number" 
             class="custom" 
             name = "id" 
             placeholder="Enter id"
             size="10"
             required>
        </div>

        <div class="input-class">
            <label for="textInput" class ="label-class">Enter Title:-</label>
            <!-- <br> -->
            <input id="textInput" 
             type="text"
             class="custom" 
             name = "title" 
             placeholder="Enter title"
             size="20"
             required>
        </div>

        <div class="input-class">
            <label for="textInput" class ="label-class">Enter Place:-</label>
            <!-- <br> -->
            <input id="textInput" 
             type = "text" 
             class="custom" 
             name = "place" 
             placeholder="Enter placce"
             size="10"
             required>
        </div>

        <div class="input-class">
            <label for="textInput" class ="label-class">Description:-</label>
            <!-- <br> -->
            <textarea name="description"
             class="custom"
             cols="30"
             rows="10"
             required>
            </textarea>
        </div>


        <div class="input-class">
            <label for="textInput" class ="label-class">Starting Date:-</label>
            <!-- <br> -->
            <input type="date" 
             name="startDate" 
             class="custom"
             required>
        </div>
      
        <div class="input-class">
            <label for="textInput" class ="label-class">Ending Date:-</label>
            <!-- <br> btn-class  -->
            <input type="date" 
             name="endDate" 
             class="custom"
             required>
        </div>

        <div class="btn-container">
            <button class = "btn-class"
            btn-class 
                id = "formSubmit"
                type="submit"
                name="submit">
                Add Event
            </button>
        </div>
     </form>

    </div>
    </div>

<?php
if(isset($_POST["submit"])){
    $Id = $_POST["id"];
    $Title = $_POST["title"];
    $Description = $_POST["description"];
    $Place = $_POST["place"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
        // checking for input field empty 
        //Server Side form Validation
        if(($Id !="") && ($Title !="") && ($Description !="") && ($Place !="") && ($startDate !="") && ($endDate !="")){
            // Limiting Id length upto  10 character long
            if(strlen($Id)<=10){
            // Checking for unique ID
            $count = 0;
            $sql = "SELECT id FROM `listevent`";
            $res =mysqli_query($db,$sql);
            while($row =mysqli_fetch_assoc($res)){
                if($row["id"]==$Id){
                    $count += 1;
                }
            }
                // If id is unique then proceed further
                    if($count == 0){
                            //For endDate greater than startDate
                        if(strcmp($endDate,$startDate) >= 0 ){
                    // Inserting data into database
                    mysqli_query($db,"INSERT INTO `listevent` VALUES('$Id','$Title','$Description','$Place','$startDate','$endDate')");    
                    echo "<script>alert('Data added Successfully')</script>";
                }
                else{
                    echo "<script>alert('Please choose endDate greater than startDate')</script>";
                }
            }
                else{
                    echo"<script>alert('Id Must be Unique')</script>";
                }
            
        
        
            }
            else{
                echo"<script>alert('Please Enter the Id length less than 10 character');</script>"; 
            }
        }
        else{
            echo "<script>alert('Please fill all the fields')</script>";
        }

}
?>
</body>
</html>
