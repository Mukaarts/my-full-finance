<?php

namespace App\Controller\Admin;

use App\Entity\Transaction;
use App\Service\IexCloud;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TransactionCrudController extends AbstractCrudController
{
    private IexCloud $iexCloud;

    public function __construct(IexCloud $iexCloud)
    {
        $this->iexCloud = $iexCloud;
    }

    public static function getEntityFqcn(): string
    {
        return Transaction::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-plus');
            });
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
            TextField::new('stock.price', 'Current Price')
                ->onlyOnIndex()
                ->formatValue(function ($value, $entity) {
                    return $this->iexCloud->getPrice($entity->getStock()->getTicker()) * $entity->getAmount();
                }),

        ];
    }
}
