<?php

function handleDeleteRequest($routes) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    $uri = ($uri === '') ? '/' : '/' . $uri;

    if (array_key_exists($uri, $routes)) {
        call_user_func($routes[$uri]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found (DELETE)']);
    }
}
