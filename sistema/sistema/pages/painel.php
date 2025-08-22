<?php 
include('./conexao.php');


$itens_por_pagina = 15;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $itens_por_pagina;

$pesquisa = isset($_GET['busca']) ? $mysqli->real_escape_string($_GET['busca']) : '';
$condicao = '';
if($pesquisa != ''){
    $condicao = "WHERE codigo_mec LIKE '$pesquisa%'
                OR tipo LIKE '$pesquisa%'
                OR modelo LIKE '$pesquisa%'
                OR marca LIKE '$pesquisa%'
                OR situacao LIKE '$pesquisa%'
                OR coordenacao LIKE '$pesquisa%'";
    }

    $sql_total = "SELECT COUNT(*) as total FROM patrimonio $condicao";
    $total_query = $mysqli->query($sql_total) or die("Erro ao contar resultados" . $mysqli->error);
    $total_resultado = $total_query->fetch_assoc();
    $total_registros = $total_resultado['total'];
    $total_paginas = ceil($total_registros / $itens_por_pagina);

    $sql_code = "SELECT * FROM patrimonio $condicao ORDER BY coordenacao ASC LIMIT $itens_por_pagina OFFSET $offset";
    $sql_query = $mysqli->query($sql_code) or die ("Erro ao consultar: " . $mysqli->error);
?>

<div class="form-busca">
    <form action="">
        <h1>Patrimônio</h1>
        <p>Para pesquisar o patrimônio digite a data, patrimônio ou nome do servidor</p>
        <br>
        <input name="busca" placeholder="Digite para pesquisar" type="text">
        <button class="btn-busca" type="submit">Pesquisar</button>
        <button class="btn-novo">Cadastrar</button>
    </form>
</div>

<div class="table-busca">
    <table class="tableLabels">
        <tr>
            <th>Código MEC</th>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Situação</th>
            <th>Coordenação</th>
            <th>Usuário</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>

        <?php if ($sql_query && $sql_query->num_rows > 0): ?>
            <?php while ($row = $sql_query->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['codigo_mec']) ?></td>
                    <td><?= htmlspecialchars($row['tipo']) ?></td>
                    <td><?= htmlspecialchars($row['modelo']) ?></td>
                    <td><?= htmlspecialchars($row['marca']) ?></td>
                    <td><?= htmlspecialchars($row['situacao']) ?></td>
                    <td><?= htmlspecialchars($row['coordenacao']) ?></td>
                    <td><?= htmlspecialchars($row['matricula']) ?></td>
                    <td>
                        <a href="crud/editar_patri.php?codigo_mec=<?=urlencode($row['codigo_mec']) ?>" class="btn-editar" title="Editar">
                            <box-icon name='pencil'></box-icon>
                        </a>
                    </td>
                    <td>
                        <a href="crud/excluir_patri.php?codigo_mec=<?= urlencode($row['codigo_mec']) ?>" class="btn-excluir" title="Excluir" onclick="return confirm('Deseja realmente excluir este item?');">
                            <box-icon name='trash-alt'></box-icon>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Nenhum servidor encontrado.</td>
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