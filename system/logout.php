<?php
session_start();
session_destroy();
header("location: ../system/login.php");
?>