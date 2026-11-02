# Reproduction: Polish plural forms in Filament translations

Polish has **three** plural forms (`1` / `2-4, 22-24, ...` / everything else). Laravel's `MessageSelector` returns index 0, 1 or 2 for `pl` and **falls back to the first segment** when the index is missing. Several `pl` strings in Filament only have two segments (or `{1}|[2,*]` ranges), so e.g. a 10-minute MFA code is described as expiring "za minutę" (in one minute) and an export of 10 rows says "1 wiersz".

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan repro:pl-plurals                      # prints the affected strings for 1, 2, 4, 5, 10, 22
php artisan test --filter=PolishPluralTranslations  # 10 failing assertions on stock Filament
```

Added files: `routes/console.php` (`repro:pl-plurals` command), `tests/Feature/PolishPluralTranslationsTest.php`.

---

# Filament issue reproduction template

A minimal Laravel + Filament application for reproducing bugs you would like to file at [`filamentphp/filament`](https://github.com/filamentphp/filament/issues).

This repository is regenerated automatically from each stable Filament release. Each branch matches the Filament major version it was built against:

- [`3.x`](https://github.com/filamentphp/issue-reproduction-template/tree/3.x) — latest Filament v3 release (maintenance mode)
- [`4.x`](https://github.com/filamentphp/issue-reproduction-template/tree/4.x) — latest Filament v4 release
- [`5.x`](https://github.com/filamentphp/issue-reproduction-template/tree/5.x) — latest Filament v5 release

## Setup

You're on the `4.x` branch. To start a new reproduction project, run:

```bash
git clone --branch 4.x https://github.com/filamentphp/issue-reproduction-template.git filament-issue-reproduction
cd filament-issue-reproduction
composer setup
php artisan serve
```

`composer setup` installs Composer + npm dependencies, copies `.env.example` to `.env`, generates an app key, migrates and seeds the database, and builds frontend assets.

Log in at <http://127.0.0.1:8000/admin> with `test@example.com` / `password`.

Add the minimum code needed to reproduce your bug, push your repository, and link it from your Filament issue.
