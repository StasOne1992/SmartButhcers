<?php

namespace App\Repository;

use App\Entity\ProductionRecipeContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionRecipeContent>
 *
 * @method ProductionRecipeContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionRecipeContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionRecipeContent[]    findAll()
 * @method ProductionRecipeContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionRecipeContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionRecipeContent::class);
    }

    public function save(ProductionRecipeContent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductionRecipeContent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProductionRecipeContent[] Returns an array of ProductionRecipeContent objects
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

//    public function findOneBySomeField($value): ?ProductionRecipeContent
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
