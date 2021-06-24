<?php

namespace App\Controller;

use App\Entity\TennisCourtPreferences;
use App\Entity\TennisPlayerAvailability;
use App\Form\TennisCourtPreferencesType;
use App\Repository\TennisCourtPreferencesRepository;
use App\Repository\TennisVenuesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tennis/court/preferences")
 */
class TennisCourtPreferencesController extends AbstractController
{
    /**
     * @Route("/", name="tennis_court_preferences_index", methods={"GET"})
     */
    public function index(TennisCourtPreferencesRepository $tennisCourtPreferencesRepository, TennisVenuesRepository $tennisVenuesRepository, UserRepository $userRepository): Response
    {
        return $this->render('tennis_court_preferences/index.html.twig', [
            'tennis_court_preferences' => $tennisCourtPreferencesRepository->findAll(),
            'venues' => $tennisVenuesRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="tennis_court_preferences_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tennisCourtPreference = new TennisCourtPreferences();
        $form = $this->createForm(TennisCourtPreferencesType::class, $tennisCourtPreference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tennisCourtPreference);
            $entityManager->flush();

            return $this->redirectToRoute('tennis_court_preferences_index');
        }

        return $this->render('tennis_court_preferences/new.html.twig', [
            'tennis_court_preference' => $tennisCourtPreference,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tennis_court_preferences_show", methods={"GET"})
     */
    public function show(TennisCourtPreferences $tennisCourtPreference): Response
    {
        return $this->render('tennis_court_preferences/show.html.twig', [
            'tennis_court_preference' => $tennisCourtPreference,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tennis_court_preferences_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TennisCourtPreferences $tennisCourtPreference): Response
    {
        $form = $this->createForm(TennisCourtPreferencesType::class, $tennisCourtPreference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tennis_court_preferences_index');
        }

        return $this->render('tennis_court_preferences/edit.html.twig', [
            'tennis_court_preference' => $tennisCourtPreference,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tennis_court_preferences_delete", methods={"POST"})
     */
    public function delete(Request $request, TennisCourtPreferences $tennisCourtPreference): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tennisCourtPreference->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tennisCourtPreference);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tennis_court_preferences_index');
    }


    /**
     * @Route("/{userid}/{venueid}/tenniscourtpreferences/edit", name="tennis_court_preferences_edit", methods={"GET","POST"})
     */
    public function editCourtPreferences(int $userid, int $venueid, Request $request, UserRepository $userRepository,
                                         TennisVenuesRepository $tennisVenuesRepository,
                                         TennisCourtPreferencesRepository $tennisCourtPreferencesRepository,
                                         EntityManagerInterface $entityManager): Response
    {
        $weekdayWeekend = $request->query->get('weekdayWeekend');
        $tennisCourtPreferences = $tennisCourtPreferencesRepository->findOneBy([
            'user' => $userid,
            'tennisVenue' => $venueid
        ]);
        if ($tennisCourtPreferences) {
            if ($weekdayWeekend == "Weekday") {
                if ($tennisCourtPreferences->getWeekdayElection() == 1) {
                    $tennisCourtPreferences->setWeekdayElection(0);
                } else {
                    $tennisCourtPreferences->setWeekdayElection(1);
                }
            }
            if ($weekdayWeekend == "Weekend") {
                if ($tennisCourtPreferences->getWeekendElection() == 1) {
                    $tennisCourtPreferences->setWeekendElection(0);
                } else {
                    $tennisCourtPreferences->setWeekendElection(1);
                }
            }
            $this->getDoctrine()->getManager()->flush();
        }

        else{
            $tennisCourtPreferences=new TennisCourtPreferences();
            $user= $userRepository->find($userid);
            $venue = $tennisVenuesRepository->find($venueid);
            $tennisCourtPreferences->setUser($user)->setTennisVenue($venue)->setWeekdayElection(1);
            $entityManager->persist($tennisCourtPreferences);
            $entityManager->flush();

        }
        $referer = $request->server->get('HTTP_REFERER');
        return $this->redirect($referer);

    }


}
