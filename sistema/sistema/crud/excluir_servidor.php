<?php 
include('../conexao.php');

if(isset($_GET['matricula'])){
    $matricula = $mysqli->real_escape_string($_GET['matricula']);
    $sql = "DELETE FROM servidorpublico WHERE matricula = '$matricula'";
    if($mysqli->query($sql)){
    header("Location:../template.php?msg=excluido");
    exit;
    }else {echo "Erro ao excluir: " . $mysqli->error;}
}else { echo "Matrícula do servidor inválida.";}
?>