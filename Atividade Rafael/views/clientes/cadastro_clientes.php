<?php

require_once __DIR__ . '/../../models/ClientesDAO.php';

$dao = new ClientesDAO();

$erro = '';

$nome = '';
$cpf = '';
$email = '';
$telefone = '';
$endereco = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    if (
        empty($nome) ||
        empty($cpf) ||
        empty($email) ||
        empty($telefone) ||
        empty($endereco)
    ) {

        $erro = '❌ Todos os campos são obrigatórios.';

    } else {

        if (
            $dao->inserir(
                $nome,
                $cpf,
                $email,
                $telefone,
                $endereco
            )
        ) {

            header('Location: ../index.php?pagina=clientes');
            exit;

        } else {

            $erro = '❌ Erro ao cadastrar cliente.';

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

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    background-color: var(--bg-color);
    color: var(--text-color);
}

.btn {
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.btn:hover {
    background-color: #218838;
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

    <h2>➕ Cadastrar Cliente</h2>

    <?php if (!empty($erro)) : ?>

        <div class="alert-danger">
            <?php echo $erro; ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="form-group">

            <label for="nome">Nome *</label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="<?php echo htmlspecialchars($nome); ?>"
            >

        </div>

        <div class="form-group">

            <label for="cpf">CPF *</label>

            <input
                type="text"
                id="cpf"
                name="cpf"
                maxlength="14"
                placeholder="000.000.000-00"
                value="<?php echo htmlspecialchars($cpf); ?>"
            >

        </div>

        <div class="form-group">

            <label for="email">E-mail *</label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
            >

        </div>

        <div class="form-group">

            <label for="telefone">Telefone *</label>

            <input
                type="text"
                id="telefone"
                name="telefone"
                value="<?php echo htmlspecialchars($telefone); ?>"
            >

        </div>

        <div class="form-group">

            <label for="endereco">Endereço *</label>

            <input
                type="text"
                id="endereco"
                name="endereco"
                value="<?php echo htmlspecialchars($endereco); ?>"
            >

        </div>

        <button type="submit" class="btn">
            Salvar Cliente
        </button>

    </form>

    <div style="text-align:center;">

        <a
            href="../index.php?pagina=clientes"
            class="btn-back"
        >
            Voltar
        </a>

    </div>

</div>

<script>

document.getElementById('cpf').addEventListener('input', function (e) {

    let value = e.target.value;

    value = value.replace(/\D/g, '');

    if (value.length > 3) {
        value = value.replace(/^(\d{3})(\d)/, '$1.$2');
    }

    if (value.length > 6) {
        value = value.replace(
            /^(\d{3})\.(\d{3})(\d)/,
            '$1.$2.$3'
        );
    }

    if (value.length > 9) {
        value = value.replace(
            /^(\d{3})\.(\d{3})\.(\d{3})(\d)/,
            '$1.$2.$3-$4'
        );
    }

    e.target.value = value;

});

</script>

<?php

require_once __DIR__ . '/../rodape.php';

?>