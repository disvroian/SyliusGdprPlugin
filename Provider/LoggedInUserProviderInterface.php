<?php
declare(strict_types=1);

namespace Eknow\SyliusGdprPlugin\Provider;

use Sylius\Component\Core\Model\ShopUserInterface;

interface LoggedInUserProviderInterface
{
    /**
     * @return ShopUserInterface|null
     */
    public function getUser() : ?ShopUserInterface;
}
