<?php

namespace App\Controller\Admin;

use App\Entity\Dividend;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class DividendCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dividend::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('stock')
        ];
    }
}
