<?php

namespace App\Controller\Admin;

use App\Entity\Transaction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class TransactionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transaction::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('stock'),
            AssociationField::new('wallet'),
            AssociationField::new('depot'),
            ChoiceField::new('orderType')->setChoices([
                'buy' => 0,
                'sell' => 1
            ]),
            DateTimeField::new('dateAt'),
            NumberField::new('amount'),
            NumberField::new('price'),
            NumberField::new('fee'),
        ];
    }
}
