<?php

namespace App\Controller\Admin;

use App\Entity\Stock;
use App\Form\TransactionType;
use App\Service\IexCloud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StockCrudController extends AbstractCrudController
{
    private IexCloud $iexCloud;

    public function __construct(IexCloud $iexCloud)
    {
        $this->iexCloud = $iexCloud;
    }

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
            TextField::new('price', 'Price')
                ->formatValue(function ($value, $entity) {
                    return $this->iexCloud->getPrice($entity->getPrice());
                })
                ->hideOnForm(),
            CollectionField::new('transactions')
                ->setEntryType(TransactionType::class)
                ->setEntryIsComplex(true)
                ->setColumns(6)
                ->hideOnIndex(),
        ];
    }
}
