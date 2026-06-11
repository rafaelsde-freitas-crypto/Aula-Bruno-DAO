# Sistema de Agenda de Contatos, Clientes e Produtos

## Descrição

Este projeto foi desenvolvido em PHP utilizando PDO para acesso ao banco de dados MySQL.

O sistema permite realizar operações de CRUD (Cadastrar, Listar, Editar e Excluir) para:

- Contatos
- Clientes
- Produtos

Além disso, o projeto foi refatorado utilizando separação em camadas para organizar melhor as responsabilidades do sistema.

---

# Estrutura do Projeto

```text
projeto/
│
├── config/
│   └── database.php
│
├── models/
│   ├── ClienteDAO.php
│   ├── ContatoDAO.php
│   └── ProdutoDAO.php
│
├── views/
│   ├── cabecalho.php
│   ├── rodape.php
│   │
│   ├── contatos/
│   ├── clientes/
│   └── produtos/
│
├── uploads/
│
├── index.php
│
└── README.md
```

---

# Responsabilidades das Pastas

## config

Responsável pelas configurações da aplicação.

Arquivo:

- database.php → conexão com banco de dados utilizando PDO.

---

## models

Responsável pela camada de acesso aos dados.

Classes:

- ClienteDAO
- ContatoDAO
- ProdutoDAO

Essas classes executam consultas SQL, inserções, atualizações e exclusões.

---

## views

Responsável pela apresentação da aplicação.

Contém:

- Formulários
- Tabelas
- Cabeçalho
- Rodapé
- Páginas de listagem

As views exibem apenas conteúdo visual para o usuário.

---

## uploads

Armazena as imagens enviadas pelos usuários durante o cadastro de produtos.

---

## index.php

Funciona como roteador simples da aplicação.

Ele recebe parâmetros via GET e decide qual página será carregada.

Exemplo:

```php
index.php?pagina=produtos
```

---

# Banco de Dados

Banco utilizado:

```sql
atividade2
```

Configuração da conexão:

```php
$host = "localhost";
$dbname = "agenda";
$user = "root";
$pass = "";
```

---

# Como Executar

## 1. Iniciar o XAMPP

Inicie:

- Apache
- MySQL

---

## 2. Criar o Banco

Abra o phpMyAdmin.

Crie o banco:

```sql
agenda
```

Importe o script SQL do projeto.

---

## 3. Colocar o Projeto na Pasta do Servidor

Exemplo:

```text
C:\xampp\htdocs\projeto
```

---

## 4. Abrir no Navegador

```text
http://localhost/projeto
```

ou

```text
http://localhost/projeto/index.php
```

---

# Funcionalidades

## Contatos

- Cadastrar
- Listar
- Editar
- Excluir

## Clientes

- Cadastrar
- Listar
- Editar
- Excluir

## Produtos

- Cadastrar
- Listar
- Editar
- Excluir
- Upload de imagem

---

# Tecnologias Utilizadas

- PHP 8+
- PDO
- MySQL
- HTML5
- CSS3
- JavaScript

---

# Autor

Rafael Soares