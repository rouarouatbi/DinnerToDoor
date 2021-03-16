<?php
session_start();
unset($_SESSION['idU']);
unset($_SESSION['nomU']);
unset($_SESSION['roleU']);
unset($_SESSION['emailU']);
header('Location:index.php'); 
?>