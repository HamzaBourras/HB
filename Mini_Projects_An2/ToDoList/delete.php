<?php
    session_start();

    $id = $_GET['id'];

    function deleteElem($key){
        global $id;
        return $key != $id;
        
    }

    $_SESSION["data"]= array_filter($_SESSION["data"],"deleteElem",ARRAY_FILTER_USE_KEY);
    

    header('location:ToDos.php');

        // echo "<pre>";
        // print_r($_SESSION["data"]);
        // echo "</pre>";
        
?>


