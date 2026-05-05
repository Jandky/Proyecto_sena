<?php
session_start(); // Necesario para acceder a la sesión antes de destruirla
session_destroy();
header("Location: Login.html");
exit();
?>