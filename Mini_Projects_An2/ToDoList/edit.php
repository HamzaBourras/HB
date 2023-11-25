<?php
    session_start();

    $id = $_GET['id'];
    $element = $_SESSION["data"][$id]; 

    $UserId = $element['userId'];
    $Todo = $element['todos'];
    $Completed = $element['completed'];
    $AddButton = "save";
    header("location:ToDos.php?UserId= $UserId&Todos= $Todo&Completed= $Completed&add= $AddButton");


?>