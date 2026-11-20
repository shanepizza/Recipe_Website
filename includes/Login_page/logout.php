<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//This must include the session start code because we do not include header.php here
session_unset();
session_destroy();
//What does  this do? 
header("Location: /Recipe_Website/index.php");
exit;
?>