<?php

namespace App\Repository;

use App\Entity\ProductionRecipeStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionRecipeStructure>
 *
 * @method ProductionRecipeStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionRecipeStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionRecipeStructure[]    findAll()
 * @method ProductionRecipeStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionRecipeStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionRecipeStructure::class);
    }

    public function save(ProductionRecipeStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductionRecipeStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProductionRecipeStructure[] Returns an array of ProductionRecipeStructure objects
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

//    public function findOneBySomeField($value): ?ProductionRecipeStructure
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
