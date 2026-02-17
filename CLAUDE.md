# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

AZM Clan Group — a Laravel 12 B2B e-commerce platform for authorized distribution and marketplace partnerships. Features a public product catalog with inquiry system and an admin panel for content/product management.

## Common Commands

```bash
# Full dev environment (server + queue + logs + vite in parallel)
composer dev

# Individual services
php artisan serve              # Laravel dev server
npm run dev                    # Vite dev server (HMR)
npm run build                  # Production build

# Testing
composer test                  # Runs config:clear then php artisan test
php artisan test --filter=TestName  # Run a single test

# Linting
./vendor/bin/pint              # Laravel Pint (PHP code style)

# Setup from scratch
composer setup                 # install, .env, key:generate, migrate, npm install, npm build

# Useful artisan commands
php artisan migrate            # Run migrations
php artisan route:list         # List all routes
php artisan storage:link       # Create public storage symlink
```

## Architecture

### Frontend/Backend Split

The app has two distinct areas sharing one Laravel codebase:

- **Frontend** (`/`): Public product catalog, static pages, inquiry forms. No auth required.
- **Backend** (`/admin/*`): Admin panel for managing products, categories, brands, inquiries, settings, homepage content. Protected by `auth` + `verified` middleware.

Admin access is controlled by an `is_admin` boolean field on the User model. Note: there is no admin middleware guard — routes rely only on `auth` + `verified`.

### Controller Organization

- `app/Http/Controllers/Frontend/` — Public-facing: ProductController (browse/filter/search), PageController (static pages + contact/partner forms), InquiryController (submit inquiries)
- `app/Http/Controllers/Backend/` — Admin CRUD: ProductController, CategoryController, BrandController, DashboardController, InquiryController (manage inquiries + contact messages), SettingsController, ProductImportController, HomepageSectionController

### Models & Relationships

- **Product** → belongsTo Category, belongsTo Brand (optional). Stores gallery images as JSON array. Flags: `is_active`, `is_trending`, `is_hot`.
- **Category** → hasMany Products. Flag: `is_top` (show on homepage).
- **Brand** → hasMany Products.
- **Inquiry** → belongsTo Product. Status: pending/responded/closed.
- **ContactMessage** → General contact/partner forms. Type field distinguishes `contact` vs `partner`. Has `business_type` (Brand/Reseller).
- **Setting** → Key-value store with static `get()`/`set()` methods. Groups: `general`, `seo`. Used in layouts for logos, favicon, meta tags, contact info.
- **HomepageSection** → hasMany HomepageCards. Dynamic homepage content blocks with ordering.

### Views

- `resources/views/frontend/` — Public pages, product listing/detail, quickview modal partial
- `resources/views/backend/` — Admin CRUD forms, dashboard, settings, homepage editor
- `resources/views/layouts/frontend/` — Frontend master layout + header/footer partials
- `resources/views/layouts/backend/` — Admin layout + sidebar/header/top-menu/footer partials
- `resources/views/auth/` — Breeze auth views (registration is disabled)

### Routes

All routes are in `routes/web.php`. Admin routes use prefix `admin` and name prefix `admin.` with resource controllers. Product import routes are defined before the products resource to avoid route conflicts.

### Asset Pipeline

- **Vite** bundles `resources/css/app.css` and `resources/js/app.js`
- **Tailwind CSS** (v3) with `@tailwindcss/forms` plugin
- **Alpine.js** for interactivity
- Frontend uses additional vendor libraries from `public/frontend/` (Bootstrap, jQuery, Owl Carousel, Magnific Popup, SlickNav, Font Awesome, Themify Icons)
- Admin uses vendor libraries from `public/backend/`

### File Storage

Uploads go to the `public` disk (`storage/app/public/`), symlinked to `public/storage/`. Upload paths:
- Products: `uploads/products/thumbnails/`, `uploads/products/gallery/`
- Categories: `uploads/categories/`
- Brands: `brands/`
- Avatars: `avatars/`
- Settings: `settings/`
- Homepage cards: `homepage/cards/`

### Product Import

Bulk import via CSV or ZIP archive. ZIP can bundle CSV + images together. The system auto-creates categories and brands by name if they don't exist. Handles slug collision with numeric suffixes.

### Local Development

Runs on Laragon with pretty URLs at `http://azmclangroup.com.test`. Tests use SQLite in-memory database (configured in `phpunit.xml`).
