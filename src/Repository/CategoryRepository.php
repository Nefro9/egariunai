<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Category|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAllOrder()
    {

        $qb = $this->createQueryBuilder('c')
                    ->select('c as item')
                    ->addSelect('COALESCE(IDENTITY(c.parent), c.id) as columnOrder')
                    ->orderBy('columnOrder', 'ASC')
                    ->addOrderBy('c.order', 'ASC')
                    ->groupBy('c');

        $query = $qb->getQuery();

        dump($query);
        $result = $query->getResult();

        return $result;
    }
}
