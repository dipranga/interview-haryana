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
