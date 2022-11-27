<?php
function listOfData($sql,$List_Header){
    include "./connection.php";
    $data = mysqli_query($db,$sql);
?>
        <!-- for View button -->
     <div class="btn-container" style="
     position: relative;
     top : -115px;
     left : -1050px;
     ">
        <div class="text-box">
		 <a href="./listOfEvents.php" class="btn btn-white btn-animate">View Lists</a>
	    </div>
    </div>
            <!-- for heading of different filters -->
       <div style="text-align: center;margin:20px;">
        <h1><?php echo $List_Header;?></h1>
    </div>

    <div class="table-container">
        <!-- creating table for showeing data in proper format -->
    <table style= 'text-align:center;border:1px;' id = 'tableId'>
   <div class='table-container'>
   <table style= 'text-align:center;border:1px;' id = 'tableId'>
   <tr style = 'background-color:#78d9f6'>
   <th class='row-space'><?php echo"ID"?></th>
   <th class='row-space'><?php echo"Title"?></th>
   <th class='row-space'><?php echo"Description"?></th>
   <th class='row-space'><?php echo"Place"?></th>
   <th class='row-space'><?php echo"StartingDate"?></th>
   <th class='row-space'><?php echo"EndingDate"?></th>
   <th class='row-space'><?php echo"Action"?></th>
   </tr>

<?php 
 while($row = mysqli_fetch_assoc($data)){?>
            <!-- inserting data into table  -->
   <tr id = "<?php echo $row['id'];?>">   
        <td class='row-space'><?php echo $row["id"];?></td>
        <td class='row-space'><?php echo $row["title"];?></td>
        <td class='row-space'><?php echo $row["description"];?></td>
        <td class='row-space'><?php echo $row["place"];?></td>
        <td class='row-space'><?php echo $row["startDate"];?></td>
        <td class='row-space'><?php echo $row["endDate"];?></td>
        <td>
            <button type='submit' class='delete' name='delteItem' id = '<?php echo $row["id"];?>' onclick='deleteData(<?php echo $row["id"];?>);'>
            <img src='./deleteButton.png' height='12xp' widht='12px'  alt='deleteButton' />
                Delete 
            </button>
        </td>
    </tr> 
<?php
 }
 ?>
    </table>
    </div>
<?php
}
?>
