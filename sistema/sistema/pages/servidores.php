<?php 
include('conexao.php');

$itens_por_pagina = 15;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $itens_por_pagina;

$pesquisa = isset($_GET['busca']) ? $mysqli->real_escape_string($_GET['busca']) : '';
$condicao = '';
if ($pesquisa != '') {
    $condicao = "WHERE matricula LIKE '$pesquisa%'
                  OR nome LIKE '$pesquisa%'
                  OR email LIKE '$pesquisa%'
                  OR setor LIKE '$pesquisa%'
                  OR funcao LIKE '$pesquisa%'";
        
}
    $sql_total = "SELECT COUNT(*) as total from servidorpublico $condicao";
    $total_query = $mysqli->query($sql_total) or die("Erro ao consultar resultados". $mysqli->error);
    $total_resultado = $total_query->fetch_assoc();
    $total_registros = $total_resultado['total'];
    $total_paginas = ceil($total_registros / $itens_por_pagina);

    $sql_code = "SELECT * from servidorpublico
                $condicao
                ORDER BY setor ASC
                LIMIT $itens_por_pagina OFFSET $offset";
    $sql_query = $mysqli->query($sql_code) or die("Erro ao consultar: ". $mysqli->error);''
?>

<div class="form-busca">
    <form action="" method="GET">
        <h1>Servidores</h1>
        <p>Para pesquisar o servidor, digite a matrícula, nome ou setor.</p>
        <br>
        <input name="busca" placeholder="Digite para pesquisar" type="text">
        <button class="btn-busca" type="submit">Pesquisar</button>
        <button class="btn-novo">Cadastrar</button>
    </form>
</div>

<div class="table-busca">
    <table class="tableLabels">
    <tr>
        <th>Matrícula</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Setor</th>
        <th>Função</th>
        <th>Agente Consignatário</th>
        <th>Editar</th>
        <th>Excluir</th> 
    </tr>

    <?php if ($sql_query && $sql_query->num_rows > 0): ?>
        <?php while ($row = $sql_query->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['matricula']) ?></td>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['setor']) ?></td>
                <td><?= htmlspecialchars($row['funcao']) ?></td>
                <td><?= $row['is_agente_consignatario'] ? 'Sim' : 'Não' ?></td>
                <td>
                    <a href="editar_servidor.php?matricula=<?= $row['matricula'] ?>"  class="btn-editar" title="Editar">
                        <i class='bx bx-pencil'></i>
                    </a>
                 
                </td>
                <td>
                    <a href="crud/excluir_servidor.php?matricula=<?= $row['matricula'] ?>" class="btn-excluir" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este servidor?')">
                       <i class='bx bx-trash'></i>
                    </a></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">Nenhum servidor encontrado.</td>
        </tr>
    <?php endif; ?>
</table>

<div class="paginacao">
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <a href="?pagina=<?= $i ?><?= isset($pesquisa) ? '&busca=' . urlencode($pesquisa) : '' ?>"
           style="margin:0 5px; <?= ($i == $pagina) ? 'font-weight:bold;' : '' ?>">
           <?= $i ?>
        </a>
        <?php endfor; ?>
    </div>
</div>
