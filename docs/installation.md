# Installation

Suivez ces étapes pour installer et lancer le projet localement.

## Prérequis

- PHP >= 8.3
- Composer
- Node.js & NPM
- SQLite (ou un autre moteur de base de données compatible)

## Étapes d'installation

1. **Cloner le dépôt :**
   ```bash
   git clone <url-du-depot>
   cd php-airbnb-igortrajic
   ```

2. **Installer les dépendances PHP :**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript :**
   ```bash
   npm install
   ```

4. **Configurer l'environnement :**
   Copiez le fichier `.env.example` vers `.env` et générez la clé d'application.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Préparer la base de données :**
   Si vous utilisez SQLite, créez le fichier de base de données :
   ```bash
   touch database/database.sqlite
   ```
   Ensuite, lancez les migrations et les seeders :
   ```bash
   php artisan migrate --seed
   ```

6. **Compiler les assets :**
   ```bash
   npm run dev
   ```

7. **Lancer le serveur de développement :**
   ```bash
   php artisan serve
   ```

L'application sera accessible sur `http://localhost:8000`.
