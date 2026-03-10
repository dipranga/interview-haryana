<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Information Haryana — Routes
|--------------------------------------------------------------------------
*/

// Default CI3 controller
$route['default_controller'] = 'Home';
$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;

// ── PUBLIC ────────────────────────────────────────────────────────────
$route['']                           = 'Home/index';
$route['category/(:any)']            = 'News/category/$1';
$route['news/(:any)']                = 'News/show/$1';
$route['tag/(:any)']                 = 'News/tag/$1';
$route['search']                     = 'News/search';

// ── ADMIN AUTH ────────────────────────────────────────────────────────
$route['admin/login']                = 'admin/Auth/login';
$route['admin/login/post']           = 'admin/Auth/login_post';
$route['admin/logout']               = 'admin/Auth/logout';

// ── ADMIN DASHBOARD ───────────────────────────────────────────────────
$route['admin']                      = 'admin/Dashboard/index';
$route['admin/dashboard']            = 'admin/Dashboard/index';

// ── ADMIN NEWS ────────────────────────────────────────────────────────
$route['admin/news']                 = 'admin/News_admin/index';
$route['admin/news/create']          = 'admin/News_admin/create';
$route['admin/news/store']           = 'admin/News_admin/store';
$route['admin/news/edit/(:num)']     = 'admin/News_admin/edit/$1';
$route['admin/news/update/(:num)']   = 'admin/News_admin/update/$1';
$route['admin/news/delete/(:num)']   = 'admin/News_admin/delete/$1';
$route['admin/news/status/(:num)']   = 'admin/News_admin/toggle_status/$1';

// ── ADMIN CATEGORIES ─────────────────────────────────────────────────
$route['admin/categories']                = 'admin/Category_admin/index';
$route['admin/categories/create']         = 'admin/Category_admin/create';
$route['admin/categories/store']          = 'admin/Category_admin/store';
$route['admin/categories/edit/(:num)']    = 'admin/Category_admin/edit/$1';
$route['admin/categories/update/(:num)']  = 'admin/Category_admin/update/$1';
$route['admin/categories/delete/(:num)']  = 'admin/Category_admin/delete/$1';

// ── ADMIN BANNERS ─────────────────────────────────────────────────────
$route['admin/banners']                   = 'admin/Banner_admin/index';
$route['admin/banners/create']            = 'admin/Banner_admin/create';
$route['admin/banners/store']             = 'admin/Banner_admin/store';
$route['admin/banners/edit/(:num)']       = 'admin/Banner_admin/edit/$1';
$route['admin/banners/update/(:num)']     = 'admin/Banner_admin/update/$1';
$route['admin/banners/delete/(:num)']     = 'admin/Banner_admin/delete/$1';

// ── ADMIN TAGS ────────────────────────────────────────────────────────
$route['admin/tags']                      = 'admin/Tag_admin/index';
$route['admin/tags/store']                = 'admin/Tag_admin/store';
$route['admin/tags/delete/(:num)']        = 'admin/Tag_admin/delete/$1';

// ── ADMIN SETTINGS ────────────────────────────────────────────────────
$route['admin/settings']                  = 'admin/Settings_admin/index';
$route['admin/settings/update']           = 'admin/Settings_admin/update';
$route['admin/settings/change_password']  = 'admin/Settings_admin/change_password';
$route['admin/settings/upload_logo']      = 'admin/Settings_admin/upload_logo';
$route['admin/settings/remove_logo']      = 'admin/Settings_admin/remove_logo';