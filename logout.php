<?php
session_start();

// Encerra a sessão
session_destroy();

// Redireciona para a página inicial ou qualquer outra página desejada
header("Location: ./index.php");
exit;
?>
