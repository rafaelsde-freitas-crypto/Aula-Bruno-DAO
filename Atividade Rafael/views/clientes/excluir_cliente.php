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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dao->excluir($id);

    header('Location: index.php?pagina=clientes');
    exit;
}

require_once __DIR__ . '/../config/cabecalho.php';
?>
<div class="form-container">

<h2>Excluir Cliente</h2>

<p>
    Tem certeza que deseja excluir o cliente
    <strong><?= htmlspecialchars($cliente['nome']) ?></strong>?
</p>

<form method="post">

    <button type="submit"
            class="btn btn-excluir">
        Sim, Excluir
    </button>

    <a href="index.php?pagina=clientes"
       class="btn btn-voltar">
        Cancelar
    </a>

</form>

</div>

<?php
require_once __DIR__ . '/../config/rodape.php';
?>