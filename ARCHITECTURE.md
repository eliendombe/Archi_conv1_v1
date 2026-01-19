# Architecture du Projet

Ce document décrit l'architecture technique du projet. Le projet repose sur une structure PHP personnalisée, organisée autour d'un noyau (`core`) qui gère le routage, la configuration et les interactions avec la base de données.

## Structure des Dossiers

La structure du projet est la suivante :

```
/
├── core/                   # Cœur de l'application
│   ├── config/             # Fichiers de configuration
│   │   ├── database.php    # Configuration de la connexion BDD (PDO, credentials)
│   │   └── database.sql    # Schéma de la base de données (SQL)
│   ├── doc/                # Documentation interne
│   ├── models/             # Modèles de données (Accès BDD)
│   ├── router/             # Logique de gestion des requêtes HTTP
│   │   ├── get.php         # Gestion des requêtes GET
│   │   ├── post.php        # Gestion des requêtes POST
│   │   ├── put.php         # Gestion des requêtes PUT
│   │   ├── delete.php      # Gestion des requêtes DELETE
│   │   └── options.php     # Gestion des requêtes OPTIONS (CORS)
│   ├── routers/            # Définition des routes et points de terminaison
│   │   └── index.php       # Point d'entrée des routes
│   └── index.php           # (Possiblement un fichier index secondaire ou obsolète)
└── index.php               # Point d'entrée principal de l'application
```

## Composants Clés

### 1. Point d'Entrée (`index.php`)
Le fichier `index.php` à la racine est le point d'entrée unique de l'application. Il est responsable de :
- Charger l'autoloader (si présent).
- Initialiser la configuration.
- Instancier et lancer le routeur.

### 2. Configuration (`core/config`)
Contient les paramètres essentiels :
- **database.php** : Paramètres de connexion à la base de données (Hôte, Nom de la base, Utilisateur, Mot de passe).
- **database.sql** : Script SQL pour l'initialisation de la structure de la base de données.

### 3. Le Routeur (`core/router`)
Le système de routage semble être séparé par méthode HTTP, ce qui permet une gestion modulaire des requêtes :
- Chaque fichier (`get.php`, `post.php`, etc.) gère la logique spécifique à son verbe HTTP.
- Cela permet d'isoler le traitement des formulaires (POST) de la récupération de données (GET) ou des mises à jour (PUT/DELETE).

### 4. Les Routes (`core/routers`)
Ce dossier est destiné à contenir la définition des chemins URL de l'application.
- **index.php** : Probablement le fichier qui centralise l'inclusion des fichiers de routes ou définit les routes principales.

### 5. Les Modèles (`core/models`)
Les modèles sont responsables de l'interaction avec la base de données (CRUD). Ils encapsulent la logique métier liée aux données.

## Flux d'Exécution (Théorique)

1. **Requête HTTP** : L'utilisateur accède à une URL.
2. **Entrée** : `index.php` reçoit la requête.
3. **Configuration** : Les fichiers de `core/config` sont chargés.
4. **Routage** : Le système détermine la méthode HTTP (GET, POST, etc.) et dirige la requête vers le fichier approprié dans `core/router`.
5. **Dispatching** : Le routeur analyse l'URL et appelle le contrôleur ou la logique définie dans `core/routers`.
6. **Données** : Si nécessaire, le routeur fait appel aux modèles dans `core/models` pour récupérer ou persister des données.
7. **Réponse** : Le résultat est renvoyé au client (HTML, JSON, etc.).
