<?php
// init.php

$config = require './config.php';

// Initialiser la connexion à la base de données
try {
    $pdo = new PDO(
        $config['db']['dsn'],
        $config['db']['username'],
        $config['db']['password'],
        $config['db']['options']
    );
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Configurer Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);