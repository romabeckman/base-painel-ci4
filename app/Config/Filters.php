<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig {

    // Makes reading things below nicer,
    // and simpler to change out script that's used.
    public $aliases = [
        'csrf' => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'db_key' => \App\Filters\DBKey::class,
        'logged_in' => \Authorization\Application\Filters\LoggedInFilter::class,
        'permission' => \System\Application\Filters\PermissionFilter::class,
        'log_register' => \System\Application\Filters\LogRegisterFilter::class,
    ];
    // Always applied before every request
    public $globals = [
        'before' => [
            'db_key',
            'logged_in',
            'permission',
//            'db_key'
        //'honeypot'
        // 'csrf',
        ],
        'after' => [
            'log_register',
            'toolbar',
        //'honeypot'
        ],
    ];
    // Works on all of a particular HTTP method
    // (GET, POST, etc) as BEFORE filters only
    //     like: 'post' => ['CSRF', 'throttle'],
    public $methods = [];
    // List filter aliases and any before/after uri patterns
    // that they should run on, like:
    //    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
    public $filters = [];

}
