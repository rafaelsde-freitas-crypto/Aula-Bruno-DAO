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

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim(
        $_POST['nome'] ?? ''
    );

    $descricao = trim(
        $_POST['descricao'] ?? ''
    );

    $preco = (float) str_replace(
        ',',
        '.',
        $_POST['preco'] ?? 0
    );

    $estoque = (int) (
        $_POST['estoque'] ?? 0
    );

    $imagem = $produto['imagem'];

    if (
        isset($_FILES['imagem'])
        && $_FILES['imagem']['error']
        === UPLOAD_ERR_OK
    ) {

        if (!empty($produto['imagem'])) {

            $dao->excluirImagem(
                $produto['imagem']
            );
        }

        $extensao = pathinfo(
            $_FILES['imagem']['name'],
            PATHINFO_EXTENSION
        );

        $imagem = uniqid()
            . '.'
            . $extensao;

        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            __DIR__
            . '/../uploads/'
            . $imagem
        );
    }

    if (

        $dao->atualizar(
            $id,
            $nome,
            $descricao,
            $preco,
            $estoque,
            $imagem
        )

    ) {

        header(
            'Location: index.php?pagina=produtos'
        );

        exit;
    }

    $erro = 'Erro ao atualizar.';
}

require_once __DIR__ . '/../cabecalho.php';

?>

<div class="form-container">

    <h2>Editar Produto</h2>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nome</label>
            <input
                type="text"
                name="nome"
                value="<?= htmlspecialchars($produto['nome']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea
                name="descricao"
                rows="4"><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input
                type="number"
                step="0.01"
                name="preco"
                value="<?= $produto['preco'] ?>"
                required>
        </div>

        <div class="form-group">
            <label>Estoque</label>
            <input
                type="number"
                name="estoque"
                value="<?= $produto['estoque'] ?>"
                required>
        </div>

        <div class="form-group">
            <label>Nova Imagem</label>
            <input
                type="file"
                name="imagem">
        </div>

        <?php if (!empty($produto['imagem'])): ?>

            <p>Imagem Atual:</p>

            <img
                src="<?= htmlspecialchars($produto['imagem']) ?>"
                class="imagem-preview"
                alt="Imagem do Produto">

        <?php endif; ?>

        <br>

        <button type="submit" class="btn btn-salvar">
            Salvar Alterações
        </button>

        <a href="index.php?pagina=produtos"
           class="btn btn-voltar">
            Voltar
        </a>

    </form>

</div>

<?php

require_once __DIR__ . '/../rodape.php';

?>