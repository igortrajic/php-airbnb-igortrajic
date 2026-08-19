# Modèles de Données

Le projet s'appuie sur une structure de base de données relationnelle. Voici les principaux modèles :

## Schéma ER

### User (Utilisateur)
Représente les utilisateurs du système (propriétaires ou locataires).
- `name` : Nom complet
- `email` : Adresse email unique
- `password` : Mot de passe haché

### Apartment (Appartement)
Représente les annonces de location.
- `title` : Titre de l'annonce
- `city` : Ville où se situe l'appartement
- `price_night` : Prix par nuit
- `max_guests` : Nombre maximum de voyageurs
- `size` : Surface en m²
- `owner_id` : Référence à l'utilisateur propriétaire

### Image
Gère les photos associées aux appartements.
- `image_url` : Chemin ou URL de l'image
- `apartment_id` : Référence à l'appartement associé

### Booking (Réservation)
Gère les séjours réservés.
- `status` : État de la réservation (ex: pending, confirmed)
- `check_in` : Date d'arrivée
- `check_out` : Date de départ
- `total_price` : Montant total
- `user_id` : Référence à l'utilisateur qui réserve
- `apartment_id` : Référence à l'appartement réservé

## Relations

- **User** hasMany **Apartment** (Un utilisateur peut posséder plusieurs appartements)
- **User** hasMany **Booking** (Un utilisateur peut effectuer plusieurs réservations)
- **Apartment** belongsTo **User** (Un appartement appartient à un propriétaire)
- **Apartment** hasMany **Image** (Un appartement peut avoir plusieurs photos)
- **Apartment** hasMany **Booking** (Un appartement peut avoir plusieurs réservations)
- **Image** belongsTo **Apartment**
- **Booking** belongsTo **User**
- **Booking** belongsTo **Apartment**
