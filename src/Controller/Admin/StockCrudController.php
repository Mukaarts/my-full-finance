<?php

namespace App\Controller\Admin;

use App\Entity\Stock;
use App\Form\TransactionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class StockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setColumns(7),
            TextField::new('ticker')->setColumns(4),
            ColorField::new('color')->setColumns(1),
            CollectionField::new('transactions')
                ->setEntryType(TransactionType::class)
                ->setEntryIsComplex(true)
                ->setColumns(6)
        ];
    }
}
