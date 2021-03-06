<?php
declare(strict_types=1);

namespace Eknow\SyliusGdprPlugin\Provider;

use Sylius\Component\Core\Model\ShopUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoggedInUserProvider implements LoggedInUserProviderInterface
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
      $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return ShopUserInterface|null
     */
    public function getUser() : ?ShopUserInterface
    {
        if ($securityToken = $this->tokenStorage->getToken()) {
            if (($user = $securityToken->getUser()) instanceof ShopUserInterface) {
                return $user;
            }
        }

        return null;
    }

    public function setLogout() : ?ShopUserInterface
    {
      $this->tokenStorage->setToken(null);
      if (($user = $securityToken->getUser()) instanceof ShopUserInterface) {
          return $user;
      }
      return null;
//      $this->get('request')->getSession()->invalidate();
    }
}
