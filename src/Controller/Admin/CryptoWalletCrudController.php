<?php

namespace App\Controller\Admin;

use App\Entity\CryptoWallet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CryptoWalletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CryptoWallet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
        ];
    }
}
