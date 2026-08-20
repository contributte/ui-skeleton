# UI skeleton

A Nette application skeleton with Vite, Tailwind CSS, and Alpine.js.

## Requirements

- PHP 8.4 or newer
- [Composer](https://getcomposer.org/)
- Node.js and npm

## Create a project

```bash
composer create-project contributte/ui-skeleton acme
cd acme
make init
make setup
npm ci
```

Composer installs the PHP dependencies while creating the project. `make init` creates the ignored `config/local.neon`; `make setup` prepares the writable runtime directories. `npm ci` installs the locked frontend dependencies.

## Local development

The application expects a generated Vite manifest. Start the asset watcher first:

```bash
npm run watch
```

Wait for its initial build to write `www/dist/manifest.json`, then start the PHP application in a second terminal:

```bash
make dev
```

Open [http://localhost:8000](http://localhost:8000). `npm run watch` rebuilds assets on changes; it does not start a Vite development server. Use `npm run build` for a production asset build. `make build` installs npm dependencies and builds production assets, while `make assets` starts the same asset watcher.

## Vite assets

Vite builds `assets/js/app.ts` into `www/dist/` and writes a manifest there. Development builds use stable filenames; production builds use hashed filenames. The application reads this manifest through the UI integration, so deploy the generated `www/dist/` files with the application.

## Configuration

Shared application configuration is in `config/config.neon`. Keep local parameters and service overrides in the ignored `config/local.neon`, created from `config/local.neon.example`.

## Quality assurance

```bash
make qa
make tests
```

`make qa` runs coding-standard and PHPStan checks. `make tests` runs Nette Tester tests from `tests/`.
