# TP Noté / Thème : Musique
# Commandes utiles
Lancer les services Docker
```
 docker compose -f compose.yaml up -d
```
Installer les dépendances php
```
composer install
```
Installer les dépendances JS et builder les assets (avec TailwindCSS)
```
npm install
npm run dev
```
Lancer le serveur
```
symfony server:start
```
Consulter Mailhog
```
http://localhost:8481
```
Charger les fixtures
```
php bin/console doctrine:fixtures:load
```

PS: Vous pouvez modifié le délai d'expiration du lien de réinitialisation de mot de passe dans
```
config/packages/reset_password.yaml
```
