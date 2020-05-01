<?php
declare(strict_types=1) ;

namespace Eknow\GdprPlugin\Menu ;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AccountMenuBuilder
{
    public function addAccountMenuItems(MenuBuilderEvent $event): void
    {
        $menu= $event->getMenu();
        $menu
            ->addChild('new', ['route' => 'sylius_shop_account_gdpr'])
            ->setLabel('Legal')
            ->setLabelAttribute('icon', 'warning')
        ;
    }
}
