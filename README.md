# 🚗 CarLuxe - Agence de Location de Voitures

Un site web complet pour une agence de location de voitures développé avec Laravel 12 et Tailwind CSS. Le projet inclut une interface publique pour les clients et un espace d'administration sécurisé pour gérer la flotte et les réservations.

## Fonctionnalités

### Front-end (Site Web Public)

- ✅ **Page d'accueil moderne** avec design premium et responsive
- ✅ **Catalogue de voitures** avec filtres avancés (marque, modèle, transmission, carburant, places, budget)
- ✅ **Recherche en temps réel** dans la flotte disponible
- ✅ **Réservation en ligne** avec calcul automatique du prix total selon la durée
- ✅ **Mise en avant** des véhicules "Featured" (recommandés)
- ✅ **Interface responsive** optimisée mobile et desktop

### Back-office (Administration)

- ✅ **Authentification sécurisée** avec accès restreint aux administrateurs
- ✅ **Dashboard** avec vue d'ensemble et statistiques
- ✅ **Gestion complète de la flotte** (CRUD) : ajouter, modifier, supprimer des voitures
- ✅ **Gestion des réservations** : suivi des demandes et mise à jour des statuts
- ✅ **Statuts de réservation** : En attente, Confirmé, Annulé, Terminé

## Structure de la base de données

- **users** : Utilisateurs du système (avec colonne `is_admin` pour les administrateurs)
- **cars** : Voitures avec informations détaillées (marque, modèle, année, transmission, carburant, prix, images, disponibilité)
- **reservations** : Réservations avec informations client, dates, prix total et statut

## Installation

### Prérequis

- PHP >= 8.2
- Composer
- MySQL ou SQLite
- Node.js et npm (pour les assets frontend)

### Étapes d'installation

1. **Cloner le projet et installer les dépendances**

```bash
composer install
npm install
```

2. **Configurer l'environnement**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Configurer la base de données dans `.env`**

Pour MySQL :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=carluxe
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

Pour SQLite (plus simple pour le développement) :
```env
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/vers/database/database.sqlite
```

4. **Créer la base de données MySQL (si vous utilisez MySQL)**

```sql
CREATE DATABASE carluxe;
```

5. **Exécuter les migrations et seeders**

```bash
php artisan migrate --seed
```

Cette commande va créer les tables et générer des données de test, incluant un compte administrateur.

6. **Lancer le serveur de développement**

Vous aurez besoin de deux terminaux :

**Terminal 1** - Compilation des assets (Vite) :
```bash
npm run dev
```

**Terminal 2** - Serveur Laravel :
```bash
php artisan serve
```

Le site sera accessible sur `http://localhost:8000`

## Accès Administrateur

Un compte administrateur est créé automatiquement lors du seeding :

- **URL de connexion** : `/login`
- **Email** : `admin@carluxe.tn`
- **Mot de passe** : `password`

Une fois connecté, vous pouvez accéder au dashboard admin via `/admin` ou en cliquant sur "Admin" dans le menu.

## API REST

Le projet est structuré pour supporter facilement une API REST. Les contrôleurs API sont déjà créés dans `app/Http/Controllers/Api/` et peuvent être activés en ajoutant les routes dans `routes/api.php`.

### Structure API prévue

Les endpoints suivants peuvent être implémentés :

#### Authentification
- `POST /api/login` - Authentification (email, password)
- `POST /api/logout` - Déconnexion

#### Voitures
- `GET /api/cars` - Liste toutes les voitures (avec filtres optionnels)
- `GET /api/cars/{id}` - Détails d'une voiture
- `POST /api/cars` - Créer une voiture (admin uniquement)
- `PUT /api/cars/{id}` - Mettre à jour une voiture (admin uniquement)
- `DELETE /api/cars/{id}` - Supprimer une voiture (admin uniquement)

#### Réservations
- `GET /api/reservations` - Liste toutes les réservations (admin uniquement)
- `GET /api/reservations/{id}` - Détails d'une réservation
- `POST /api/reservations` - Créer une réservation
- `PATCH /api/reservations/{id}/status` - Mettre à jour le statut d'une réservation (admin uniquement)

### Exemple de requête API (à implémenter)

**Créer une réservation :**

```bash
POST /api/reservations
Content-Type: application/json

{
    "car_id": 1,
    "first_name": "Louay",
    "last_name": "Chaouachi",
    "email": "louaychaouachi347@gmail.com",
    "phone": "+216 71 000 000",
    "pickup_location": "Aéroport Tunis-Carthage",
    "start_date": "2025-12-25",
    "end_date": "2025-12-30",
    "notes": "Besoin d'un GPS"
}
```

**Mettre à jour le statut d'une réservation :**

```bash
PATCH /api/reservations/1/status
Content-Type: application/json

{
    "status": "confirmed"
}
```

## Routes Web

### Public
- `/` - Page d'accueil (catalogue de voitures avec filtres)
- `POST /reservations` - Créer une réservation

### Authentification
- `/login` - Page de connexion
- `POST /login` - Traitement de la connexion
- `POST /logout` - Déconnexion

### Administration (protégé)
- `/admin` - Dashboard administrateur
- `/admin/cars` - Liste des voitures
- `/admin/cars/create` - Créer une voiture
- `/admin/cars/{id}/edit` - Modifier une voiture
- `DELETE /admin/cars/{id}` - Supprimer une voiture
- `/admin/reservations` - Liste des réservations
- `PATCH /admin/reservations/{id}` - Mettre à jour le statut d'une réservation

## Technologies utilisées

- **Laravel 12** - Framework PHP moderne
- **Tailwind CSS v4** - Framework CSS utilitaire
- **Vite** - Build tool pour les assets
- **MySQL/SQLite** - Base de données
- **Pest PHP** - Framework de tests

## Tests

Le projet inclut des tests automatisés pour valider les fonctionnalités principales :

```bash
php artisan test
```

Tests spécifiques :
```bash
php artisan test --filter=AdminCarCrudTest
php artisan test --filter=AdminReservationStatusTest
php artisan test --filter=ReservationTest
```

## Structure du projet

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/          # Contrôleurs API (à implémenter)
│   │   ├── AdminCarController.php
│   │   ├── AdminReservationController.php
│   │   ├── AuthController.php
│   │   ├── CarController.php
│   │   └── ReservationController.php
│   └── Requests/         # Form Requests pour la validation
├── Models/
│   ├── Car.php
│   ├── Reservation.php
│   └── User.php
database/
├── factories/            # Factories pour les données de test
├── migrations/           # Migrations de la base de données
└── seeders/              # Seeders pour les données initiales
resources/
└── views/
    ├── admin/            # Vues de l'interface admin
    ├── auth/             # Vues d'authentification
    └── welcome.blade.php # Page d'accueil
```

## Sécurité

- Authentification Laravel avec protection CSRF
- Gate `access-admin` pour restreindre l'accès admin
- Validation des données avec Form Requests
- Protection contre les injections SQL via Eloquent ORM
