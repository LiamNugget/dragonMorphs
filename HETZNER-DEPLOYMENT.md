# Deploy DragonMorphs to Hetzner Server
## Subdomain: dragonmorphs.hizhub.com

---

## Step 1: DNS Configuration

### Add DNS Record for Subdomain

**Option A: Via Hetzner DNS Console**
1. Log into Hetzner DNS Console
2. Select your domain `hizhub.com`
3. Add new record:
   - **Type**: A
   - **Name**: dragonmorphs
   - **Value**: Your server IP address
   - **TTL**: 3600 (or default)

**Option B: Via DNS Provider (if using external DNS)**
Add an A record:
```
dragonmorphs.hizhub.com  →  YOUR_SERVER_IP
```

**Verify DNS propagation** (wait 5-10 minutes):
```bash
# On your local machine
ping dragonmorphs.hizhub.com
# Should return your server IP
```

---

## Step 2: Connect to Your Hetzner Server

```bash
ssh root@YOUR_SERVER_IP
# or
ssh your-username@YOUR_SERVER_IP
```

---

## Step 3: Create Project Directory

```bash
# Create directory for the new subdomain
sudo mkdir -p /var/www/dragonmorphs
sudo chown -R www-data:www-data /var/www/dragonmorphs
sudo chmod -R 755 /var/www/dragonmorphs
```

---

## Step 4: Upload Your Project

### Option A: Via Git (Recommended)

**On your local machine:**
```bash
cd C:\Users\liamn.DESKTOP-263BGT9\Desktop\Projects\DragonMorphs

# Initialize git if not already done
git init
git add .
git commit -m "Initial DragonMorphs commit"

# Push to GitHub/GitLab
git remote add origin https://github.com/yourusername/dragonmorphs.git
git push -u origin main
```

**On Hetzner server:**
```bash
cd /var/www/dragonmorphs
sudo git clone https://github.com/yourusername/dragonmorphs.git .
```

### Option B: Via SFTP/SCP

**Using WinSCP or FileZilla:**
- Host: YOUR_SERVER_IP
- Protocol: SFTP
- Upload entire DragonMorphs folder to `/var/www/dragonmorphs`

**Using SCP from command line:**
```bash
# From your local machine
cd C:\Users\liamn.DESKTOP-263BGT9\Desktop\Projects\
scp -r DragonMorphs/* root@YOUR_SERVER_IP:/var/www/dragonmorphs/
```

---

## Step 5: Transfer Database & Images

**These files are NOT in git (typically), so transfer manually:**

```bash
# From your local machine

# Transfer database
scp database/database.sqlite root@YOUR_SERVER_IP:/var/www/dragonmorphs/database/

# Transfer uploaded images (if any exist)
scp -r storage/app/public/dragons root@YOUR_SERVER_IP:/var/www/dragonmorphs/storage/app/public/

# Transfer static images
scp -r public/images root@YOUR_SERVER_IP:/var/www/dragonmorphs/public/
```

---

## Step 6: Server Setup & Dependencies

**SSH into server:**
```bash
ssh root@YOUR_SERVER_IP
cd /var/www/dragonmorphs
```

**Install PHP dependencies:**
```bash
composer install --optimize-autoloader --no-dev
```

**Install Node dependencies & build assets:**
```bash
npm install
npm run build
```

**Create .env file:**
```bash
cp .env.example .env
nano .env
```

**Edit .env for production:**
```env
APP_NAME=DragonMorphs
APP_ENV=production
APP_KEY=  # Will generate in next step
APP_DEBUG=false  # CRITICAL: Set to false!
APP_URL=https://dragonmorphs.hizhub.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=sqlite

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail settings (optional)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@hizhub.com"
MAIL_FROM_NAME="DragonMorphs"
```

**Generate app key:**
```bash
php artisan key:generate
```

**Create storage symlink:**
```bash
php artisan storage:link
```

**Set proper permissions:**
```bash
sudo chown -R www-data:www-data /var/www/dragonmorphs
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 664 database/database.sqlite
```

**Optimize for production:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Step 7: Configure Web Server

### For Nginx (Most Common)

**Create Nginx config:**
```bash
sudo nano /etc/nginx/sites-available/dragonmorphs.hizhub.com
```

**Add this configuration:**
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name dragonmorphs.hizhub.com;
    root /var/www/dragonmorphs/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html;

    charset utf-8;

    # Laravel routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Don't log favicon/robots
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    # 404 handling
    error_page 404 /index.php;

    # PHP handling
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;  # Adjust PHP version if needed
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # Deny access to hidden files
    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Security headers
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "no-referrer-when-downgrade";
}
```

**Enable the site:**
```bash
sudo ln -s /etc/nginx/sites-available/dragonmorphs.hizhub.com /etc/nginx/sites-enabled/
```

**Test Nginx configuration:**
```bash
sudo nginx -t
```

**Reload Nginx:**
```bash
sudo systemctl reload nginx
```

### For Apache (Alternative)

**Create Apache config:**
```bash
sudo nano /etc/apache2/sites-available/dragonmorphs.hizhub.com.conf
```

**Add this configuration:**
```apache
<VirtualHost *:80>
    ServerName dragonmorphs.hizhub.com
    ServerAdmin liamnugent@hizhub.com
    DocumentRoot /var/www/dragonmorphs/public

    <Directory /var/www/dragonmorphs/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/dragonmorphs-error.log
    CustomLog ${APACHE_LOG_DIR}/dragonmorphs-access.log combined
</VirtualHost>
```

**Enable the site:**
```bash
sudo a2ensite dragonmorphs.hizhub.com.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

---

## Step 8: SSL Certificate (HTTPS)

**Install Certbot if not already installed:**
```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx  # For Nginx
# OR
sudo apt install certbot python3-certbot-apache  # For Apache
```

**Get SSL certificate:**
```bash
# For Nginx
sudo certbot --nginx -d dragonmorphs.hizhub.com

# For Apache
sudo certbot --apache -d dragonmorphs.hizhub.com
```

**Follow prompts:**
1. Enter email address
2. Agree to terms
3. Choose whether to redirect HTTP to HTTPS (recommended: Yes)

**Auto-renewal is configured automatically. Test it:**
```bash
sudo certbot renew --dry-run
```

---

## Step 9: Create Admin Account

```bash
cd /var/www/dragonmorphs
php artisan tinker
```

**In tinker console:**
```php
$user = new \App\Models\User();
$user->name = 'Your Name';
$user->email = 'liamnugent@hizhub.com';
$user->password = bcrypt('your-secure-password');
$user->save();
exit
```

---

## Step 10: Disable Public Registration

**Edit routes:**
```bash
nano /var/www/dragonmorphs/routes/web.php
```

**Comment out registration routes:**
```php
// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);
```

**Clear cache:**
```bash
php artisan route:cache
```

---

## Step 11: Test Your Site

Visit: `https://dragonmorphs.hizhub.com`

**Checklist:**
- [ ] Homepage loads
- [ ] Hero banner shows
- [ ] Slider images work (all 4 slides)
- [ ] Can access `/login`
- [ ] Can login with admin account
- [ ] Admin panel works at `/admin/dragons`
- [ ] Can upload dragon images
- [ ] HTTPS works (green padlock)
- [ ] No console errors in browser dev tools

---

## Maintenance & Updates

### Deploy Updates

**After making changes locally:**
```bash
# On local machine
git add .
git commit -m "Update description"
git push

# On server
cd /var/www/dragonmorphs
sudo git pull
composer install --no-dev
npm run build
php artisan migrate --force  # If database changes
php artisan optimize
sudo systemctl reload nginx  # or apache2
```

### Backup Script

**Create backup script:**
```bash
sudo nano /usr/local/bin/backup-dragonmorphs.sh
```

**Add:**
```bash
#!/bin/bash
BACKUP_DIR="/var/backups/dragonmorphs"
DATE=$(date +%Y%m%d-%H%M%S)

mkdir -p $BACKUP_DIR

# Backup database
cp /var/www/dragonmorphs/database/database.sqlite $BACKUP_DIR/database-$DATE.sqlite

# Backup uploaded images
tar -czf $BACKUP_DIR/images-$DATE.tar.gz -C /var/www/dragonmorphs/storage/app/public dragons

# Keep only last 7 days
find $BACKUP_DIR -type f -mtime +7 -delete

echo "Backup completed: $DATE"
```

**Make executable:**
```bash
sudo chmod +x /usr/local/bin/backup-dragonmorphs.sh
```

**Add to crontab (daily at 2 AM):**
```bash
sudo crontab -e
```

**Add line:**
```
0 2 * * * /usr/local/bin/backup-dragonmorphs.sh
```

---

## Troubleshooting

### Images Not Showing
```bash
cd /var/www/dragonmorphs
php artisan storage:link
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage
```

### 500 Error
```bash
# Check logs
sudo tail -f /var/log/nginx/error.log  # Nginx
# or
sudo tail -f /var/log/apache2/error.log  # Apache

# Laravel logs
tail -f /var/www/dragonmorphs/storage/logs/laravel.log

# Clear all caches
cd /var/www/dragonmorphs
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Permission Error
```bash
sudo chmod 664 /var/www/dragonmorphs/database/database.sqlite
sudo chown www-data:www-data /var/www/dragonmorphs/database/database.sqlite
```

### Can't Upload Images
```bash
# Check PHP upload limits
sudo nano /etc/php/8.3/fpm/php.ini  # Adjust version

# Find and set:
upload_max_filesize = 10M
post_max_size = 10M
memory_limit = 256M

# Restart PHP-FPM
sudo systemctl restart php8.3-fpm  # Adjust version
```

### DNS Not Resolving
```bash
# Check DNS
nslookup dragonmorphs.hizhub.com
dig dragonmorphs.hizhub.com

# May take up to 24 hours to propagate globally
```

---

## Security Recommendations

1. **Firewall (UFW):**
```bash
sudo ufw allow 22/tcp   # SSH
sudo ufw allow 80/tcp   # HTTP
sudo ufw allow 443/tcp  # HTTPS
sudo ufw enable
```

2. **Fail2Ban** (prevent brute force):
```bash
sudo apt install fail2ban
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

3. **Regular updates:**
```bash
sudo apt update && sudo apt upgrade -y
```

4. **Monitor logs:**
```bash
# Watch for suspicious activity
sudo tail -f /var/log/auth.log
sudo tail -f /var/log/nginx/access.log
```

---

## Quick Reference Commands

```bash
# View site
https://dragonmorphs.hizhub.com

# SSH to server
ssh root@YOUR_SERVER_IP

# Project directory
cd /var/www/dragonmorphs

# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.3-fpm

# View logs
tail -f storage/logs/laravel.log
sudo tail -f /var/log/nginx/error.log

# Run artisan commands
php artisan optimize
php artisan cache:clear

# Manual backup
/usr/local/bin/backup-dragonmorphs.sh
```

---

## Support

If you encounter issues:
1. Check Laravel logs: `/var/www/dragonmorphs/storage/logs/laravel.log`
2. Check web server logs: `/var/log/nginx/error.log`
3. Verify file permissions: `ls -la /var/www/dragonmorphs`
4. Test PHP: `php -v` and `php artisan about`

Good luck with your deployment! 🚀
