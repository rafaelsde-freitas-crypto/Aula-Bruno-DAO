<?php

require_once __DIR__ . '/../../models/ClientesDAO.php';
require_once __DIR__ . '/../funcoes_clientes.php';

$dao = new ClientesDAO();

$clientes = $dao->listar();

require_once __DIR__ . '/../cabecalho.php';

echo '<div style="margin-bottom:20px;text-align:right;">';
echo '<a href="index.php?pagina=cadastro_cliente"
style="background:#007bff;color:white;padding:10px 15px;text-decoration:none;border-radius:4px;font-weight:bold;">
➕ Novo Cliente
</a>';
echo '</div>';

exibirTabelaClientes($clientes);

require_once __DIR__ . '/../rodape.php';
?>