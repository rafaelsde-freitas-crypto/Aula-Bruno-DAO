<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>

    <style>
        :root {
            --bg-color: #f5f5f5;
            --text-color: #333333;
            --card-bg: #ffffff;
            --table-bg: #ffffff;
            --header-bg: #f8f9fa;
            --border-color: #dee2e6;
            --navbar-bg: #ffffff;
            --footer-bg: #f5f5f5;
        }

        body.dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #f0f0f0;
            --card-bg: #2d2d2d;
            --table-bg: #2d2d2d;
            --header-bg: #3d3d3d;
            --border-color: #555555;
            --navbar-bg: #2d2d2d;
            --footer-bg: #2d2d2d;
        }

        * {
            transition: background-color 0.3s ease, color 0.3s ease;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .form-container {
            max-width: 700px;
            margin: 30px auto;
            background: var(--card-bg);
            padding: 25px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            background: var(--table-bg);
            color: var(--text-color);
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .btn-salvar {
            background: #28a745;
        }

        .btn-voltar {
            background: #6c757d;
        }

        .btn-excluir {
            background: #dc3545;
        }

        .imagem-preview {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }

            .btn-editar {
            background: #ffc107;
            color: #000;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-right: 5px;
            display: inline-block;
        }

        .btn-editar:hover {
            background: #e0a800;
        }

        .btn-excluir {
            background: #dc3545;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .btn-excluir:hover {
            background: #c82333;
        }

        .navbar {
            background-color: var(--navbar-bg);
            padding: 15px 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border: 1px solid var(--border-color);
        }

        .nav-brand {
            font-size: 1.2em;
            font-weight: bold;
            color: var(--text-color);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .nav-links a:hover {
            background-color: rgba(0,0,0,0.1);
        }

        body.dark-mode .nav-links a:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .theme-toggle {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            font-size: 1em;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 4px;
            color: var(--text-color);
        }

        .theme-toggle:hover {
            transform: scale(1.05);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: var(--table-bg);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid var(--border-color);
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--header-bg);
            font-weight: bold;
        }

        tr:hover {
            background-color: var(--header-bg);
        }

        h1 {
            color: var(--text-color);
            margin-bottom: 20px;
        }

        footer {
            background-color: var(--footer-bg);
            padding: 20px;
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
        }

        @media (max-width: 768px) {

            body {
                padding: 10px;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                justify-content: center;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <a href="index.php?pagina=contatos" class="nav-brand">
        📒 Agenda de Contatos
    </a>

    <a href="index.php?pagina=clientes" class="nav-brand">
        📋 Clientes
    </a>

    <a href="index.php?pagina=produtos" class="nav-brand">
        📦 Produtos
    </a>

    <div class="nav-links">

        <a href="index.php">
            🏠 Início
        </a>

        <button
            type="button"
            class="theme-toggle"
            onclick="toggleDarkMode()"
        >
            🌓 Dark / Light
        </button>

    </div>

</nav>

<h1>Lista de Contatos, Clientes e Produtos</h1>

<script>

function toggleDarkMode()
{
    document.body.classList.toggle('dark-mode');

    localStorage.setItem(
        'darkMode',
        document.body.classList.contains('dark-mode')
    );
}

if (localStorage.getItem('darkMode') === 'true')
{
    document.body.classList.add('dark-mode');
}

</script>