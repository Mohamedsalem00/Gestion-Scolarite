<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | List of locales supported by the application.
    |
    */
    'supported_locales' => [
        'fr' => [
            'name' => 'Français',
            'native' => 'Français',
            'flag' => 'fr',
        ],
        'ar' => [
            'name' => 'Arabic',
            'native' => 'العربية',
            'flag' => 'sa',
            'rtl' => true,
        ],
        'en' => [
            'name' => 'English',
            'native' => 'English',
            'flag' => 'us',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | Default locale for the application.
    |
    */
    'default_locale' => 'fr',

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | Fallback locale when translation is not available.
    |
    */
    'fallback_locale' => 'fr',
];
