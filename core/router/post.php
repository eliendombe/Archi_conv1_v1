<?php

function handlePostRequest($routes) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    $uri = ($uri === '') ? '/' : '/' . $uri;

    if (array_key_exists($uri, $routes)) {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data && !empty($_POST)) {
            $data = $_POST;
        }
        call_user_func($routes[$uri], $data);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found (POST)']);
    }
}
