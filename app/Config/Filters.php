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
        'auth' => \App\Filters\AuthFilter::class, // Añade tu filtro personalizado aquí
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that work on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example: 'post' => ['foo', 'bar']
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
        'auth' => ['before' => ['dashboard/*']], // Aplica el filtro a las rutas que necesites
        'auth' => ['before' => ['tareas/*']], // Aplica el filtro a las rutas que necesites
        'auth' => ['before' => ['notas/*']], // Aplica el filtro a las rutas que necesites
        'auth' => ['before' => ['temporizador/*']], // Aplica el filtro a las rutas que necesites
        'auth' => ['before' => ['calendario/*']], // Aplica el filtro a las rutas que necesites

    ];
}
