<?php
session_start();
session_destroy();
session_unset();
$_SESSION[''];

echo "<script>alert('Anda telah log out'); 
document.location.href='../'; </script>";