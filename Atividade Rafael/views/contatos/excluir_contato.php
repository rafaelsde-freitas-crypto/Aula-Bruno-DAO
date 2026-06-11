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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dao->excluir($id);

    header('Location: index.php?pagina=contatos');
    exit;
}

require_once __DIR__ . '/../cabecalho.php';
?>

<div class="form-container">

    <h2>Excluir Contato</h2>

    <p>
        Tem certeza que deseja excluir o contato
        <strong><?= htmlspecialchars($contato['nome']) ?></strong>?
    </p>

    <form method="post">

        <button type="submit"
                class="btn btn-excluir">
            Sim, Excluir
        </button>

        <a href="index.php?pagina=contatos"
           class="btn btn-voltar">
            Cancelar
        </a>

    </form>

</div>

<?php
require_once __DIR__ . '/../rodape.php';
?>