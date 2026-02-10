# DragonMorphs Deployment Checklist

## Files to Transfer

### ✅ Essential Files
- [ ] All application code (Laravel files)
- [ ] `database/database.sqlite` - Your entire database
- [ ] `storage/app/public/dragons/` - All uploaded dragon images
- [ ] `public/images/` - Static images (hero banner, dragon slides, etc.)
- [ ] `.env` file (configure for production)

### ⚠️ Critical: Image Storage
The database only stores IMAGE PATHS, not the images themselves.
You MUST transfer the `storage/app/public/dragons/` directory or uploaded images will be missing!

---

## Deployment Steps

### 1. Prepare Production Environment
```bash
# On your web server
composer install --optimize-autoloader --no-dev
npm install && npm run build
```

### 2. Environment Configuration
Edit `.env` for production:
```env
APP_ENV=production
APP_DEBUG=false  # CRITICAL!
APP_URL=https://yourdomain.com

# Database stays as SQLite
DB_CONNECTION=sqlite

# Sessions/cache/queue
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 3. Transfer Files
**Option A: Git (Recommended)**
```bash
git push origin main
# Then on server:
git pull origin main
```

**Option B: FTP/SFTP**
Upload entire project directory except:
- `node_modules/` (reinstall on server)
- `vendor/` (reinstall on server)

### 4. Transfer Database & Images
**Via FTP/SFTP:**
```
Local → Server
database/database.sqlite → database/database.sqlite
storage/app/public/dragons/ → storage/app/public/dragons/
```

**Via SCP (SSH):**
```bash
scp database/database.sqlite user@server:/path/to/app/database/
scp -r storage/app/public/dragons/ user@server:/path/to/app/storage/app/public/
```

### 5. Server Setup
```bash
# SSH into server
cd /path/to/app

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Create storage symlink
php artisan storage:link

# Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 6. Web Server Configuration

**Nginx Example:**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/dragonmorphs/public;  # Point to /public

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Apache Example (.htaccess already included)**
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/dragonmorphs/public

    <Directory /var/www/dragonmorphs/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 7. SSL Certificate
```bash
sudo certbot --nginx -d yourdomain.com
# or for Apache:
sudo certbot --apache -d yourdomain.com
```

### 8. Create Admin Account
```bash
php artisan tinker
```
```php
$user = new \App\Models\User();
$user->name = 'Your Name';
$user->email = 'your@email.com';
$user->password = bcrypt('your-secure-password');
$user->save();
```

### 9. Disable Public Registration
Edit `routes/web.php` - comment out:
```php
// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);
```

---

## Verification Checklist

After deployment, test:
- [ ] Homepage loads (http://yourdomain.com)
- [ ] Static images show (hero banner, slides)
- [ ] Can login at /login
- [ ] Admin panel accessible at /admin/dragons
- [ ] Uploaded dragon images display correctly
- [ ] Can upload new images via admin
- [ ] Morphs page shows dragons
- [ ] Breeding stock page works
- [ ] Modals open with images
- [ ] Parent genetics tooltips work
- [ ] No console errors in browser

---

## Important Notes

### 🔴 Database Backups
SQLite is a single file - back it up regularly:
```bash
# Backup command
cp database/database.sqlite database/backups/database-$(date +%Y%m%d).sqlite

# Automated daily backup (crontab)
0 2 * * * cp /path/to/app/database/database.sqlite /path/to/backups/database-$(date +\%Y\%m\%d).sqlite
```

### 🔴 Image Backups
Also backup uploaded images:
```bash
tar -czf dragon-images-$(date +%Y%m%d).tar.gz storage/app/public/dragons/
```

### 🔴 File Permissions
If images don't upload or display:
```bash
chmod -R 775 storage
chown -R www-data:www-data storage
```

### 🔴 Storage Link
If images show broken after deployment:
```bash
php artisan storage:link
# Verify: public/storage should point to ../storage/app/public
```

---

## Quick Sync Script (Local → Server)

Save this as `deploy.sh`:
```bash
#!/bin/bash

SERVER="user@yourserver.com"
REMOTE_PATH="/var/www/dragonmorphs"

# Transfer files
rsync -avz --exclude 'node_modules' --exclude 'vendor' ./ $SERVER:$REMOTE_PATH/

# Transfer database
scp database/database.sqlite $SERVER:$REMOTE_PATH/database/

# Transfer uploaded images
rsync -avz storage/app/public/dragons/ $SERVER:$REMOTE_PATH/storage/app/public/dragons/

# Run server commands
ssh $SERVER "cd $REMOTE_PATH && composer install --no-dev && php artisan optimize"

echo "Deployment complete!"
```

Run with: `bash deploy.sh`

---

## Troubleshooting

**Images not showing?**
- Check `public/storage` symlink exists
- Verify file permissions (775 on storage/)
- Check `.env` has `APP_URL` set correctly

**Database errors?**
- Verify `database/database.sqlite` exists
- Check file permissions (664 recommended)
- Ensure `DB_CONNECTION=sqlite` in `.env`

**500 errors?**
- Check `storage/logs/laravel.log`
- Verify `APP_DEBUG=false` in production
- Run `php artisan config:clear`

**Uploads failing?**
- Check `storage/app/public/` is writable
- Verify `php.ini` has `upload_max_filesize=10M`
- Check `post_max_size=10M` in `php.ini`
