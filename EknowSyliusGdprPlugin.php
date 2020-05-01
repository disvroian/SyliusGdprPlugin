<?php
declare(strict_types=1);

// Delete my account
// Export Datas auto+request
// Export Orders auto+request
// Consent

namespace Eknow\SyliusGdprPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class EknowSyliusGdprPlugin extends Bundle
{
    use SyliusPluginTrait;
}
