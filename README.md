## Descripción

Este paquete nos permite crear bases de datos y gestionarlas en un solo sistema, es muy util para sistemas SAAS como POS o helpdesk.

## Instalación

    composer require rafaelmorenojs/multitenant

#### Configuración

Publicamos la configuración

    php artisan vendor:publish --provider="RafaelMorenoJS\MultiTenant\Providers\MultiTenantServiceProvider"

`crypt_pass`: Es el password que usaremos para encriptar la información de conexión la base de datos del inquilino.

`folder_models_tenant`: En este directorio se guardaran todos los modelos que registre. Ejemplo: `\App\Tenant`.

`folder_migrations_tenant`: En este directorio se guardaran todas las migraciones que registre.

`config.username`: Es el usuario que usará la base de datos del inquilino.

`config.password`: Es el password que usará la base de datos del inquilino.

Publicamos la migración

    php artisan migrate

### Uso

#### Comandos

Para crear un modelo en la base de datos tenant:

    php artisan tenant:model Person

automaticamente nos creara un modelo en en diretorio de los modelos inquilinos.