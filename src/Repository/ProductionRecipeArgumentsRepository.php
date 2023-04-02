<?php

namespace App\Repository;

use App\Entity\ProductionRecipeArguments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionRecipeArguments>
 *
 * @method ProductionRecipeArguments|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionRecipeArguments|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionRecipeArguments[]    findAll()
 * @method ProductionRecipeArguments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionRecipeArgumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionRecipeArguments::class);
    }

    public function save(ProductionRecipeArguments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductionRecipeArguments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProductionRecipeArguments[] Returns an array of ProductionRecipeArguments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductionRecipeArguments
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
