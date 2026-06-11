<?php

require_once __DIR__ . '/../config/database.php';

class ProdutoDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        try {

            $stmt = $this->pdo->query(
                "SELECT *
                 FROM produtos
                 ORDER BY nome"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            return [];
        }
    }

    public function inserir(
        string $nome,
        string $descricao,
        float $preco,
        int $estoque,
        ?string $imagem
    ): bool
    {
        try {

            $stmt = $this->pdo->prepare(
                "INSERT INTO produtos
                (nome, descricao, preco, estoque, imagem)
                VALUES (?, ?, ?, ?, ?)"
            );

            return $stmt->execute([
                $nome,
                $descricao,
                $preco,
                $estoque,
                $imagem
            ]);

        } catch (PDOException $e) {

            return false;
        }
    }
    public function buscarPorId(int $id): ?array
{
    try {

        $stmt = $this->pdo->prepare(
            "SELECT * FROM produtos WHERE id = ?"
        );

        $stmt->execute([$id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;

    } catch (PDOException $e) {

        return null;

    }
}

public function atualizar(
    int $id,
    string $nome,
    string $descricao,
    float $preco,
    int $estoque,
    ?string $imagem
): bool
{
    try {

        $stmt = $this->pdo->prepare(
            "UPDATE produtos
             SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $nome,
            $descricao,
            $preco,
            $estoque,
            $imagem,
            $id
        ]);

    } catch (PDOException $e) {

        return false;

    }
}

public function excluir(int $id): bool
{
    try {

        $stmt = $this->pdo->prepare(
            "DELETE FROM produtos WHERE id = ?"
        );

        return $stmt->execute([$id]);

    } catch (PDOException $e) {

        return false;

    }
}

public function excluirImagem(string $imagem): void
{
    $caminho = __DIR__ . '/../uploads/' . $imagem;

    if (
        !empty($imagem)
        && file_exists($caminho)
    ) {
        unlink($caminho);
    }
}

public function atualizarSemImagem(
    int $id,
    string $nome,
    string $descricao,
    float $preco,
    int $estoque
): bool
{
    try {

        $stmt = $this->pdo->prepare(
            "UPDATE produtos
             SET nome = ?,
                 descricao = ?,
                 preco = ?,
                 estoque = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $nome,
            $descricao,
            $preco,
            $estoque,
            $id
        ]);

    } catch (PDOException $e) {

        return false;
    }
}



}

?>