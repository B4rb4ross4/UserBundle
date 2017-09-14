Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest version of this bundle (there is no stable version yet):

```console
$ composer require b4rb4ross4/symfony-user-bundle "@dev"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new B4rb4ross4\UserBundle\UserBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configure the Bundle your bundle inside your app.
----------------------------

Add the routes to your `app/config/routing.yml`:


```yaml
b4rb4ross4_user:
    resource: '@B4rb4ross4UserBundle/Controller/'
    type:     annotation
```

At last you must change your `app/config/security.yml` settings:

The login route id is: b4rb4ross4_user_login
The logout route id is: b4rb4ross4_user_logout

```yaml
firewalls:
    secured_area:
        # this firewall applies to all URLs
        pattern: ^/

        # but the firewall does not require login on every page
        # denying access is done in access_control or in your controllers
        anonymous: ~

        # This allows the user to login by submitting a username and password
        # Reference: https://symfony.com/doc/current/security/form_login_setup.html
        form_login:
            # The route name that the login form submits to
            check_path: b4rb4ross4_user_login
            # The name of the route where the login form lives
            # When the user tries to access a protected page, they are redirected here
            login_path: b4rb4ross4_user_login
            # Secure the login form against CSRF
            # Reference: https://symfony.com/doc/current/security/csrf_in_login_form.html
            csrf_token_generator: security.csrf.token_manager
            # The page users are redirect to when there is no previous page stored in the
            # session (for example when the users access directly to the login page).
            default_target_path: default_route_name

        logout:
            # The route name the user can go to in order to logout
            path: b4rb4ross4_user_logout
            # The name of the route to redirect to after logging out
            target: default_route_name
```

Set the base view name in `app/config/config.yml`:

```yaml
parameters:
    b4rb4ross4.user.base_view: backend/base.html.twig
```

and require the bundle `config.yml` to get the twig variable:

```yaml
imports:
    - { resource: "@B4rb4ross4UserBundle/Resources/config/config.yml" }
```