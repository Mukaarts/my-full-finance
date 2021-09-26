<?php

namespace App\Controller\Admin;

use App\Entity\Wallet;
use App\Form\TransactionType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WalletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wallet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')->setColumns(8),
            ChoiceField::new('category')
                ->setColumns(4)
                ->setChoices([
                    'Giro' => 0,
                    'Spar' => 1,
                    'Cash' => 2
                ]),
            TextareaField::new('description')
                ->setColumns(12)
                ->hideOnIndex(),
            CollectionField::new('transactions')
                ->setEntryType(TransactionType::class)
                ->setColumns(12)
                ->hideOnIndex()
        ];
    }
}
