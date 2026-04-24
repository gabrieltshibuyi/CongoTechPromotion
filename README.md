# Congo Tech Promotion

Site vitrine en PHP natif avec une architecture MVC légère, sans base de données, en français et en anglais.

## Pages disponibles

- `/` ou `/accueil` : accueil institutionnel
- `/about` ou `/qui-sommes-nous` : page de présentation
- `/contact` : page contact dédiée
- `?lang=en` : bascule en anglais sur chaque page

## Structure

- `public/index.php` : point d'entrée web et front controller
- `public/.htaccess` : réécriture Apache vers le front controller
- `app/Core` : classes de base et helpers MVC
- `app/Controllers/SiteController.php` : contrôleur principal du site
- `app/Support/ContactMailer.php` : envoi d’email et journalisation du formulaire contact
- `app/Support/SiteContent.php` : contenus bilingues centralisés
- `app/Views` : layouts et vues de pages
- `routes/web.php` : définition des routes HTTP
- `public/assets/css/style.css` : identité visuelle, responsive et animations
- `public/assets/js/main.js` : navigation mobile et reveal animations
- `public/assets/media` : logo et galerie média optimisée en SVG
- `deploy/apache-vhost-example.conf` : exemple de VirtualHost WAMP/Apache

## Lancer le site

### Avec WAMP

Placez le projet dans le répertoire web puis configurez Apache pour pointer vers le dossier `public` comme racine web.

Exemple : utilisez le fichier `deploy/apache-vhost-example.conf` et adaptez le `ServerName` si nécessaire.

Si vous servez temporairement le projet depuis la racine `CongoTechPromotion`, le dépôt inclut aussi un `index.php` et un `.htaccess` racine pour exposer des URLs propres sans `/public`.

### Déployer sans dossier `CongoTechPromotion`

Si votre serveur doit exposer le site directement à la racine du domaine, copiez le contenu du projet dans la racine web du serveur, sans garder le dossier parent `CongoTechPromotion` dans l’URL.

Dans ce mode :

- les pages publiques restent accessibles via `/`, `/accueil`, `/qui-sommes-nous` et `/contact`
- les assets publics sont servis via `/assets/...`
- le fichier `.htaccess` racine redirige ces assets vers `public/assets/...`

Si votre hébergeur permet de définir la racine web sur le dossier `public`, c’est encore mieux : gardez alors toute l’arborescence du projet intacte côté serveur et pointez simplement le vhost ou le document root sur `public`.

### Déploiement GitHub vers hébergement mutualisé

Si le domaine est servi depuis `/public_html/congotechpromotion.cd`, placez le projet directement dans ce dossier.

Workflow recommandé :

1. initialiser le dépôt local puis lier le remote GitHub
2. pousser les changements sur GitHub depuis votre machine locale
3. se connecter en SSH au serveur mutualisé
4. cloner le dépôt dans `/public_html/congotechpromotion.cd` la première fois, puis faire `git pull` pour les mises à jour

Exemple côté local :

```powershell
git add .
git commit -m "Mise a jour du site"
git remote add origin https://github.com/VOTRE-USER/VOTRE-REPO.git
git push -u origin main
```

Exemple côté serveur la premiere fois :

```bash
cd ~/public_html
git clone https://github.com/VOTRE-USER/VOTRE-REPO.git congotechpromotion.cd
cd congotechpromotion.cd
```

Exemple côté serveur pour les mises a jour :

```bash
cd ~/public_html/congotechpromotion.cd
git pull origin main
```

Points d'attention sur un mutualisé :

- `git` et `ssh` doivent être disponibles sur l'hébergement
- le dossier `.git` doit être autorisé sur le serveur
- `AllowOverride` ou l'équivalent Apache doit laisser fonctionner le `.htaccess` racine
- si le dépôt est privé, utilisez une cle SSH ou un token GitHub

#### Cas 1 : le repo GitHub n'existe pas encore

1. créez un nouveau dépôt vide sur GitHub
2. ne cochez pas `README`, `.gitignore` ou licence sur GitHub pour éviter un historique initial différent
3. copiez l'URL du dépôt, par exemple `https://github.com/VOTRE-USER/VOTRE-REPO.git`

Puis, en local :

```powershell
cd C:\wamp64\www\CongoTechPromotion
git add .
git commit -m "Initial site setup and deployment fixes"
git remote add origin https://github.com/VOTRE-USER/VOTRE-REPO.git
git push -u origin main
```

#### Cas 2 : vous avez deja l'URL GitHub

Si aucun remote n'est encore configure :

```powershell
cd C:\wamp64\www\CongoTechPromotion
git add .
git commit -m "Initial site setup and deployment fixes"
git remote add origin https://github.com/VOTRE-USER/VOTRE-REPO.git
git push -u origin main
```

Si le remote `origin` existe deja mais pointe vers une mauvaise URL :

```powershell
cd C:\wamp64\www\CongoTechPromotion
git remote set-url origin https://github.com/VOTRE-USER/VOTRE-REPO.git
git add .
git commit -m "Initial site setup and deployment fixes"
git push -u origin main
```

#### Cas 3 : le dossier serveur contient deja des fichiers

Pour eviter d'ecraser l'existant, ne faites pas `git clone ... .` directement dans le dossier de production tant qu'une sauvegarde n'est pas faite.

Approche sure sur le serveur :

```bash
cd ~/public_html
mv congotechpromotion.cd congotechpromotion.cd_backup_$(date +%Y%m%d_%H%M%S)
mkdir congotechpromotion.cd
cd congotechpromotion.cd
git clone https://github.com/VOTRE-USER/VOTRE-REPO.git .
```

Si vous ne pouvez pas renommer le dossier car le domaine pointe deja dessus, clonez d'abord ailleurs :

```bash
cd ~/public_html
git clone https://github.com/VOTRE-USER/VOTRE-REPO.git congotechpromotion.cd_new
```

Ensuite :

1. comparez `congotechpromotion.cd` et `congotechpromotion.cd_new`
2. sauvegardez les fichiers a conserver depuis l'ancien dossier
3. remplacez seulement apres verification

Pour les mises a jour suivantes :

```bash
cd ~/public_html/congotechpromotion.cd
git pull origin main
```

Si le serveur contient deja un site manuel important et que vous voulez une transition sans risque, le plus propre est :

1. cloner dans `congotechpromotion.cd_new`
2. tester le site sur un sous-domaine ou un chemin temporaire
3. basculer le document root ou renommer les dossiers une fois valide

### Avec le serveur PHP intégré

```powershell
php -S 127.0.0.1:8000 -t public
```

Ensuite, ouvrez http://127.0.0.1:8000

## Personnalisation rapide

Les coordonnées affichées sur la page contact sont configurables dans `app/config.php` :

- `contact_email`
- `contact_phone`
- `contact_location`
- `mail_from_email`
- `mail_from_name`
- `mail_subject_prefix`

## Fonctionnement

- Le contenu est statique et piloté côté PHP
- La langue active est déterminée par le paramètre `lang`
- Le site inclut une galerie institutionnelle, une section partenaires et des animations d'apparition
- Le formulaire de contact envoie un email via `mail()` et écrit une trace dans `storage/logs/contact-mail.log`
- Pour WAMP, configurez SMTP dans `php.ini` ou `sendmail.ini` pour permettre l’envoi réel des emails
