<?php
session_name("Myapp");
session_start();
session_destroy();
header('location: login.php');
?>