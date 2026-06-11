<?php

require_once __DIR__ . '/../../models/ProdutoDAO.php';

$dao = new ProdutoDAO();

$erro = '';

$nome = '';
$descricao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    $precoRaw = str_replace(',', '.', trim($_POST['preco'] ?? ''));
    $preco = filter_var($precoRaw, FILTER_VALIDATE_FLOAT);

    $estoque = filter_input(
        INPUT_POST,
        'estoque',
        FILTER_VALIDATE_INT
    );

    $nomeArquivo = null;

    if (
        empty($nome) ||
        $preco === false ||
        $estoque === false
    ) {

        $erro = '❌ Preencha todos os campos obrigatórios corretamente.';

    } elseif ($preco <= 0) {

        $erro = '❌ O preço deve ser maior que zero.';

    } elseif ($estoque < 0) {

        $erro = '❌ O estoque não pode ser negativo.';

    } else {

        if (
            !empty($_FILES['imagem']['name']) &&
            $_FILES['imagem']['error'] === UPLOAD_ERR_OK
        ) {

            $extensao = strtolower(
                pathinfo(
                    $_FILES['imagem']['name'],
                    PATHINFO_EXTENSION
                )
            );

            $permitidos = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $mime = finfo_file(
                $finfo,
                $_FILES['imagem']['tmp_name']
            );

            finfo_close($finfo);

            $mimesPermitidos = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (
                !in_array($extensao, $permitidos) ||
                !in_array($mime, $mimesPermitidos)
            ) {

                $erro =
                    '❌ Apenas imagens JPG, PNG e WEBP são permitidas.';

            } else {

                $nomeArquivo =
                    uniqid('prod_') .
                    '.' .
                    $extensao;

                $destino =
                    __DIR__ .
                    '/../uploads/' .
                    $nomeArquivo;

                if (
                    !move_uploaded_file(
                        $_FILES['imagem']['tmp_name'],
                        $destino
                    )
                ) {

                    $erro =
                        '❌ Erro ao salvar a imagem.';
                }
            }
        }

        if (empty($erro)) {

            if (
                $dao->inserir(
                    $nome,
                    $descricao,
                    (float)$preco,
                    (int)$estoque,
                    $nomeArquivo
                )
            ) {

                header(
                    'Location: ../index.php?pagina=produtos'
                );

                exit;

            } else {

                $erro =
                    '❌ Erro ao cadastrar produto.';
            }
        }
    }
}

require_once __DIR__ . '/../cabecalho.php';
?>

<style>

.form-container {
    background-color: var(--card-bg);
    border: 1px solid var(--border-color);
    padding: 25px;
    border-radius: 8px;
    max-width: 550px;
    margin: 20px auto;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    background-color: var(--bg-color);
    color: var(--text-color);
}

.btn {
    background-color: #ffc107;
    color: #212529;
    padding: 10px;
    border: none;
    border-radius: 4px;
    width: 100%;
    cursor: pointer;
    font-weight: bold;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.btn-back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: var(--text-color);
}

</style>

<div class="form-container">

    <h2>📦 Novo Produto</h2>

    <?php if (!empty($erro)) : ?>

        <div class="alert-danger">
            <?php echo $erro; ?>
        </div>

    <?php endif; ?>

    <form
        method="POST"
        enctype="multipart/form-data"
    >

        <div class="form-group">

            <label for="nome">
                Nome do Produto *
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                required
                value="<?php echo htmlspecialchars($nome); ?>"
            >

        </div>

        <div class="form-group">

            <label for="descricao">
                Descrição
            </label>

            <textarea
                id="descricao"
                name="descricao"
                rows="3"
            ><?php echo htmlspecialchars($descricao); ?></textarea>

        </div>

        <div class="form-group">

            <label for="preco">
                Preço *
            </label>

            <input
                type="text"
                id="preco"
                name="preco"
                placeholder="0,00"
                required
                value="<?php echo htmlspecialchars($_POST['preco'] ?? ''); ?>"
            >

        </div>

        <div class="form-group">

            <label for="estoque">
                Estoque *
            </label>

            <input
                type="number"
                id="estoque"
                name="estoque"
                min="0"
                required
                value="<?php echo htmlspecialchars($_POST['estoque'] ?? ''); ?>"
            >

        </div>

        <div class="form-group">

            <label for="imagem">
                Imagem do Produto
            </label>

            <input
                type="file"
                id="imagem"
                name="imagem"
                accept="image/*"
            >

        </div>

        <button
            type="submit"
            class="btn"
        >
            Cadastrar Produto
        </button>

    </form>

    <div style="text-align:center;">

        <a
            href="../index.php?pagina=produtos"
            class="btn-back"
        >
            Voltar
        </a>

    </div>

</div>

<?php

require_once __DIR__ . '/../rodape.php';

?>