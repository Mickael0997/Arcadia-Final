<?php
/*SERVIRA de routeur pour notre application. 
Il va analyser l'URL demandée par l'utilisateur et afficher la page correspondante.*/

require_once 'vendor/autoload.php';
require_once './php/init.php';
require_once './php/security.php';

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