<?php

namespace App\Controller;

use App\Repository\CmsCopyRepository;
use App\Repository\CmsPhotoRepository;
use App\Repository\StaticTextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('user-templates/home.html.twig', [

            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePage1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePage2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePage3'
            ]),

            'Text1FR' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageFR1'
            ]),
            'Text2FR' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageFR2'
            ]),
            'Text3FR' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageFR3'
            ]),

            'Text1DE' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageDE1'
            ]),
            'Text2DE' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageDE2'
            ]),
            'Text3DE' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageDE3'
            ]),

            'Hyperlink' => $cmsCopyRepository->findOneBy([
                'name' => 'HomePageHyperlink'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage3'
            ]),

            'SpecialisingPhoto1' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising1'
            ]),
            'SpecialisingPhoto2' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising2'
            ]),
            'SpecialisingPhoto3' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising3'
            ]),


            'HomePage1Photo' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage1'
            ]),

            'LatestWorkPhoto1' => $cmsPhotoRepository->findOneBy([
                'name' => 'LatestWork1'
            ]),
            'LatestWorkPhoto2' => $cmsPhotoRepository->findOneBy([
                'name' => 'LatestWork2'
            ]),
            'LatestWorkPhoto3' => $cmsPhotoRepository->findOneBy([
                'name' => 'LatestWork3'
            ]),
            'LatestWorkPhoto4' => $cmsPhotoRepository->findOneBy([
                'name' => 'LatestWork4'
            ]),
        ]);
    }

    /**
     * @Route("/aboutSN", name="aboutSN", methods={"GET"})
     */
    public function aboutSN(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [

            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'SN1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'SN2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'SN3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'SN1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'SN2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'SN3'
            ]),

        ]);
    }

    /**
     * @Route("/PrivateEquity", name="private_equity", methods={"GET"})
     */
    public function privateEquity(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'PrivateEquity1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'PrivateEquity2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'PrivateEquity3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'PrivateEquity1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'PrivateEquity2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'PrivateEquity3'
            ]),
        ]);
    }

    /**
     * @Route("/webdesign", name="webdesign", methods={"GET"})
     */
    public function webDesign(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'WebDesign1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'WebDesign2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'WebDesign3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'WebDesign1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'WebDesign2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'WebDesign3'
            ]),
        ]);
    }

    /**
     * @Route("/Tennis", name="tennis", methods={"GET"})
     */
    public function tennis(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'Tennis1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'Tennis2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'Tennis3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'Tennis1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'Tennis2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'Tennis3'
            ]),
        ]);
    }

    /**
     * @Route("/Flying", name="flying", methods={"GET"})
     */
    public function flying(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'Flying1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'Flying2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'Flying3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'Flying1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'Flying2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'Flying3'
            ]),
        ]);
    }


    /**
     * @Route("/XVAConsulting", name="XVAConsulting", methods={"GET"})
     */
    public function xvaconsulting(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'RiskCapitalConsulting1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'RiskCapitalConsulting2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'RiskCapitalConsulting3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'RiskCapitalConsulting1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'RiskCapitalConsulting2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'RiskCapitalConsulting3'
            ]),
        ]);
    }

    /**
     * @Route("/cyprus", name="cyprus", methods={"GET"})
     */
    public function cyprus(CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/otherPages.twig', [
            'Text1' => $cmsCopyRepository->findOneBy([
                'name' => 'Cyprus1'
            ]),
            'Text2' => $cmsCopyRepository->findOneBy([
                'name' => 'Cyprus2'
            ]),
            'Text3' => $cmsCopyRepository->findOneBy([
                'name' => 'Cyprus3'
            ]),

            'Photo1' => $cmsPhotoRepository->findOneBy([
                'name' => 'Cyprus1'
            ]),
            'Photo2' => $cmsPhotoRepository->findOneBy([
                'name' => 'Cyprus2'
            ]),
            'Photo3' => $cmsPhotoRepository->findOneBy([
                'name' => 'Cyprus3'
            ]),
        ]);
    }

    /**
     * @Route("/homeaddress", name="/homeaddress", methods={"GET"})
     */
    public function homeAddress(StaticTextRepository $staticTextRepository, CmsCopyRepository $cmsCopyRepository, CmsPhotoRepository $cmsPhotoRepository): Response
    {
        return $this->render('home/homeaddress.html.twig', [
            'photos' => $cmsPhotoRepository->findAll(),
            'HomePage1Photo' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage1'
            ]),
            'Specialising1Photo' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising1'
            ]),
            'Specialising2Photo' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising2'
            ]),
            'Specialising3Photo' => $cmsPhotoRepository->findOneBy([
                'name' => 'Specialising3'
            ]),
            'WhyMePhoto' => $cmsPhotoRepository->findOneBy([
                'name' => 'WhyMe'
            ]),
            'HomePage1Text' => $cmsPhotoRepository->findOneBy([
                'name' => 'HomePage1'
            ]),
        ]);
    }


}
