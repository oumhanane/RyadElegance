<?php

namespace App\Repository;

use App\Entity\ListProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListProduct>
 *
 * @method ListProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListProduct[]    findAll()
 * @method ListProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListProduct::class);
    }

//    /**
//     * @return ListProduct[] Returns an array of ListProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListProduct
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
