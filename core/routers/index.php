<?php

require_once __DIR__ . '/../models/User.php';

return [
    'GET' => [
        '/' => function() {
            echo "<h1>Bienvenue sur l'API Custom PHP</h1>";
            echo "<p>Ceci est une route GET de base.</p>";
            echo "<a href='/users'>Voir les utilisateurs (JSON)</a>";
        },
        '/users' => function() {
            header('Content-Type: application/json');
            try {
                $userModel = new User();
                $users = $userModel->getAll();
                echo json_encode($users);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        },
        '/contact' => function() {
            echo "<h1>Page de contact</h1>";
        }
    ],
    'POST' => [
        '/users' => function($data) {
            header('Content-Type: application/json');
            if (!isset($data['username']) || !isset($data['email'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Missing username or email']);
                return;
            }

            try {
                $userModel = new User();
                $success = $userModel->create($data['username'], $data['email']);
                if ($success) {
                    http_response_code(201);
                    echo json_encode(['message' => 'User created']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to create user']);
                }
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    ],
    'PUT' => [],
    'DELETE' => []
];
