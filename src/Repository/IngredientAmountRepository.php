<?php

namespace App\Repository;

use App\Entity\IngredientAmount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IngredientAmount|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientAmount|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientAmount[]    findAll()
 * @method IngredientAmount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientAmountRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IngredientAmount::class);
    }

//    /**
//     * @return IngredientAmount[] Returns an array of IngredientAmount objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientAmount
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
