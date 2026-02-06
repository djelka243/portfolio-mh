# Docker Configuration Guide for MH Beauty

## Prérequis

- Docker (version 20.10+)
- Docker Compose (version 1.29+)

## Structure Docker

Ce projet inclut les services suivants :

- **app** : Application Laravel (PHP 8.2-FPM + Nginx)
- **mysql** : Base de données MySQL 8.0
- **redis** : Cache et file d'attente Redis
- **phpmyadmin** : Interface de gestion MySQL (port 8080)

## Installation et Démarrage

### 1. Cloner et configurer le projet

```bash
# Cloner le projet
git clone <repository-url> mhbeauty
cd mhbeauty

# Copier la configuration Docker
cp .env.docker .env

# Générer la clé APP_KEY
docker-compose up -d
docker-compose exec app php artisan key:generate
```

### 2. Démarrer les containers

```bash
# Construire et démarrer tous les services
docker-compose up -d

# Vérifier l'état des services
docker-compose ps
```

### 3. Initialiser la base de données

```bash
# Exécuter les migrations
docker-compose exec app php artisan migrate

# (Optionnel) Remplir les données de test
docker-compose exec app php artisan db:seed
```

### 4. Installer les dépendances du frontend

```bash
# Les dépendances Node sont déjà installées dans l'image
# Mais vous pouvez réinstaller si nécessaire
docker-compose exec app npm install
docker-compose exec app npm run build
```

## Accès à l'Application

- **Application** : http://localhost
- **PhpMyAdmin** : http://localhost:8080
- **Logs** : `docker-compose logs -f app`

## Commandes Utiles

### Gestion des containers

```bash
# Arrêter les services
docker-compose down

# Arrêter et supprimer les volumes
docker-compose down -v

# Redémarrer les services
docker-compose restart

# Voir les logs
docker-compose logs -f app
```

### Commandes Laravel

```bash
# Exécuter un artisan command
docker-compose exec app php artisan <command>

# Exemples :
docker-compose exec app php artisan tinker
docker-compose exec app php artisan queue:work
docker-compose exec app php artisan migrate:fresh --seed
```

### Commandes Node/NPM

```bash
# Compiler les assets
docker-compose exec app npm run build

# Mode développement (avec watch)
docker-compose exec app npm run dev

# Installer un package
docker-compose exec app npm install <package-name>
```

### Accès à la base de données

```bash
# Accès MySQL via CLI
docker-compose exec mysql mysql -u mhbeauty -p mhbeauty

# Via PhpMyAdmin : http://localhost:8080
# Utilisateur : mhbeauty
# Mot de passe : secret
```

## Configuration de Production

Pour le déploiement en production, modifiez les variables d'environnement :

```env
APP_ENV=production
APP_DEBUG=false
DB_PASSWORD=<password-fort>
DB_ROOT_PASSWORD=<password-fort>
MAIL_MAILER=<your-mail-service>
MAIL_HOST=<your-mail-host>
MAIL_PORT=<your-mail-port>
```

## Volumes Persistants

- `mysql-data` : Données persistantes MySQL
- `./storage` : Fichiers de l'application (logs, cache, uploads)

## Performance et Optimisation

La configuration inclut:

- Compression Gzip pour les assets
- Cache HTTP 1 an pour les assets statiques
- OPCache PHP activé
- Rate limiting Nginx configuré
- File limits et memory pour production

## Troubleshooting

### Les containers ne démarrent pas

```bash
# Vérifiez les logs
docker-compose logs

# Reconstruisez l'image
docker-compose build --no-cache
docker-compose up -d
```

### Permission denied errors

```bash
# Réinitialiser les permissions
docker-compose exec app chown -R www-data:www-data /var/www/storage
docker-compose exec app chown -R www-data:www-data /var/www/bootstrap/cache
```

### Database connection refused

```bash
# Attendez que MySQL soit prêt
docker-compose exec app php artisan migrate
```

### Static files not loading

```bash
# Récompiler les assets
docker-compose exec app npm run build
```

## Fichiers importants

- `Dockerfile` : Configuration de l'image Docker
- `docker-compose.yml` : Orchestration des services
- `docker/php/php.ini` : Configuration PHP
- `docker/nginx/nginx.conf` : Configuration Nginx
- `docker/supervisor/supervisord.conf` : Gestion des processus
- `.dockerignore` : Fichiers à exclure du build

## Support

Pour plus d'informations, consultez la documentation officielle :
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Docker Guide](https://laravel.com/docs/installation)
