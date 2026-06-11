<?php

function exibirTabelaProdutos(array $produtos): void
{
    if (empty($produtos)) {

        echo "<p>Nenhum produto encontrado.</p>";

        return;
    }

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Nome</th>";
    echo "<th>Descrição</th>";
    echo "<th>Preço</th>";
    echo "<th>Estoque</th>";
    echo "<th>Imagem</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    foreach ($produtos as $indice => $produto) {

        $id = (int) $produto['id'];

        $foto = !empty($produto['imagem'])
            ? $produto['imagem']
            : 'sem-foto.png';

        echo "<tr>";

        echo "<td>" . ($indice + 1) . "</td>";

        echo "<td>" .
            htmlspecialchars($produto['nome']) .
            "</td>";

        echo "<td>" .
            htmlspecialchars($produto['descricao']) .
            "</td>";

        echo "<td>R$ " .
            number_format(
                (float)$produto['preco'],
                2,
                ',',
                '.'
            ) .
            "</td>";

        echo "<td>" .
            htmlspecialchars($produto['estoque']) .
            "</td>";

        echo "<td>
        <img src='uploads/{$foto}'
        width='50'>
        </td>";

        echo "
        <td>
            <a href='index.php?pagina=editar_contato&id={$produto['id']}'
            class='btn-editar'>
            ✏️ Editar
            </a>

            <a href='index.php?pagina=excluir_contato&id={$produto['id']}'
            class='btn-excluir'>
            🗑️ Excluir
            </a>
        </td>
        ";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

?>