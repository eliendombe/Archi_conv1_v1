<?php

// Activation de l'affichage des erreurs pour le développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion de la configuration et des helpers
require_once __DIR__ . '/core/config/database.php';

// Inclusion des gestionnaires de méthodes HTTP
require_once __DIR__ . '/core/router/get.php';
require_once __DIR__ . '/core/router/post.php';
require_once __DIR__ . '/core/router/put.php';
require_once __DIR__ . '/core/router/delete.php';

// Définition des routes
// On inclut le fichier qui définit les routes et retourne les tableaux de mapping
$routes = require_once __DIR__ . '/core/routers/index.php';

// Détermination de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Dispatching
switch ($method) {
    case 'GET':
        handleGetRequest($routes['GET']);
        break;
    case 'POST':
        handlePostRequest($routes['POST']);
        break;
    case 'PUT':
        handlePutRequest($routes['PUT']);
        break;
    case 'DELETE':
        handleDeleteRequest($routes['DELETE']);
        break;
    case 'OPTIONS':
        // Gestion basique du CORS pour les options
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        exit(0);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
