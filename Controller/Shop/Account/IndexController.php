<?php
declare(strict_types=1) ;

namespace Eknow\SyliusGdprPlugin\Controller\Shop\Account ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class IndexController extends Controller
{

  private $configCustomerCanDeleteIsAccount= 0 ; //false per default
  private $configCustomerExport= 0 ; //false per default

  public function __construct(
            $configCustomerCanDeleteIsAccount,
            $configCustomerExport)
  {
    $this->configCustomerCanDeleteIsAccount= $configCustomerCanDeleteIsAccount[0] ;
    $this->configCustomerExport= $configCustomerExport[0] ;
  }

  public function indexAction(Request $request): Response
  {
      return $this->render(
                  '@EknowSyliusGdprPlugin/Shop/Account/index.html.twig',
                  [
                    'configCustomerCanDeleteIsAccount'=> $this->configCustomerCanDeleteIsAccount,
                    'configCustomerExport'=> $this->configCustomerExport
                  ]);
  }
}
