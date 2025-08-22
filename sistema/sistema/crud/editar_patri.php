<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Patrimônio</title>
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

if(isset($_GET['codigo_mec'])){
    $codigo_mec = $mysqli->real_escape_string($_GET['codigo_mec']);
    $resultado = $mysqli->query("SELECT * FROM patrimonio WHERE codigo_mec = '$codigo_mec'") or die ($mysqli->error);
    $item = $resultado->fetch_assoc();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $descricao = $mysqli->real_escape_string($_POST['descricao']);
        $tipo = $mysqli->real_escape_string($_POST['tipo']);
        $situacao = $mysqli->real_escape_string($_POST['situacao']);
        $modelo = $mysqli->real_escape_string($_POST['modelo']);
        $marca = $mysqli->real_escape_string($_POST['marca']);
        $estado_fisico = $mysqli->real_escape_string($_POST['estado_fisico']);
        $coordenacao = $mysqli->real_escape_string($_POST['coordenacao']);
        $observacoes = $mysqli->real_escape_string($_POST['observacoes']);
        $matricula = $mysqli->real_escape_string($_POST['matricula']);
        $matricula_agente = $mysqli->real_escape_string($_POST['matricula_agente']);

        $sql = "UPDATE patrimonio SET
                    descricao        = '$descricao',
                    tipo             = '$tipo',
                    situacao         = '$situacao',
                    modelo           = '$modelo',
                    marca            = '$marca',
                    estado_fisico    = '$estado_fisico',
                    coordenacao      = '$coordenacao',
                    observacoes      = '$observacoes',
                    matricula        = '$matricula',
                    matricula_agente = '$matricula_agente'
                WHERE codigo_mec     = '$codigo_mec'";

        if($mysqli->query($sql)) {
            header("Location: ../template.php?msg=editado");
            exit;
        } else { 
            echo "Erro ao editar: " . $mysqli->error;
        }
    }
}
?>

<div class="form-container">
    <form method="post" class="form-editar">
        <h3>Editar Patrimônio</h3>
        <br>
        <label class="label-form">Descrição:</label>
        <input name="descricao" class="input-form" value="<?= htmlspecialchars($item['descricao']) ?>">

        <label class="label-form">Tipo:</label>
        <input name="tipo" class="input-form" value="<?= htmlspecialchars($item['tipo']) ?>">

        <label class="label-form">Situação:</label>
        <input name="situacao" class="input-form" value="<?= htmlspecialchars($item['situacao']) ?>">

        <label class="label-form">Modelo:</label>
        <input name="modelo" class="input-form" value="<?= htmlspecialchars($item['modelo']) ?>">

        <label class="label-form">Marca:</label>
        <input name="marca" class="input-form" value="<?= htmlspecialchars($item['marca']) ?>">

        <label class="label-form">Estado Físico:</label>
        <input name="estado_fisico" class="input-form" value="<?= htmlspecialchars($item['estado_fisico']) ?>">

        <label class="label-form">Coordenação:</label>
        <input name="coordenacao" class="input-form" value="<?= htmlspecialchars($item['coordenacao']) ?>">

        <label class="label-form">Observações:</label>
        <input name="observacoes" class="input-form" value="<?= htmlspecialchars($item['observacoes']) ?>">

        <label class="label-form">Matrícula do Usuário:</label>
        <input name="matricula" class="input-form" value="<?= htmlspecialchars($item['matricula']) ?>">

        <label class="label-form">Matrícula do Agente Consignatário:</label>
        <input name="matricula_agente" class="input-form" value="<?= htmlspecialchars($item['matricula_agente']) ?>">

        <button type="submit" class="btn-confirmar">Salvar alterações</button>
        <button type="button" onclick="<?php header("Location= ../templante.php")?>" class="btn-cancelar">Cancelar</button>
    </form>
</div>

</main>
</body>
</html>
