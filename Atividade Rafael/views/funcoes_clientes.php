<?php

function exibirTabelaClientes(array $clientes): void
{
    if (empty($clientes)) {

        echo "<p>Nenhum cliente encontrado.</p>";

        return;
    }

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Nome</th>";
    echo "<th>CPF</th>";
    echo "<th>Email</th>";
    echo "<th>Telefone</th>";
    echo "<th>Endereço</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    foreach ($clientes as $indice => $cliente) {

        $id = (int) $cliente['id'];

        echo "<tr>";

        echo "<td>" . ($indice + 1) . "</td>";

        echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";

        echo "<td>" . htmlspecialchars($cliente['cpf']) . "</td>";

        echo "<td>" . htmlspecialchars($cliente['email']) . "</td>";

        echo "<td>" . htmlspecialchars($cliente['telefone']) . "</td>";

        echo "<td>" . htmlspecialchars($cliente['endereco']) . "</td>";

        echo "
        <td>
            <a href='index.php?pagina=editar_contato&id={$cliente['id']}'
               class='btn-editar'>
               ✏️ Editar
            </a>
        
            <a href='index.php?pagina=excluir_contato&id={$cliente['id']}'
               class='btn-excluir'>
               🗑️ Excluir
            </a>
        </td>
        ";
    }

    echo "</tbody>";
    echo "</table>";
}

?>