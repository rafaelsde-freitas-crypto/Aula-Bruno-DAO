<?php

require_once __DIR__ . '/../../models/ProdutoDAO.php';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {

    header(
        'Location: index.php?pagina=produtos'
    );

    exit;
}

$dao = new ProdutoDAO();

$produto = $dao->buscarPorId($id);

if (!$produto) {

    header(
        'Location: index.php?pagina=produtos'
    );

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($produto['imagem'])) {

        $dao->excluirImagem(
            $produto['imagem']
        );
    }

    $dao->excluir($id);

    header(
        'Location: index.php?pagina=produtos'
    );

    exit;
}

require_once __DIR__ . '/../cabecalho.php';

?>

<div class="form-container">

    <h2>Excluir Produto</h2>

    <p>
        Tem certeza que deseja excluir o produto
        <strong><?= htmlspecialchars($produto['nome']) ?></strong>?
    </p>

    <?php if (!empty($produto['imagem'])): ?>

        <img
            src="<?= htmlspecialchars($produto['imagem']) ?>"
            class="imagem-preview"
            alt="Produto">

    <?php endif; ?>

    <form method="post">

        <button type="submit"
                class="btn btn-excluir">
            Sim, Excluir
        </button>

        <a href="index.php?pagina=produtos"
           class="btn btn-voltar">
            Cancelar
        </a>

    </form>

</div>

<?php

require_once __DIR__ . '/../rodape.php';
?>