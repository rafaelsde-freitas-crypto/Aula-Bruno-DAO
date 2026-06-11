<?php

require_once __DIR__ . '/../config/database.php';

class ClientesDAO
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
                "SELECT * FROM clientes ORDER BY nome"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            return [];
        }
    }

    public function inserir(
        string $nome,
        string $cpf,
        string $email,
        string $telefone,
        string $endereco
    ): bool {

        try {

            $stmt = $this->pdo->prepare(
                "INSERT INTO clientes
                (nome,cpf,email,telefone,endereco)
                VALUES(?,?,?,?,?)"
            );

            return $stmt->execute([
                $nome,
                $cpf,
                $email,
                $telefone,
                $endereco
            ]);

        } catch (PDOException $e) {

            return false;
        }
    }
    public function buscarPorId(int $id): ?array
{
    try {

        $stmt = $this->pdo->prepare(
            "SELECT * FROM clientes WHERE id = ?"
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
    string $cpf,
    string $email,
    string $telefone,
    string $endereco
): bool
{
    try {

        $stmt = $this->pdo->prepare(
            "UPDATE clientes
             SET nome = ?, cpf = ?, email = ?, telefone = ?, endereco = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $nome,
            $cpf,
            $email,
            $telefone,
            $endereco,
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
            "DELETE FROM clientes WHERE id = ?"
        );

        return $stmt->execute([$id]);

    } catch (PDOException $e) {

        return false;

    }
}






}
?>