<?php

function exibirTabelaContatos(array $contatos): void
{
    if (empty($contatos)) {

        echo "<p>Nenhum contato encontrado.</p>";

        return;
    }

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Nome</th>";
    echo "<th>Email</th>";
    echo "<th>Telefone</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    foreach ($contatos as $indice => $contato) {

        $id = (int) $contato['id'];

        echo "<tr>";

        echo "<td>" . ($indice + 1) . "</td>";

        echo "<td>" .
            htmlspecialchars($contato['nome']) .
            "</td>";

        echo "<td>" .
            htmlspecialchars($contato['email']) .
            "</td>";

        echo "<td>" .
            htmlspecialchars($contato['telefone']) .
            "</td>";

            echo "
            <td>
                <a href='index.php?pagina=editar_contato&id={$contato['id']}'
                   class='btn-editar'>
                   ✏️ Editar
                </a>
            
                <a href='index.php?pagina=excluir_contato&id={$contato['id']}'
                   class='btn-excluir'>
                   🗑️ Excluir
                </a>
            </td>
            ";;

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

?>