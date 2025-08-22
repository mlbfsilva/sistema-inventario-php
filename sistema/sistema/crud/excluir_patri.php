<?php
include('../conexao.php');

if (isset($_GET['codigo_mec'])) {
    $codigo_mec = $mysqli->real_escape_string($_GET['codigo_mec']);

    $sql = "DELETE FROM patrimonio WHERE codigo_mec = '$codigo_mec'";
    if ($mysqli->query($sql)) {
        header("Location:../template.php?msg=excluido");
        exit;
    } else {
        echo "Erro ao excluir: " . $mysqli->error;
    }
} else {
    echo "Código MEC inválido.";
}