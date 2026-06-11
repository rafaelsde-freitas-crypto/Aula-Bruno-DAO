<?php

require_once __DIR__ . '/../../models/ClientesDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php?pagina=clientes');
    exit;
}

$dao = new ClientesDAO();

$cliente = $dao->buscarPorId($id);

if (!$cliente) {
    header('Location: index.php?pagina=clientes');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    if ($dao->atualizar(
        $id,
        $nome,
        $cpf,
        $email,
        $telefone,
        $endereco
    )) {

        header('Location: index.php?pagina=clientes');
        exit;
    }

    $erro = 'Erro ao atualizar cliente.';
}

require_once __DIR__ . '/../cabecalho.php';
?>

<div class="form-container">

    <h2>Editar Cliente</h2>

    <form method="post">

        <div class="form-group">
            <label>Nome</label>
            <input
                type="text"
                name="nome"
                value="<?= htmlspecialchars($cliente['nome']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($cliente['email']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input
                type="text"
                name="telefone"
                value="<?= htmlspecialchars($cliente['telefone']) ?>">
        </div>

        <button type="submit" class="btn btn-salvar">
            Salvar Alterações
        </button>

        <a href="index.php?pagina=clientes"
           class="btn btn-voltar">
            Voltar
        </a>

    </form>

</div>

<?php
require_once __DIR__ . '/../rodape.php';
?>