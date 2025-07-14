<?php 

    include("../user/config.php");

    session_start();

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $result = "DELETE FROM emploi_temps WHERE id = '$id'";

        mysqli_query($conn , $result);

        header("location: index.php");
    }

?>