<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Enunciado

### UD6

- Implementado el acceso a la aplicación por diferentes tipos usuarios (ACL):  
  - establecidos tres tipos de perfil  
    - admin, author, user (por defecto).

  - Las restricciones han sido establecidas sobre el recurso de usuarios.
  - Los usuarios de perfil ADMIN tienen acceso a todas las acciones.
  - Los usuarios AUTHOR pueden editar
  - Los usuarios USER no podrán ni editar, ni borrar.

- Guardada permiso de almacenar permiso de genrar cookie en el navegador al entrar en la vista welcome de bienvenida al sitio web.

- Guardada información de variable de sessión en la base de datos:  
  - se guardan ciertos datos del acceso del usuario al iniciar sesión.

### UD7

- Implementado controlador de recursos.

- Formulario para introducir un nuevo elemento del recurso y realiza la validación de los campos (al menos 4 campos de tipos diferentes)
