<?php

namespace App\Controller;

use App\Entity\CurriculumVitae;
use App\Form\CurriculumVitaeType;
use App\Repository\CurriculumVitaeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/curriculum/vitae")
 */
class CurriculumVitaeController extends AbstractController
{
    /**
     * @Route("/", name="curriculum_vitae_index", methods={"GET"})
     */
    public function index(CurriculumVitaeRepository $curriculumVitaeRepository): Response
    {
        return $this->render('curriculum_vitae/index.html.twig', [
            'curriculum_vitaes' => $curriculumVitaeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="curriculum_vitae_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $curriculumVitae = new CurriculumVitae();
        $form = $this->createForm(CurriculumVitaeType::class, $curriculumVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($curriculumVitae);
            $entityManager->flush();

            return $this->redirectToRoute('curriculum_vitae_index');
        }

        return $this->render('curriculum_vitae/new.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="curriculum_vitae_show", methods={"GET"})
     */
    public function show(CurriculumVitae $curriculumVitae): Response
    {
        return $this->render('curriculum_vitae/show.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="curriculum_vitae_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CurriculumVitae $curriculumVitae): Response
    {
        $form = $this->createForm(CurriculumVitaeType::class, $curriculumVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('curriculum_vitae_index');
        }

        return $this->render('curriculum_vitae/edit.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="curriculum_vitae_delete", methods={"POST"})
     */
    public function delete(Request $request, CurriculumVitae $curriculumVitae): Response
    {
        if ($this->isCsrfTokenValid('delete'.$curriculumVitae->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($curriculumVitae);
            $entityManager->flush();
        }

        return $this->redirectToRoute('curriculum_vitae_index');
    }
}
