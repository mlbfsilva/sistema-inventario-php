<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Servidor</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="dashboard-layout"> 

<header class="main-header">
    <div class="header-left">
        <h3>Sistema <span>Inventário - SPO</span></h3>
    </div>
    <div class="header-right">
        <a href="../logout.php" class="logout-btn">Sair</a>
    </div>
</header>

<nav class="sidebar">
    <center><h3>Administrador - COGI</h3></center>
    <ul>
        <li>
            <a href="../template.php?pagina=painel"><ion-icon name="desktop"></ion-icon><span>Patrimônio</span></a>
        </li>
        <li>
            <a href="../template.php?pagina=servidores"><ion-icon name="contacts"></ion-icon><span>Servidores</span></a>
        </li>
        <li>
            <a href="../template.php?pagina=historico"><ion-icon name="filing"></ion-icon><span>Histórico</span></a>
        </li>
    </ul>
</nav>

<main class="content">

<?php 
include("../conexao.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $matricula = $mysqli->real_escape_string($_POST['matricula']);
      $nome      = $mysqli->real_escape_string($_POST['nome']);
      $email     = $mysqli->real_escape_string($_POST['email']);
      $setor     = $mysqli->real_escape_string($_POST['setor']);
      $funcao    = $mysqli->real_escape_string($_POST['funcao']);
      $is_agente_consignatario = $mysqli->real_escape_string($_POST['is_agente_consignatario']);

        $sql = "INSERT IGNORE INTO servidorpublico
                (matricula, nome, email, setor, funcao, is_agente_consignatario)
                VALUES 
                ('$matricula', '$nome', '$email', '$setor', '$funcao', '$is_agente_consignatario')";

        if($mysqli->query($sql)) {
            header("Location: ../template.php?msg=inserido");
            exit;
        } else { 
            echo "Erro ao editar: " . $mysqli->error;
        }
    }

?>

<div class="form-container">
    <form method="post" class="form-editar">
        <h3>Adicionar Novo Servidor</h3>
        <br>
        <label class="label-form">Matrícula:</label>
        <input name="matricula" class="input-form">

        <label class="label-form">Nome do Servidor:</label>
        <input name="nome" class="input-form">

        <label class="label-form">E-mail:</label>
        <input name="email" class="input-form">

        <label class="label-form">Setor:</label>
        <input name="setor" class="input-form">

        <label class="label-form">Função do Servidor:</label>
        <input name="funcao" class="input-form">

        <label class="label-form">É Agente Consignatário:</label>
        <select class="input-form" name="is_agente_consignatario">
            <option value="0" <?= ['is_agente_consignatario'] == 0 ? 'selected' : '' ?>>Não</option>
            <option value="1" <?= ['is_agente_consignatario'] == 1 ? 'selected' : '' ?>>Sim</option>
        </select>


        <button type="submit" class="btn-confirmar">Salvar alterações</button>
        <a href="../template.php" class="btn-cancelar">Cancelar</a>
    </form>
</div>

</main>
</body>
</html>
