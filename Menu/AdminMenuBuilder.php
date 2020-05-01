<?php
declare(strict_types=1) ;

namespace Eknow\GdprPlugin\Menu ;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuBuilder
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu() ;
        $newSubmenu= $menu->addChild('new')->setLabel('RGPD') ;
        $newSubmenu->addChild('new-subitem')->setLabel('Configuration') ;
    }
}
