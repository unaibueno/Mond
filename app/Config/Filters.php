<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf' => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth' => \App\Filters\AuthFilter::class,
        'role' => \App\Filters\RoleFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string>>
     */
    public array $globals = [
        'before' => [
            // Aquí puedes colocar los filtros globales si es necesario
        ],
        'after' => [
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that work on a
     * particular HTTP method (GET, POST, etc.).
     *
     * @var array<string, array<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example: 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, array<string>>>
     */
    public array $filters = [
        'auth' => [
            'before' => [
                'dashboard/*',
                'tareas/*',
                'notas/*',
                'pomodoro/*',
                'calendario/*',
            ],
        ],
        'role' => [
            'before' => [
                'dashboard/*',
                'tareas/*',
                'notas/*',
                'pomodoro/*',
                'calendario/*',
            ],
        ],
    ];
}
