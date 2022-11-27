<?php 
include "./connection.php";

if(isset($_POST["action"])){
    if($_POST["action"] == "delete"){
            $id = $_POST["id"];
            mysqli_query($db, "DELETE FROM `listevent` WHERE id = '$id'");
            echo 1;
    }
    else if ($_POST["action"] != "delete"){
        echo 0;
    }
}
?>