<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_NAME.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.';';
$usarDB = 'USE '.DB_NAME.';';

$crearTabela = "
    CREATE TABLE IF NOT EXISTS jogo (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        data_lanc DATE DEFAULT CURRENT_DATE,
        genero VARCHAR(100),
        dev VARCHAR(150),
        data_cad TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
";

$insertDados = "
    INSERT INTO jogo (titulo, data_lanc, genero, dev) VALUES
    ('Red Dead Redemption II','26-10-2018','Mundo Aberto','Rockstar Games'),
    ('Grand Theft Auto - San Andreas','26-10-2004','Mundo Aberto','Rockstar Games'),
    ('Hollow Knight - Silksong','04-09-2025','Metroidvania','Team Cherry')
";

try {
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, 
        username: DB_USER, 
        password: DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deleteDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($crearTabela);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
