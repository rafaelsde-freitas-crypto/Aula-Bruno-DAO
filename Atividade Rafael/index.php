<?php

$pagina = $_GET['pagina'] ?? 'contatos';

switch ($pagina) {

    case 'contatos':
        require_once 'views/contatos/contatoController.php';
        break;

    case 'clientes':
        require_once 'views/clientes/clienteController.php';
        break;

    case 'produtos':
        require_once 'views/produtos/produtoController.php';
        break;

    case 'cadastro_contato':
        require_once 'views/contatos/cadastro_contato.php';
        break;

    case 'cadastro_cliente':
        require_once 'views/clientes/cadastro_clientes.php';
        break;

    case 'cadastro_produto':
        require_once 'views/produtos/cadastro_produto.php';
        break;

    case 'editar_contato':
        require_once 'views/contatos/editar_contato.php';
        break;

    case 'editar_cliente':
        require_once 'views/clientes/editar_cliente.php';
        break;

    case 'editar_produto':
        require_once 'views/produtos/editar_produto.php';
        break;

    case 'excluir_contato':
        require_once 'views/contatos/excluir_contato.php';
        break;

    case 'excluir_cliente':
        require_once 'views/clientes/excluir_cliente.php';
        break;

    case 'excluir_produto':
        require_once 'views/produtos/excluir_produto.php';
        break;

    default:
        echo "<h2>Página não encontrada</h2>";
}
?>