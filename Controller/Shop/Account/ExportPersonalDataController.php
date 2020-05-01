<?php
declare(strict_types=1) ;

namespace Eknow\GdprPlugin\Controller\Shop\Account ;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;

use Eknow\GdprPlugin\Provider\LoggedInUserProviderInterface ;
use Sylius\Component\Core\Repository\CustomerRepositoryInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

final class ExportPersonalDataController extends Controller
{

  private $delimiter = ';';
  private $enclosure = '"';

  /**
  * @var LoggedInUserProviderInterface
  */
  protected $loggedInUserProvider;

  /**
   * @var CustomerRepositoryInterface
   */
  private $customerRepository;

  /**
   * @var FactoryInterface
   */
  private $customerFactory;

  /**
   * @param LoggedInUserProviderInterface $loggedInUserProvider
   *
   */
  public function __construct(
              LoggedInUserProviderInterface $loggedInUserProvider,
              CustomerRepositoryInterface $customerRepository
          ) {
    $this->loggedInUserProvider= $loggedInUserProvider ;
    $this->customerRepository= $customerRepository;
  }

  /**
   * @param string|null $name
   *
   * @return Response
   */
  public function __invoke(Request $request): BinaryFileResponse
  {
    // Abort if no logged-in user
    if (!($loggedInUser = $this->loggedInUserProvider->getUser())) {
      throw $this->createNotFoundException('You need to be logged in') ;
    }

    $customer= $this->customerRepository->findOneBy(array("id"=> $loggedInUser->getId())) ;
    $resultBirthday= $customer->getBirthday()->format('Y-m-d H:i:s');
    $resultCreatedAt= $customer->getCreatedAt()->format('Y-m-d H:i:s');

    $filename= $this->get('kernel')->getRootDir() . '/../var/TextFile.csv' ;
    $response= new BinaryFileResponse($filename) ;
    $mimeTypeGuesser= new FileinfoMimeTypeGuesser() ;
    $handle= fopen($filename, 'w') ;
    fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    fputcsv($handle,
            array(
              "Email",
              "First Name",
              "Last Name",
              "Birthday",
              "Gender",
              "Phone Number",
              "NewsLetter",
              "Created At"),
            $this->delimiter,
            $this->enclosure) ;
    fputcsv($handle,
            array(
              $customer->getEmail(),
              $customer->getFirstName(),
              $customer->getLastName(),
              $resultBirthday,
              $customer->getGender(),
              $customer->getPhoneNumber(),
              $resultCreatedAt
            ),
            $this->delimiter,
            $this->enclosure) ;
    rewind( $handle ) ;
    $output= stream_get_contents( $handle ) ;
    fclose( $handle ) ;
    if( $mimeTypeGuesser->isSupported()) {
      $response->headers->set('Content-Type', $mimeTypeGuesser->guess($filename)) ;
    }
    else {
      $response->headers->set('Content-Type', 'text/csv') ;
    }
    $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, "" ) ;
    return $response;
  }
}
