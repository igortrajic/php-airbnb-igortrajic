# Fonctionnalités

Voici les principales fonctionnalités implémentées dans l'application :

## 1. Gestion de l'Authentification
- Inscription de nouveaux utilisateurs.
- Connexion sécurisée avec "Se souvenir de moi".
- Déconnexion.
- Protection des routes sensibles par middleware `auth`.

## 2. Exploration des Appartements
- **Liste des appartements** : Affichage de toutes les annonces disponibles sous forme de cartes.
- **Recherche par localisation** : Filtrer les appartements par ville.
- **Tri** : Trier les résultats par prix (croissant/décroissant) ou par capacité d'accueil.
- **Filtrage avancé** :
    - "Tous" : Voir toutes les annonces.
    - "Mes appartements" : Voir uniquement les annonces créées par l'utilisateur connecté.
    - "Mes réservations" : Voir les appartements que l'utilisateur a réservés.

## 3. Détails d'un Appartement
- Consultation de la fiche complète.
- Galerie d'images.
- Informations détaillées (prix, surface, hôte, etc.).

## 4. Publication d'Annonces
- Formulaire de création d'annonce réservé aux utilisateurs connectés.
- **Upload multiple d'images** : Possibilité d'ajouter plusieurs photos lors de la création.
- Validation rigoureuse des données via Form Requests.
- Gestion robuste des erreurs (nettoyage des images en cas d'échec de transaction DB).
