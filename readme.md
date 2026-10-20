# **Book Store Management System in PHP - CodeIgniter 3.1.13**

## Local setup

1. Start Apache and MySQL in XAMPP. The existing local virtual host uses
   `H:/x/htdocs/bsms_ci` and opens at <http://book.localhost/>.
2. Copy `env/.env.local.example` to `env/.env.local` if `env/.env.local` does not already exist. Set the
   `DB_*` values for your MySQL account and generate `APP_ENCRYPTION_KEY` once:

   ```powershell
   Copy-Item env/.env.local.example env/.env.local
   php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
   ```

   Paste the generated value after `APP_ENCRYPTION_KEY=`. Keep `env/.env.local` private;
   `env/.env.local.example` is the shareable template. This checkout's `env/.env.local` is already
   configured for the local virtual host and a local root MySQL account with
   an empty password.
3. On a fresh database server, create `ci_bsms_db` in phpMyAdmin and import
   `database/ci_bsms_db.sql`. Skip the import when the project tables already
   exist; the dump is intended for an empty database.
4. Ensure Apache can write to `application/cache`,
   `application/cache/sessions`, `application/logs`, and `assets/gambar`.
5. Open <http://book.localhost/>. The sample admin credentials are listed below.

The application loads the selected environment file with `putenv()` before
CodeIgniter starts. Configuration uses standard PHP `getenv()` calls, without an
additional Composer dependency. The bundled framework is sufficient to run the app;
Composer installation is not required for local startup. This XAMPP server
uses PHP 7.4; PHP on your command line may be a different installation.
Enable `mysqli`, `mbstring`, and PHP session support in the serving PHP runtime.

Environment settings:

| Setting | Purpose |
| --- | --- |
| `CI_ENV` | `development`, `testing`, or `production` |
| `APP_URL` | Full URL of the project, including any subdirectory |
| `APP_INDEX_PAGE` | `index.php`; use an empty value when Apache rewriting works |
| `APP_TIMEZONE` | PHP timezone, default `Asia/Manila` |
| `APP_ENCRYPTION_KEY` | Private, randomly generated application key |
| `COOKIE_SECURE` | Set to `true` when serving over HTTPS |
| `DB_HOST`, `DB_PORT` | MySQL address and port |
| `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | MySQL database and credentials |
| `SESSION_SAVE_PATH` | Optional absolute session directory; omit to use `application/cache/sessions` |

Existing process environment variables override the selected file; server variables are
used when there is no process value. Empty values are preserved.
Values may be enclosed in matching single or double quotes. Values are literal:
variable interpolation, multiline values, and escape expansion are unsupported.
Put comments on separate lines beginning with `#`.

If serving this project as a subdirectory instead, set
`APP_URL=http://localhost/bsms_ci/`. Apache requires `mod_rewrite` and permission
to apply `.htaccess`. The root `.htaccess` blocks environment files and database
dumps; use equivalent access rules if switching to another web server.

## Production setup

Environment files live in `env/`. Set `CI_ENV` in the server/process environment
before startup to select the file: `production` loads `env/.env.prod`, while
`development` and `testing` load `env/.env.local`. Request hostnames do not select
the environment. If no selector is set, the presence of `env/.env.local` selects
development; otherwise production is selected. Do not deploy `env/.env.local`.

1. On the production server, copy `env/.env.prod.example` to `env/.env.prod`
   if it does not already exist. Set `CI_ENV=production` in the server environment
   (for Apache, `SetEnv CI_ENV production` in the production virtual host).
   The `.example` files are templates and are never loaded automatically.
2. Use `APP_URL=https://book.prod/` for the production hostname.
   Configure `book.prod` DNS, TLS
   certificate, and web-server virtual host to serve this project's directory.
3. Set production `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and
   `DB_PASSWORD`. Use a dedicated database account. Import the SQL dump only
   when initializing a new, empty database.
4. Generate a separate production `APP_ENCRYPTION_KEY` using the command above
   when creating a new file. This checkout's `env/.env.prod` already has its own key.
   Leave `CI_ENV=production` and `COOKIE_SECURE=true` for the HTTPS deployment.
5. Ensure the session, cache, logs, and upload directories are writable by PHP.
   Configure Apache to honor this project's `.htaccess` rules.
6. Change the sample admin password before allowing access to the application.

`CI_ENV` inside a file cannot change which file is selected. `APP_URL` is
required, and production also requires a nonempty `APP_ENCRYPTION_KEY`.
Production disables displayed PHP/database errors. Production credentials and
the real hostname must be supplied on that server; the template alone is not
a completed deployment.

=============================================
**Database Name: ci_bsms_db**
**Recommended PHP Version 7.4 and Newer**
=============================================


=============================================
**Original**
=============================================
**Developed by Imanullah**
**Published @ CodeAstro.com**
=============================================
**Modied**
=============================================
**Developed by oretnom23**
**Published @ sourcecodester.com**
=============================================

=============================================
**Admin Login**
=============================================
** Username: admin **
** Password: admin#123 **
=============================================
