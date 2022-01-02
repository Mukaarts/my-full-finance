<?php

namespace App\Controller\Admin;

use App\Entity\Depot;
use App\Entity\Stock;
use App\Entity\Transaction;
use App\Entity\Wallet;
use App\Repository\TransactionRepository;
use App\Service\IexCloud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    #[Route('/', name: 'dash')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_dividends' => $this->getDoctrine()->getRepository(Transaction::class)->getFullDividend(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Full Finance');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Securities');
        yield MenuItem::linkToCrud('Stocks', 'fas fa-list', Stock::class);

        yield MenuItem::section('Accounts');
        yield MenuItem::linkToCrud('Wallets', 'fas fa-list', Wallet::class);
        yield MenuItem::linkToCrud('Depots', 'fas fa-list', Depot::class);

        yield MenuItem::section('Reports');
        yield MenuItem::linkToCrud(
            'Transactions',
            'fas fa-list',
            Transaction::class
        );

        yield MenuItem::section('Settings');
    }
}
