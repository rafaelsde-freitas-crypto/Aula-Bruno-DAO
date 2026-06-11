<?php

require_once __DIR__ . '/../config/database.php';

class ContatoDAO
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
                "SELECT * FROM contatos ORDER BY nome"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            return [];
        }
    }

    public function inserir(
        string $nome,
        string $email,
        string $telefone
    ): bool {

        try {

            $stmt = $this->pdo->prepare(
                "INSERT INTO contatos(nome,email,telefone)
                 VALUES(?,?,?)"
            );

            return $stmt->execute([
                $nome,
                $email,
                $telefone
            ]);

        } catch (PDOException $e) {

            return false;
        }
    }

    public function buscarPorId(int $id): ?array
{
    try {

        $stmt = $this->pdo->prepare(
            "SELECT * FROM contatos WHERE id = ?"
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
    string $email,
    string $telefone
): bool
{
    try {

        $stmt = $this->pdo->prepare(
            "UPDATE contatos
             SET nome = ?, email = ?, telefone = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $nome,
            $email,
            $telefone,
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
            "DELETE FROM contatos WHERE id = ?"
        );

        return $stmt->execute([$id]);

    } catch (PDOException $e) {

        return false;

    }
}



}

?>