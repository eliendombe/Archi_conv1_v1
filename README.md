# Projet Logiciel (Architecture Custom PHP)

Ce projet est une base de départ pour une application PHP avec une architecture personnalisée (Core, Routeur, MVC).

## Prérequis

- Serveur Web (Apache/Nginx) ou PHP built-in server
- PHP 7.4 ou supérieur
- MySQL / MariaDB

## Installation

1. **Cloner le projet** dans votre répertoire web.
2. **Configurer la base de données** :
   - Créez une base de données MySQL.
   - Importez le fichier `core/config/database.sql` pour créer les tables nécessaires.
   - Configurez les identifiants (host, db_name, username, password) dans `core/config/database.php`.

## Lancement Rapide

Vous pouvez utiliser le serveur interne de PHP pour tester rapidement :

```bash
php -S localhost:8000
```

Accédez ensuite à http://localhost:8000.

## Routes Disponibles

- `GET /` : Page d'accueil.
- `GET /users` : Retourne la liste des utilisateurs en JSON.
- `POST /users` : Crée un nouvel utilisateur (JSON attendu : `{"username": "...", "email": "..."}`).
- `GET /contact` : Page de contact simple.

## Architecture

Consultez le fichier [ARCHITECTURE.md](ARCHITECTURE.md) pour les détails techniques approfondis.

- `core/` : Contient toute la logique métier et le routeur.
- `index.php` : Point d'entrée à la racine.
