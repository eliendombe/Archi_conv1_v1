<?php

function handleGetRequest($routes) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Nettoyage de l'URI pour éviter les problèmes de trailing slash
    $uri = trim($uri, '/');
    if ($uri === '') {
        $uri = '/'; // Racine
    } else {
        $uri = '/' . $uri; // S'assurer que ça commence par /
    }

    if (array_key_exists($uri, $routes)) {
        call_user_func($routes[$uri]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found (GET)']);
    }
}
