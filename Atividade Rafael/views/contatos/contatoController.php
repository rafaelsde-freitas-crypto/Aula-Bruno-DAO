<?php

require_once __DIR__ . '/../../models/ContatoDAO.php';
require_once __DIR__ . '/../funcoes.php';

$dao = new ContatoDAO();

$contatos = $dao->listar();

require_once __DIR__ . '/../cabecalho.php';

echo '<div style="margin-bottom:20px;text-align:right;">';
echo '<a href="index.php?pagina=cadastro_contato"
style="background:#007bff;color:white;padding:10px 15px;text-decoration:none;border-radius:4px;font-weight:bold;">
➕ Novo Contato
</a>';
echo '</div>';

exibirTabelaContatos($contatos);

require_once __DIR__ . '/../rodape.php';
?>