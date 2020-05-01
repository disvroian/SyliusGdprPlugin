<?php
declare(strict_types=1) ;

namespace Eknow\SyliusGdprPlugin\Controller\Shop\Account ;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;

use Eknow\SyliusGdprPlugin\Provider\LoggedInUserProviderInterface ;
use Sylius\Component\Core\Repository\CustomerRepositoryInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

final class DeleteController extends Controller
{

  private $delimiter = ';';
  private $enclosure = '"';

  private $configCustomerCanDeleteIsAccount= 0 ; //false per default

  /**
  * @var LoggedInUserProviderInterface
  */
  protected $loggedInUserProvider;

  /**
   * @var CustomerRepositoryInterface
   */
  private $customerRepository;

  /**
   * @param LoggedInUserProviderInterface $loggedInUserProvider
   * @param CustomerRepositoryInterface $customerRepository
   *
   */
  public function __construct(
              $configCustomerCanDeleteIsAccount,
              LoggedInUserProviderInterface $loggedInUserProvider,
              CustomerRepositoryInterface $customerRepository
          ) {
    $this->configCustomerCanDeleteIsAccount= $configCustomerCanDeleteIsAccount[0] ;
    $this->loggedInUserProvider= $loggedInUserProvider ;
    $this->customerRepository= $customerRepository ;
  }

  /**
   * @param string|null $name
   *
   * @return Response
   */
  public function __invoke(Request $request): Response
  {
    // Abort if no logged-in user
    if (!($loggedInUser = $this->loggedInUserProvider->getUser())) {
      throw $this->createNotFoundException('You need to be logged in') ;
    }
    if( $this->configCustomerCanDeleteIsAccount== 1 ) {
      $customer= $this->customerRepository->findOneBy(array("id"=> $loggedInUser->getId())) ;
      $this->customerRepository->remove($customer) ;
      $this->customerRepository->flush() ;
      return $this->redirectToRoute('sylius_shop_logout') ;
    }
    else {
      return $this->redirectToRoute('sylius_shop_account_gdpr') ;
    }
  }
}
