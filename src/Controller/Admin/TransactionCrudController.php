<?php

namespace App\Controller\Admin;

use App\Entity\Transaction;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TransactionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transaction::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('stock')->setColumns(6),
            ChoiceField::new('orderType')->setChoices([
                'buy' => 0,
                'sell' => 1,
                'dividend' => 2
            ])->setColumns(3),
            DateField::new('dateAt')->setColumns(3),
            AssociationField::new('wallet', 'Cash Wallet')->setColumns(6),
            AssociationField::new('depot', 'Depot')->setColumns(6),
            NumberField::new('amount')->setColumns(4),
            NumberField::new('price')->setColumns(4),
            NumberField::new('fee')->setColumns(4),
            TextField::new('fullPrice')->onlyOnIndex(),
        ];
    }
}
