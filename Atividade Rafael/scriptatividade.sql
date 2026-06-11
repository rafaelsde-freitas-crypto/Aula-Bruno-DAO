create database agenda;
use agenda;


-- 3. Criar tabela contatos
CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(14),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 

-- 4. Criar tabela clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(14),
    endereco VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Criar tabela produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); alter table produtos add column imagem VARCHAR (255) null;




-- 6. Inserir registros na tabela contatos
INSERT INTO contatos (nome, email, telefone) VALUES
('João Silva', 'joao.silva@email.com', '(11) 91234-5678'),
('Maria Oliveira', 'maria.oliveira@email.com', '(21) 98765-4321'),
('Carlos Souza', 'carlos.souza@email.com', '(31) 99876-5432');

-- Inserir registros na tabela clientes
INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES
('Ana Paula Santos', '123.456.789-00', 'ana.santos@email.com', '(11) 95555-7777', 'Rua A, 123, São Paulo - SP'),
('Roberto Lima', '987.654.321-00', 'roberto.lima@email.com', '(21) 94444-6666', 'Av. B, 456, Rio de Janeiro - RJ'),
('Fernanda Costa', '456.789.123-00', 'fernanda.costa@email.com', '(31) 93333-5555', 'Rua C, 789, Belo Horizonte - MG');

-- Inserir registros na tabela produtos
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Smartphone XYZ', 'Smartphone com 128GB, tela 6.5 polegadas', 1999.99, 50),
('Notebook ABC', 'Notebook com 16GB RAM, SSD 512GB', 4599.90, 30),
('Fone de Ouvido Bluetooth', 'Fone sem fio com cancelamento de ruído', 299.90, 100);

-- 7. Consultar dados das tabelas
SELECT * FROM contatos;		
SELECT * FROM clientes;
SELECT * FROM produtos;

SELECT id, nome, cpf, email, telefone, endereco FROM clientes ORDER BY nome;

UPDATE clientes SET nome = ?, email = ?, telefone = ? WHERE id = ?