<?php
declare(strict_types=1);

// Delete my account
// Export Datas auto+request
// Export Orders auto+request
// Consent

namespace Eknow\GdprPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class EknowGdprPlugin extends Bundle
{
    use SyliusPluginTrait;
}
