<?php
require_once('config.php');
require_once(DBAPI);
session_start();
session_destroy();
header("location: index.php"); 
?>