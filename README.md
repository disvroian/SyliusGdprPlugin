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
