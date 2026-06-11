<?php

require_once __DIR__ . '/../../models/ProdutoDAO.php';
require_once __DIR__ . '/../funcoes_produtos.php';

$dao = new ProdutoDAO();

$produtos = $dao->listar();

require_once __DIR__ . '/../cabecalho.php';

echo '<div style="margin-bottom:20px;text-align:right;">';
echo '<a href="index.php?pagina=cadastro_produto"
style="background:#007bff;color:white;padding:10px 15px;text-decoration:none;border-radius:4px;font-weight:bold;">
➕ Novo Produto
</a>';
echo '</div>';

exibirTabelaProdutos($produtos);

require_once __DIR__ . '/../rodape.php';
?>