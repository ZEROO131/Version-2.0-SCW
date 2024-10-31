<?php
session_start();
if(session_status()!=2 or $_SESSION['aut']!='1011322322#2006'){
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
