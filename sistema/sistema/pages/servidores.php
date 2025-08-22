<?php 
include('conexao.php');

$sql_query = null;

if (isset($_GET['busca'])) {
    $pesquisa = $mysqli->real_escape_string($_GET['busca']);
    $sql_code = "SELECT * FROM servidorpublico
        WHERE matricula LIKE '$pesquisa%'
        OR nome LIKE '$pesquisa%'
        OR email LIKE '$pesquisa%'
        OR setor LIKE '$pesquisa%'
        OR funcao LIKE '$pesquisa%'";
    $sql_query = $mysqli->query($sql_code) or die("Erro ao consultar: " . $mysqli->error);
}
?>

<div class="form-busca">
    <form action="">
        <h1>Servidores</h1>
        <p>Para pesquisar o servidor, digite a matrícula ou nome</p>
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
        <th>Ações</th> 
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
                    <!-- Ícone de editar -->
                    <a href="editar_servidor.php?matricula=<?= $row['matricula'] ?>" title="Editar">
                        <i class="fas fa-edit" style="color: #007bff; margin-right: 10px;"></i>
                    </a>
                    <!-- Ícone de excluir -->
                    <a href="excluir_servidor.php?matricula=<?= $row['matricula'] ?>" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este servidor?')">
                        <i class="fas fa-trash-alt" style="color: red;"></i>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">Nenhum servidor encontrado.</td>
        </tr>
    <?php endif; ?>
</table>