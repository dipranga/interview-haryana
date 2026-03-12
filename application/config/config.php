<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Interview haryana — Main Config
|--------------------------------------------------------------------------
*/

// Base URL — update this to match your WAMP setup
//$config['base_url'] = 'http://localhost/interview-haryana/';
$config['base_url'] = 'http://136.232.163.122/interview-haryana/';

$config['index_page']       = '';          // Empty because we use .htaccess
$config['uri_protocol']     = 'AUTO';
$config['url_suffix']       = '';
$config['language']         = 'english';
$config['charset']          = 'UTF-8';
$config['enable_hooks']     = FALSE;
$config['subclass_prefix']  = 'MY_';
$config['composer_autoload']= FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']  = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']   = 'c';
$config['function_trigger']     = 'm';
$config['directory_trigger']    = 'd';
$config['log_errors']           = TRUE;
$config['log_threshold']        = 1;
$config['log_path']             = '';
$config['log_file_extension']   = '';
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['error_views_path']     = '';
$config['cache_path']           = '';
$config['cache_query_string']   = FALSE;

// Session
$config['sess_driver']          = 'files';
$config['sess_cookie_name']     = 'ih_session';
$config['sess_expiration']      = 7200;
$config['sess_save_path']       = NULL;
$config['sess_match_ip']        = FALSE;
$config['sess_time_to_update']  = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Cookie
$config['cookie_prefix']    = 'ih_';
$config['cookie_domain']    = '';
$config['cookie_path']      = '/';
$config['cookie_secure']    = FALSE;
$config['cookie_httponly']  = FALSE;

// Security
$config['csrf_protection']  = TRUE;
$config['csrf_token_name']  = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie';
$config['csrf_expire']      = 7200;
$config['csrf_regenerate']  = TRUE;
$config['csrf_exclude_uris'] = array();

$config['global_xss_filtering'] = FALSE;
$config['compress_output']      = FALSE;
$config['time_reference']       = 'local';
$config['rewrite_short_tags']   = FALSE;
$config['encryption_key']       = 'IHaryana@2024!SecretKey#Change';

// Proxy
$config['proxy_ips'] = '';
