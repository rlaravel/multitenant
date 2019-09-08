<?php

return [
    'crypt_pass' => env('CRYPT_PASS', 'password'),

    /*
    |--------------------------------------------------------------------------
    | Directorio de los Modelos de los Inquilinos
    |--------------------------------------------------------------------------
    |
    | En este directorio se guardaran todos los modelos que registre
    |
    */
    'folder_models_tenant' => 'Tenant',

    /*
    |--------------------------------------------------------------------------
    | Directorio de las migraciones de los Inquilinos
    |--------------------------------------------------------------------------
    |
    | En este directorio se guardaran todas las migraciones que registre
    |
    */
    'folder_migrations_tenant' => 'migrations_tenant',

    /*
    |--------------------------------------------------------------------------
    | Conexion
    |--------------------------------------------------------------------------
    |
    | Configuración de la conexión
    |
    */
    'config' => [
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
    ],
];
