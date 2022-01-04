<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\StockRepository;
use App\Service\IexCloud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ReportController extends AbstractController
{
    #[Route('/report', name: 'holding')]
    public function index(
        ChartBuilderInterface $chartBuilder,
        StockRepository $stockRepository,
        IexCloud $iexCloud
    ): Response {
        $holdings = $stockRepository->findAll();

        $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chart->setData([
            'labels' => array_map(fn($holding) => $holding->getName(), $holdings),
            'datasets' => [
                [
                    'label' => 'Holdings',
                    'data' => array_map(fn($holding) => array_sum(
                        $holding->getTransactions()
                            ->map(fn(Transaction $transaction) => $transaction
                                ->getOrderType() == 0 ? $transaction->getAmount() : 0)->toArray()
                    ) * $iexCloud->getPrice($holding->getPrice()), $holdings),
                    'backgroundColor' => array_map(fn($holding) => $holding->getColor(), $holdings),
                ],
            ]
        ]);

        $chart->setOptions([
            'title' => [
                'display' => true,
                'text' => 'Holdings',
                'position' => 'bottom',
            ],
            'legend' => [
                'display' => true,
                'position' => 'bottom',
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ]);

        return $this->render('report/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
