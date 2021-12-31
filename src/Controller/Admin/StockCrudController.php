<?php

namespace App\Controller\Admin;

use App\Entity\Stock;
use App\Field\Price;
use App\Form\TransactionType;
use App\Repository\StockRepository;
use App\Service\IexCloud;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\EntityFactory;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FieldFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;

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
                ->onlyOnIndex(),
            CollectionField::new('transactions')
                ->setEntryType(TransactionType::class)
                ->setEntryIsComplex(true)
                ->setColumns(6)
                ->hideOnIndex(),
        ];
    }
}
