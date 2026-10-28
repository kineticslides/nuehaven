# Business Generator

A small Laravel application prepared for shared hosting. It renders a CSRF-protected business-type form and exposes a validated `POST /generate` endpoint that currently returns `Generated successfully`.

The project uses Tailwind CSS 4 through its browser CDN and plain files in `public/css` and `public/js`. It has no Node.js, npm, or Vite dependency. Tailwind documents its browser CDN as a development-oriented option; it is retained here because this project's explicit requirement is a CDN-only, build-free frontend.

## Requirements

- PHP 8.3 or newer with Laravel's standard PHP extensions
- Composer 2
- SQLite for the quickest local setup, or MySQL for production

Check your tools:

```bash
php -v
composer --version
```

## Install from a fresh copy

```bash
cd /path/to/vibe-app
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open `http://127.0.0.1:8000`. Stop the local server with `Ctrl+C`.

Alternatively, the included setup script performs the Composer install, creates `.env` when missing, creates the SQLite file, generates the key, and migrates the database:

```bash
composer run setup
```

## Tests and code formatting

```bash
php artisan test --compact
vendor/bin/pint --format agent
```

## Shared-hosting deployment

Never expose the whole Laravel project as the website directory. Upload the application outside the public website directory and configure the domain's document root (called the **Web directory** by some hosts) to the project's `public` directory.

On DreamHost, select PHP 8.3 or newer and change the domain's Web directory under **Manage Websites → Manage → Settings → Directories**. DreamHost's current instructions are linked in [Changing the web directory assigned to a domain](https://help.dreamhost.com/hc/en-us/articles/360041534491-Changing-the-web-directory-assigned-to-a-domain).

Example layout:

```text
/home/username/apps/business-generator/        Laravel project
/home/username/apps/business-generator/public  Domain document root
```

From SSH, in the project root:

```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
chmod -R ug+rwX storage bootstrap/cache
php artisan migrate --force
php artisan optimize
```

Generate `APP_KEY` only for a new deployment. Keep the existing key during updates, or encrypted cookies and other encrypted data will become unreadable.

Set the production values in `.env` before migration:

```dotenv
APP_NAME="Business Generator"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://example.com

DB_CONNECTION=mysql
DB_HOST=your-mysql-host
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_strong_database_password

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Do not commit or place `.env` in `public/`. The included `public/.htaccess` routes requests through `public/index.php`; Apache rewrite support must be enabled by the host.

For each later deployment, upload the changes and run:

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

## Project structure

Generated dependency internals under `vendor/` are intentionally summarized; everything needed to recreate them is locked in `composer.lock`.

```text
vibe-app/
├── .agents/                    Laravel Boost agent skills
├── .claude/                    Laravel Boost Claude integration
├── .codex/config.toml          Local Codex integration
├── .env                        Local secrets; never commit
├── .env.example                Safe environment template
├── .mcp.json                   Laravel Boost MCP configuration
├── app/
│   ├── Http/Controllers/
│   │   ├── Controller.php
│   │   └── HomeController.php
│   ├── Models/User.php
│   └── Providers/AppServiceProvider.php
├── bootstrap/
│   ├── app.php
│   ├── cache/
│   └── providers.php
├── config/                     Laravel configuration files
├── database/
│   ├── database.sqlite
│   ├── factories/UserFactory.php
│   ├── migrations/
│   └── seeders/DatabaseSeeder.php
├── public/                     Only web-accessible directory
│   ├── css/app.css
│   ├── js/app.js
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources/
│   └── views/welcome.blade.php
├── routes/
│   ├── console.php
│   └── web.php
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   │   ├── ExampleTest.php
│   │   └── HomeControllerTest.php
│   ├── Unit/ExampleTest.php
│   └── TestCase.php
├── vendor/                     Composer dependencies (generated)
├── .gitignore
├── AGENTS.md
├── CLAUDE.md
├── artisan
├── boost.json
├── composer.json
├── composer.lock
├── phpunit.xml
└── README.md
```

## Key application files

- `routes/web.php` defines `GET /` and `POST /generate`.
- `app/Http/Controllers/HomeController.php` renders the form, validates `business_type`, and returns the placeholder response.
- `resources/views/welcome.blade.php` contains the Tailwind-styled form and `@csrf` token.
- `public/css/app.css` and `public/js/app.js` are referenced with Laravel's `asset()` helper.

The `/generate` action is intentionally small so its placeholder response can later be replaced with an AI service without changing the form contract.
