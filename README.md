# DragonMorphs - Bearded Dragon Breeder Website

A professional Laravel-based website for showcasing and selling bearded dragons, built with modern design principles and interactive features.

## 🎨 Features

### Public Pages
- **Home Page**: Hero banner with Splide slider, feature boxes, timeline of achievements, and gallery
- **Available Morphs**: Grid of available dragons for sale with modal popups
- **Breeding Stock**: Showcase of breeding dragons with blue theme
- **Interactive Modals**: 
  - Image slideshows with blurred backgrounds
  - Full dragon details (morph, sex, age, weight, DOB, clutch ID)
  - Parent genetics with hover tooltips showing photos
  - Working prev/next arrows and dot indicators

### Admin Panel
- Full CRUD for dragons (Create, Read, Update, Delete)
- Multi-image upload support
- Set primary image
- Parent assignment (sire/dam)
- Status management (available/reserved/sold/breeding)

### Design Features
- Modern glassmorphism effects
- Responsive grid layouts with centered cards
- Green theme for available dragons
- Blue theme for breeding stock
- Font Awesome icons throughout
- Smooth animations and hover effects
- 4px border radius standardization
- Mobile responsive

## 📁 Project Structure

```
dragon-morphs/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminDragonController.php
│   │   └── PublicDragonController.php
│   └── Models/
│       ├── Dragon.php
│       └── DragonImage.php
├── database/
│   └── migrations/
│       ├── create_dragons_table.php
│       └── create_dragon_images_table.php
├── resources/views/
│   ├── layouts/
│   │   └── public.blade.php
│   ├── admin/
│   │   └── dragons/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── edit.blade.php
│   └── public/
│       ├── home.blade.php
│       ├── morphs.blade.php
│       └── breeding-stock.blade.php
├── public/
│   └── images/
│       ├── DragonMorphsHeroBanner.png
│       ├── dragonSlideOne.jpeg - dragonSlideFour.jpeg
│       ├── dragonOne.jpeg - dragonFour.jpeg
│       └── twoHeadedDragon.png
└── routes/
    └── web.php
```

## 🗄️ Database Schema

### Dragons Table
- `id` - Primary key
- `name` - Dragon name
- `morph` - Morph type (e.g., "Genetic Stripe")
- `sex` - male/female
- `age` - Human-readable age
- `dob` - Date of birth
- `weight` - Weight in grams
- `description` - Detailed description
- `price` - Price in GBP (nullable for breeding stock)
- `status` - available/reserved/sold/breeding
- `clutch_id` - Clutch identifier
- `date_listed` - When added to site
- `parent_male_id` - Foreign key to sire
- `parent_female_id` - Foreign key to dam

### Dragon Images Table
- `id` - Primary key
- `dragon_id` - Foreign key to dragons
- `image_path` - Path to stored image
- `is_primary` - Boolean for main card image
- `order` - Display order in gallery

## 🚀 Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL or SQLite
- Node.js & NPM (for asset compilation)

### Setup Steps

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/dragon-morphs.git
cd dragon-morphs
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database in .env**
```env
DB_CONNECTION=mysql
DB_DATABASE=dragon_morphs
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Create storage symlink**
```bash
php artisan storage:link
```

7. **Copy image assets**
```bash
# Copy all images to public/images/
cp /path/to/images/* public/images/
```

8. **Compile assets (if needed)**
```bash
npm run build
```

9. **Start development server**
```bash
php artisan serve
```

Visit `http://localhost:8000`

## 🔐 Security Setup

### Disable Registration
Since only you should have admin access:

**Option 1: Remove routes (routes/web.php)**
```php
// Comment out or delete these lines:
// Route::post('/register', [RegisteredUserController::class, 'store']);
// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
```

**Option 2: Block in controller**
```php
// In RegisteredUserController.php
public function create()
{
    abort(403, 'Registration is closed');
}
```

### Create Admin Account
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

## 📦 Deployment

### Production Checklist

1. **Environment**
```env
APP_ENV=production
APP_DEBUG=false  # CRITICAL!
APP_URL=https://yourdomain.com
```

2. **Optimize**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

3. **Permissions**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

4. **Web Server**
Point document root to `/public` directory

**Nginx example:**
```nginx
root /var/www/dragon-morphs/public;
index index.php;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

5. **SSL Certificate**
```bash
sudo certbot --nginx -d yourdomain.com
```

## 🎯 Usage

### Admin Panel
1. Login at `/login`
2. Navigate to `/admin/dragons`
3. Add new dragons with the "Create Dragon" button
4. Upload multiple images per dragon
5. Set one image as primary (shows on cards)
6. Assign parent dragons for genetics display
7. Set status (available/reserved/breeding)

### Public Access
- Home: `/`
- Available Dragons: `/morphs`
- Breeding Stock: `/breeding-stock`

## ✨ What's Been Completed

### Design & Styling
- ✅ Modern glassmorphism navbar
- ✅ Hero banner with Splide image slider
- ✅ Green gradient theme for available dragons
- ✅ Blue theme for breeding stock
- ✅ Strategic Font Awesome icon placement
- ✅ Highlight spans for emphasized text
- ✅ 4px border radius standardization (except pill buttons)
- ✅ Real image integration throughout
- ✅ Responsive design (mobile/tablet/desktop)
- ✅ Card hover effects with subtle lift
- ✅ Timeline design with chronological achievements

### Features
- ✅ Full admin CRUD panel
- ✅ Multi-image upload system
- ✅ Primary image selection
- ✅ Modal popups for dragon details
- ✅ Image slideshow with blurred backgrounds
- ✅ Working prev/next arrows and dot indicators
- ✅ Parent genetics display with hover tooltips
- ✅ Parent tooltips show images + details
- ✅ 3-column info grid in modals
- ✅ Centered card layout for even numbers
- ✅ Breeding stock badge overlay
- ✅ Status badges (available/reserved/breeding)

### Database & Backend
- ✅ Dragons table with full schema
- ✅ Dragon images table with ordering
- ✅ Parent relationships (sire/dam)
- ✅ Image storage and retrieval
- ✅ Primary image logic
- ✅ Status filtering

## 🚧 TODO Before Launch

### Critical
- [ ] **Disable user registration** (keep only your admin account)
- [ ] Set `APP_DEBUG=false` in production
- [ ] Generate production `APP_KEY`
- [ ] Configure production database
- [ ] Set up SSL certificate
- [ ] Point web server to `/public` directory
- [ ] Set proper file permissions (775 storage, www-data owner)
- [ ] Test all functionality in production environment

### Content
- [ ] Add real dragon data via admin panel
- [ ] Upload actual dragon photos
- [ ] Test modal slideshows with real multi-image dragons
- [ ] Verify parent genetics display with real breeding pairs
- [ ] Check all text content for typos/accuracy

### Optional Enhancements
- [ ] Add contact form
- [ ] Set up email notifications for inquiries
- [ ] Add Google Analytics
- [ ] Implement automated database backups
- [ ] Add image optimization on upload
- [ ] Create sitemap for SEO
- [ ] Add meta tags and Open Graph data
- [ ] Set up 404 page
- [ ] Add breadcrumbs to admin panel
- [ ] Consider adding dragon search/filter functionality
- [ ] Add "Recently Added" or "Featured" sections
- [ ] Implement image lazy loading for performance
- [ ] Add loading states for modals
- [ ] Consider adding clutch management section
- [ ] Add "Sold" archive page (optional)
- [ ] Create care guides or resources section
- [ ] Add testimonials section
- [ ] Social media integration
- [ ] Cookie consent banner (if required by law)

### Future Features to Consider
- [ ] Customer accounts for tracking reservations
- [ ] Waiting list for specific morphs
- [ ] Blog/news section for updates
- [ ] Breeding calendar/schedule
- [ ] Care instructions per dragon
- [ ] Video integration
- [ ] Live chat support
- [ ] Payment integration (Stripe/PayPal)
- [ ] Shipping calculator
- [ ] Email newsletter signup
- [ ] Dragon comparison tool
- [ ] Genetic calculator
- [ ] Admin dashboard with stats
- [ ] Inventory management

## 🐛 Known Issues

None currently! 🎉

## 📝 Notes

### Image Requirements
- **Hero Banner**: 1920x600px recommended
- **Dragon Cards**: 800x600px minimum, square or landscape
- **Gallery Images**: Any reasonable size (will be contained in modal)
- **Format**: JPEG or PNG

### Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

### Performance
- Modal images use blurred backgrounds (CSS filter)
- Images should be optimized before upload
- Consider CDN for production if traffic is high

## 🤝 Contributing

This is a private project. No contributions accepted.

## 📄 License

Private/Proprietary - All rights reserved

## 👤 Author

Liam - DragonMorphs
- Website: hizhub.com
- Email: liamnugent@hizhub.com

## 🙏 Acknowledgments

- Laravel Framework
- Splide.js for image sliders
- Font Awesome for icons
- Anthropic Claude for development assistance

---

**Last Updated**: February 2026
**Version**: 1.0
**Status**: Ready for production deployment