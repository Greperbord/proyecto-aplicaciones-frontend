<?php
session_start();
session_destroy();
header("Location: ../front/index.php");
exit();
?>