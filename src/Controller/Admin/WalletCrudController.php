<?php

namespace App\Controller\Admin;

use App\Entity\Wallet;
use App\Form\TransactionType;
use App\Repository\WalletRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

class WalletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wallet::class;
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.title = :title')->setParameter('title', 'bcee');
        return $response;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')->setColumns(8),
            ChoiceField::new('category')
                ->setColumns(4)
                ->setChoices(Wallet::WALLETTYPS),
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
