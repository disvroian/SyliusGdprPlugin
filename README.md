<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

<h1 align="center">Sylius Plugin GDPR</h1>

<p align="center">Provide some useful command for daily use.</p>

## Quickstart Installation

1. Run `composer require eknow/sylius-gdpr-plugin`.

2. From Sylius root directory, run the following commands:

    ```bash
    $ vi config/bundles.php
    ```
3. Add the following inside the Array:

    ```php
    $ Eknow\SyliusGdprPlugin\EknowSyliusGdprPlugin::class => ['all' => true],
    ```
4. Run the following command to validate it works

    ```bash
    $ php bin/console list
    ```
Result will be an list of command such as

    ```bash
    $ sylius:admin:create                     Create an admin user for the backend
    $ sylius:admin:delete                     Delete the admin user on backend with his ID
    $ sylius:cart:abandonned                  Clean all abandonned carts.
    ```
