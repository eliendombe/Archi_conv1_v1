# Processus et documentation pour les prochaines mises à jour

Résumé
-----
Ce document décrit le processus recommandé pour préparer, tester, documenter et déployer les prochaines mises à jour du projet Archi_conv1_v1. Il contient des modèles de notes de version, listes de contrôle, stratégies de branche et consignes de communication.

Objectifs
--------
- Garantir des mises à jour fiables et reproductibles.
- Assurer une communication claire aux utilisateurs et contributeurs.
- Minimiser les risques (régressions, pertes de données).
- Standardiser la création de notes de version.

Versioning
---------
- Utiliser Semantic Versioning (SemVer) : MAJOR.MINOR.PATCH
  - MAJOR : changements incompatibles de l'API
  - MINOR : nouvelles fonctionnalités rétrocompatibles
  - PATCH : corrections de bugs et petits ajustements
- Exemple : 1.4.2 -> 1 (MAJOR), 4 (MINOR), 2 (PATCH)

Stratégie de branches
--------------------
- main (ou master) : branche de production (toujours déployable)
- develop : branche d'intégration (regroupe les fonctionnalités prêtes)
- feature/<nom> : nouvelles fonctionnalités ou améliorations
- hotfix/<nom> : corrections urgentes appliquées à main
- release/<version> : préparation de release (tests finaux, documentation)

Checklist avant création d'une release
-------------------------------------
- [ ] Toutes les issues et PRs ciblées sont listées et liées à la release
- [ ] Tests unitaires et d'intégration passent localement et en CI
- [ ] Revue de code effectuée et corrections appliquées
- [ ] Mise à jour du changelog (modèle ci-dessous)
- [ ] Documentation utilisateur/administrateur à jour
- [ ] Vérification des migrations DB et commandes de rollback
- [ ] Plan de déploiement et rollback préparé

Template de notes de version (CHANGELOG / Release notes)
--------------------------------------------------------
Titre : Version X.Y.Z — YYYY-MM-DD

Résumé :
- Phrase courte décrivant l'objectif principal de la release.

Nouvelles fonctionnalités :
- #<issue> : Courte description (auteur)

Améliorations :
- #<issue> : Courte description (auteur)

Corrections de bugs :
- #<issue> : Courte description (auteur)

Changements de configuration :
- Fichiers/modifications à appliquer (/config/...)
- Variables d'environnement à ajouter/modifier

Migrations / scripts :
- Script/migration : description
- Commande d'exécution : `php bin/migrate.php up` (adapter selon le projet)
- Rollback : `php bin/migrate.php down --target=...`

Tests et validation
------------------
- Tests unitaires : `composer test` (ou commande projet)
- Tests d'intégration : description et commandes
- Scénarios manuels à vérifier (exemples) :
  - Connexion utilisateur
  - Sauvegarde/restauration si applicable
  - Flux métier critique A -> B

Déploiement
----------
- Environnement cible : staging → production
- Étapes :
  1. Merger release/<version> → main
  2. Tagger : `git tag -a vX.Y.Z -m "Release vX.Y.Z"`
  3. Pousser tags et main : `git push origin main --tags`
  4. Lancer pipeline CI/CD ou déployer manuellement
  5. Vérifier health checks après déploiement
- Rollback :
  - Procédure pour revenir à vX.Y.Z-1 (re-déployer tag précédent)
  - Restaurer base si nécessaire (préciser backups)

Communication
------------
- Avant release : annonce interne (channel Slack / email)
- Après release : publier notes de version sur README / Releases GitHub
- Modèle de message public :
  - Objet : Nouvelle version vX.Y.Z de Archi_conv1_v1 — Principales évolutions
  - Corps : résumé + lien vers changelog + instructions de mise à jour

Templates GitHub utiles
---------------------
- PR template (extrait)
  - Titre : [type] Courte description
  - Description : Contexte, solution, tests effectués, issues liées
  - Checklist : tests unitaires ✅, revue ✅, doc mise à jour ✅

- Issue template : Bug / Feature / Task avec sections Reproduire, Comportement attendu, Solution proposée

Exemples de notes de version
---------------------------
Version 1.2.0 — 2026-06-30
Résumé :
- Ajout d'un module de pré-traitement des données.

Nouvelles fonctionnalités :
- #45 : Module de normalisation d'images (eliendombe)

Améliorations :
- #50 : Optimisation de la pipeline d'entraînement

Corrections de bugs :
- #52 : Correction du calcul des métriques sur petits jeux de données

Changements de configuration :
- Ajouter la variable ENV NORMALIZE=true pour activer la normalisation

Migrations / scripts :
- Aucun

Bonnes pratiques
---------------
- Documenter chaque changement majeur dans le changelog.
- Lier systématiquement les issues aux PRs et à la release.
- Faire un déploiement sur staging pour validation par QA.
- Préparer et tester le rollback avant toute release majeure.

Checklist rapide pour l’équipe avant déploiement (raccourci)
-----------------------------------------------------------
- [ ] CI verte
- [ ] Revue effectuée
- [ ] Changelog à jour
- [ ] Backup base (si applicable)
- [ ] Validation sur staging
- [ ] Plan de rollback documenté

Outils recommandés
------------------
- CI : GitHub Actions (ou autre)
- Gestion de versions : tags Git + releases GitHub
- Changelog automatique : Conventional Commits + semantic-release (optionnel)
- Documentation : README + docs/ + GitHub Releases

Contact / Responsabilités
------------------------
- Release manager : nom/personne responsable
- QA : personne(s)
- Devops / Déploiement : personne(s)

Annexes (exemples de commandes)
-------------------------------
- Lancer les tests : `composer test` (adapter)
- Tag et push : `git tag -a vX.Y.Z -m "Release vX.Y.Z" && git push origin main --tags`
