<?php

namespace App\Controller\Admin;

use App\Entity\Depot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DepotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Depot::class;
    }
}
