<?php
    session_start();
    session_unset();
    session_destroy();

    $_SESSION["logged"] = FALSE;
    $_SESSION["name"] = "";
    $_SESSION["email"] = "";
    $_SESSION["userID"] = "";
    $_SESSION["accType"] = "";
    $_SESSION["adminID"] = "";
    
    header("location: index.php");
    exit();
?>