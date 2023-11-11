<?php
session_start(); // Inicia a sessão
session_destroy(); // Destrói a sessão
header("Location: login.php"); // Redireciona o usuário para a página de login ou qualquer outra página desejada
?>