<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Servidor</title>
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

if(isset($_GET['matricula'])){
  $matricula = $mysqli->real_escape_string($_GET['matricula']);
  $resultado = $mysqli->query("SELECT * from servidorpublico WHERE matricula = '$matricula'") or die($mysqli->error);
  $item = $resultado->fetch_assoc();

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $matricula = $mysqli->real_escape_string($_POST['matricula']);
      $nome      = $mysqli->real_escape_string($_POST['nome']);
      $email     = $mysqli->real_escape_string($_POST['email']);
      $setor     = $mysqli->real_escape_string($_POST['setor']);
      $funcao    = $mysqli->real_escape_string($_POST['funcao']);
      $is_agente_consignatario = $mysqli->real_escape_string($_POST['is_agente_consignatario']);

      $sql = "UPDATE servidorpublico SET
                  nome = '$nome',
                  email = '$email',
                  setor = '$setor',
                  funcao = '$funcao',
                  is_agente_consignatario = '$is_agente_consignatario'
              WHERE matricula = '$matricula'";

      if($mysqli->query($sql)) {
          header("Location: ../template.php?pagina=servidores&msg=editado");
          exit;
      } else { 
          echo "Erro ao editar: " . $mysqli->error;
      }
  }
}
?>

<div class="form-container">
    <form method="post" class="form-editar">
        <h3>Editar Servidor</h3>
        <br>
        <input type="hidden" name="matricula" value="<?= htmlspecialchars($item['matricula']) ?>">

        <label class="label-form">Nome do Servidor:</label>
        <input name="nome" class="input-form" value="<?= htmlspecialchars($item['nome']) ?>">

        <label class="label-form">E-mail:</label>
        <input name="email" class="input-form" value="<?= htmlspecialchars($item['email']) ?>">

        <label class="label-form">Setor:</label>
        <input name="setor" class="input-form" value="<?= htmlspecialchars($item['setor']) ?>">

        <label class="label-form">Função:</label>
        <input name="funcao" class="input-form" value="<?= htmlspecialchars($item['funcao']) ?>">

        <label class="label-form">É Agente Consignatário:</label>
        <select class="input-form" name="is_agente_consignatario">
            <option value="0" <?= $item['is_agente_consignatario'] == 0 ? 'selected' : '' ?>>Não</option>
            <option value="1" <?= $item['is_agente_consignatario'] == 1 ? 'selected' : '' ?>>Sim</option>
        </select>

        <button type="submit" class="btn-confirmar">Salvar alterações</button>
        <button type="button" onclick="window.location.href='../template.php?pagina=servidores'" class="btn-cancelar">Cancelar</button>
    </form>
</div>

</main>
</body>
</html>
