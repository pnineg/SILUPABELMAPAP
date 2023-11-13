<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start(); // Inicia a sessão
session_destroy(); // Destrói a sessão
header("Location: login.php"); // Redireciona o usuário para a página de login ou qualquer outra página desejada
?>