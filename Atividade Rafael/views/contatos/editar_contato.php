<?php

require_once __DIR__ . '/../../models/ContatoDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php?pagina=contatos');
    exit;
}

$dao = new ContatoDAO();

$contato = $dao->buscarPorId($id);

if (!$contato) {
    header('Location: index.php?pagina=contatos');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($email)) {

        $erro = 'Nome e e-mail são obrigatórios.';

    } else {

        if ($dao->atualizar(
            $id,
            $nome,
            $email,
            $telefone
        )) {

            header('Location: index.php?pagina=contatos');
            exit;
        }

        $erro = 'Erro ao atualizar contato.';
    }
}

require_once __DIR__ . '/../cabecalho.php';
?>

<div class="form-container">

    <h2>Editar Contato</h2>

    <form method="post">

        <div class="form-group">
            <label>Nome</label>
            <input
                type="text"
                name="nome"
                value="<?= htmlspecialchars($contato['nome']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($contato['email']) ?>">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input
                type="text"
                name="telefone"
                value="<?= htmlspecialchars($contato['telefone']) ?>">
        </div>

        <button type="submit" class="btn btn-salvar">
            Salvar Alterações
        </button>

        <a href="index.php?pagina=contatos"
           class="btn btn-voltar">
            Voltar
        </a>

    </form>

</div>

<?php
require_once __DIR__ . '/../rodape.php';
?>