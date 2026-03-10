# Interview haryana — CodeIgniter 3 News Website

## Project Structure

```
interview-haryana/          ← Drop this INTO your CI3 root
├── application/
│   ├── config/
│   │   ├── config.php        ← Update base_url here
│   │   ├── database.php      ← Update DB credentials here
│   │   ├── autoload.php
│   │   └── routes.php
│   ├── core/
│   │   └── MY_Controller.php ← Base controllers (public + admin)
│   ├── controllers/
│   │   ├── Home.php
│   │   ├── News.php
│   │   └── admin/
│   │       ├── Auth.php
│   │       ├── Dashboard.php
│   │       ├── News_admin.php
│   │       └── Support_admin.php  ← Category, Banner, Tag, Settings
│   ├── models/
│   │   ├── News_model.php
│   │   ├── Category_model.php
│   │   └── Support_models.php    ← Banner, Tag, Admin, Settings
│   └── views/
│       ├── layouts/              ← header.php, footer.php
│       ├── home/                 ← index.php
│       ├── news/                 ← show, category, search, tag
│       └── admin/                ← login, dashboard, news, categories, banners, tags, settings
├── assets/
│   ├── css/style.css
│   ├── css/admin.css
│   ├── js/main.js
│   └── uploads/news/ & uploads/banners/   ← writable!
├── database.sql
└── .htaccess
```

---

## Setup Instructions (WAMP + CI3)

### Step 1: Download CodeIgniter 3

Download from: https://codeigniter.com/download  
Use version **3.1.x** (the latest CI3 release)

### Step 2: Place Files

Extract CI3 to: `C:\wamp64\www\interview-haryana\`

Then copy these project files into it, merging/replacing:
- Copy `application/` folder contents
- Copy `assets/` folder
- Copy `.htaccess` to root
- Copy `database.sql`

### Step 3: Configure Database

Edit `application/config/database.php`:
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';        // your WAMP password (usually blank)
$db['default']['database'] = 'interview_haryana';
```

### Step 4: Configure Base URL

Edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/interview-haryana/';
```

### Step 5: Import Database

1. Open phpMyAdmin → http://localhost/phpmyadmin
2. Create database: `interview_haryana`
3. Click Import → select `database.sql` → Go

### Step 6: Enable mod_rewrite (Apache)

In WAMP, left-click the WAMP tray icon:
`Apache → Apache Modules → rewrite_module` (check it)

Also make sure `AllowOverride All` is set in `httpd.conf` for your htdocs.

### Step 7: Set Upload Permissions

These folders must be writable (WAMP usually handles this automatically):
```
assets/uploads/news/
assets/uploads/banners/
```

### Step 8: Test

- **Frontend**: http://localhost/interview-haryana/
- **Admin**: http://localhost/interview-haryana/admin/login

---

## Admin Login

| Field    | Value                              |
|----------|------------------------------------|
| Email    | admin@interviewharyana.com       |
| Password | `password`                         |

> ⚠️ **IMPORTANT**: Change password immediately after first login!
>
> Generate a new bcrypt hash with PHP:
> ```php
> echo password_hash('YourNewPassword', PASSWORD_DEFAULT);
> ```
> Then run in phpMyAdmin:
> ```sql
> UPDATE admins SET password = 'PASTE_HASH_HERE' WHERE email = 'admin@interviewharyana.com';
> ```

---

## CI3-Specific Notes

### Controller Naming
- CI3 uses `snake_case` filenames and `PascalCase` class names
- Admin controllers live in `application/controllers/admin/`
- Admin controller filenames: `News_admin.php`, `Category_admin.php`, etc.
  (avoiding reserved names like `News` which conflicts with public controller)

### Base Controllers
- `MY_Controller` — all public pages extend this (auto-loads settings + categories)
- `Admin_Controller` — all admin pages extend this (checks login session)

### Session
- CI3 uses `$this->session->set_userdata()` / `->userdata()`
- Session driver: `files` (stored in `application/cache/` or system tmp)

### Form Helper
- Views use `form_open()`, `form_open_multipart()`, `form_close()` — CI3 helpers
- CSRF token is auto-inserted by `form_open()`

### URL Structure
- Routes are defined in `application/config/routes.php`
- No trailing slash needed on URLs

---

## Admin Features

| Section    | Features                                             |
|-----------|------------------------------------------------------|
| Dashboard  | 5 stat cards, quick actions, recent articles table   |
| Articles   | Full CRUD, featured/breaking flags, image upload, status toggle |
| Categories | CRUD with color picker, sort order                   |
| Banners    | Image upload, homepage slider / sidebar positions    |
| Tags       | Bulk add (comma separated), delete with usage count  |
| Settings   | Site info, social links, ticker text, footer text    |

---

## Tech Stack

- **Framework**: CodeIgniter 3.1.x
- **Language**: PHP 7.4+ / 8.x
- **Database**: MySQL / MariaDB
- **Server**: Apache (WAMP)
- **Frontend**: Vanilla HTML/CSS/JS (no build step needed)
- **Fonts**: Google Fonts — Noto Sans Devanagari, Mukta, Oswald
- **Icons**: Font Awesome 6

---

*Interview haryana — हरियाणा की हर खबर*
