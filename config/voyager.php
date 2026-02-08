<?php

return [
    'user' => [
        'add_default_role_on_register' => true,
        'default_role' => 'user',
        'default_avatar' => 'users/default.png',
        'redirect' => '/admin',
    ],
    'controllers' => [
        'namespace' => 'TCG\\Voyager\\Http\\Controllers',
    ],
    'models' => [
        'namespace' => 'App\\Models\\',
    ],
    'storage' => [
        'disk' => 'public',
    ],
    'hidden_files' => false,
    'database' => [
        'tables' => [
            'hidden' => ['migrations', 'data_rows', 'data_types', 'menu_items', 'password_resets', 'permission_role', 'personal_access_tokens', 'settings'],
        ],
        'autoload_migrations' => true,
    ],
    'multilingual' => [
        'enabled' => false,
        'default' => 'en',
        'locales' => [
            'en',
        ],
    ],
    'dashboard' => [
        'navbar_items' => [
            'voyager::generic.profile' => [
                'route' => 'voyager.profile',
                'classes' => 'class-full-of-rum',
                'icon_class' => 'voyager-person',
            ],
            'voyager::generic.home' => [
                'route' => '/',
                'icon_class' => 'voyager-home',
                'target_blank' => true,
            ],
            'voyager::generic.logout' => [
                'route' => 'voyager.logout',
                'icon_class' => 'voyager-power',
            ],
        ],
        'widgets' => [
        ],
    ],
    'bread' => [
        'add_menu_item' => true,
        'default_menu' => 'admin',
        'add_permission' => true,
        'default_role' => 'admin',
    ],
    'primary_color' => '#22A7F0',
    'show_dev_tips' => true,
    'additional_css' => [
    ],
    'additional_js' => [
    ],
    'googlemaps' => [
        'key' => env('GOOGLE_MAPS_KEY', ''),
        'center' => [
            'lat' => env('GOOGLE_MAPS_DEFAULT_CENTER_LAT', '32.715738'),
            'lng' => env('GOOGLE_MAPS_DEFAULT_CENTER_LNG', '-117.161084'),
        ],
        'zoom' => env('GOOGLE_MAPS_DEFAULT_ZOOM', 11),
    ],
    'settings' => [
        'cache' => false,
    ],
    'compass_in_production' => false,
    'media' => [
        'allowed_mimetypes' => [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/bmp',
            'video/mp4',
        ],
        'path' => '/',
        'show_folders' => true,
        'allow_upload' => true,
        'allow_move' => true,
        'allow_delete' => true,
        'allow_create_folder' => true,
        'allow_rename' => true,
    ],
];
