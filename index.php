<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Configuration de la base de données
$dsn = 'mysql:host=localhost;ArcadiaFinal';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Routeur simple
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $uri) {
    // Requête à la base de données
    $stmt = $pdo->query('SELECT * FROM utilisateurs');
    $utilisateurs = $stmt->fetchAll();

    echo $twig->render('index.html.twig', ['utilisateurs' => $utilisateurs]);
} elseif ('/about' === $uri) {
    echo $twig->render('about.html.twig');
} else {
    header('HTTP/1.1 404 Not Found');
    echo $twig->render('404.html.twig');
}