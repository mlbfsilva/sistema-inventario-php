<?php
include('protect.php');
include('conexao.php');

$paginas_permitidas = ['painel', 'servidores', 'historico', 'editar_patri'];
$pagina = $_GET['pagina'] ?? 'servidores'; 

if (!in_array($pagina, $paginas_permitidas)) {
    $pagina = 'servidores';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Inventário - SPO</title>
    <link rel="stylesheet" href="../sistema/css/main.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
</head>
<body class="dashboard-layout"> <?php include('menu.php'); ?>

    <main class="content">
        <?php

        include("../sistema/pages/{$pagina}.php");
        ?>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    
</body>
</html>