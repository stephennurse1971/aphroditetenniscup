<?php

namespace App\Controller;

use App\Entity\MarketData;
use App\Entity\MarketDataHistory;
use App\Form\MarketDataHistoryType;
use App\Repository\MarketDataHistoryRepository;
use App\Repository\MarketDataRepository;
use App\Services\MarketDataPrice;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/market_data_history")
 */
class MarketDataHistoryController extends AbstractController
{
    /**
     * @Route("/index/{subset}", name="market_data_history_index", methods={"GET"})
     */
    public function index(Request $request, $subset, MarketDataHistoryRepository $marketDataHistoryRepository, MarketDataRepository $marketDataRepository, MarketDataPrice $marketDataPrice): Response
    {
        $securities = [];
        if ($subset == 'Active') {
            $marketData = $marketDataRepository->findBy([
                'isActive' => '1']);
        }

        elseif
            ($subset == 'Sold') {
            $marketData = $marketDataRepository->findBy([
                'isActive' => '0']);
        }
        elseif
            ($subset == 'All'){
            $marketData = $marketDataRepository->findAll();
        }


        foreach ($marketData as $relevantInvestment) {
            if ($relevantInvestment->getAssetClass()->getTaxScheme()->getShowSharePrices() == 1) {
                $securities[] = $relevantInvestment;
            }
        }
        $marketDataHistory = $marketDataHistoryRepository->findAll();
        $today = new \DateTime('now');
        $dates = [];
        $start_date = new \DateTime('now');
        $end_date = new \DateTime('now');
        $end_date->modify("-5 years");
        while ($end_date <= $start_date) {
            $dates[] = new \DateTime($end_date->format('Y-m-d'));
            $end_date->modify("+1 month");
        }
        return $this->render('market_data_history/index.html.twig', [
            'dates' => $dates,
            'securities' => $securities,
            'market_data_histories' => $marketDataHistory,
            'today' => $today,
            'subset' => $subset
        ]);
    }

    /**
     * @Route("/new/{securitiesID}/{date}", name="market_data_history_new", methods={"GET", "POST"},defaults={"securitiesID"=null,"date"=null})
     */
    public function new($securitiesID, $date, Request $request, MarketDataRepository $marketDataRepository, MarketDataHistoryRepository $marketDataHistoryRepository): Response
    {
        $marketDataHistory = new MarketDataHistory();
        if ($securitiesID != null && $date != null) {
            $form = $this->createForm(MarketDataHistoryType::class, $marketDataHistory, ['security' => $marketDataRepository->find($securitiesID), 'securities' => $marketDataRepository->findBy(['id' => $securitiesID]), 'date' => $date, 'mode' => 'new']);
        } else {
            $form = $this->createForm(MarketDataHistoryType::class, $marketDataHistory);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marketDataHistoryRepository->add($marketDataHistory);
            return $this->redirectToRoute('market_data_history_index', ['subset'=>'All'], Response::HTTP_SEE_OTHER);
        }

        return $this->render('market_data_history/new.html.twig', [
            'market_data_history' => $marketDataHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="market_data_history_show", methods={"GET"})
     */
    public function show(MarketDataHistory $marketDataHistory): Response
    {
        return $this->render('market_data_history/show.html.twig', [
            'market_data_history' => $marketDataHistory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="market_data_history_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MarketDataHistory $marketDataHistory, MarketDataHistoryRepository $marketDataHistoryRepository): Response
    {
        $form = $this->createForm(MarketDataHistoryType::class, $marketDataHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marketDataHistoryRepository->add($marketDataHistory);
            return $this->redirectToRoute('market_data_history_index', ['subset'=>'All'], Response::HTTP_SEE_OTHER);
        }

        return $this->render('market_data_history/edit.html.twig', [
            'market_data_history' => $marketDataHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="market_data_history_delete", methods={"POST"})
     */
    public function delete(Request $request, MarketDataHistory $marketDataHistory, MarketDataHistoryRepository $marketDataHistoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $marketDataHistory->getId(), $request->request->get('_token'))) {
            $marketDataHistoryRepository->remove($marketDataHistory);
        }

        return $this->redirectToRoute('market_data_history_index', ['subset'=>'All'], Response::HTTP_SEE_OTHER);
    }
}
