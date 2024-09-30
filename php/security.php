<?php
// security.php

// Fonction pour valider les entrées
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Fonction pour générer un token CSRF
function generateCsrfToken() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Fonction pour vérifier un token CSRF
function verifyCsrfToken($token) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}