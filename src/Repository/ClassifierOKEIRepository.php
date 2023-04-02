<?php

namespace App\Repository;

use App\Entity\ClassifierOKEI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassifierOKEI>
 *
 * @method ClassifierOKEI|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassifierOKEI|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassifierOKEI[]    findAll()
 * @method ClassifierOKEI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassifierOKEIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassifierOKEI::class);
    }

    public function save(ClassifierOKEI $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ClassifierOKEI $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ClassifierOKEI[] Returns an array of ClassifierOKEI objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClassifierOKEI
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
