<?php

namespace App\Controller\Admin;

use App\Entity\CryptoWallet;
use App\Entity\Depot;
use App\Entity\Dividend;
use App\Entity\Stock;
use App\Entity\Transaction;
use App\Entity\Wallet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'dash')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Full Finance');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Wallets', 'fas fa-list', Wallet::class);
        yield MenuItem::linkToCrud('Depots', 'fas fa-list', Depot::class);
        yield MenuItem::linkToCrud('Crypto Wallets', 'fas fa-list', CryptoWallet::class);

        yield MenuItem::section('Depot');
        yield MenuItem::linkToCrud('Stocks', 'fas fa-list', Stock::class);
        yield MenuItem::linkToCrud(
            'Transactions',
            'fas fa-list',
            Transaction::class
        );
        yield MenuItem::linkToCrud('Dividends', 'fas fa-list', Dividend::class);
    }
}
