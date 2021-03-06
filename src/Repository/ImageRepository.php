<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Image>
 *
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function add(Image $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Image $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Image[] Returns an array of Image objects
     */
    public function findAllPublicWithThumbs(): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.public = :public')
            ->setParameter('public', true)
            ->andWhere('i.hasThumbs = :hasThumbs')
            ->setParameter('hasThumbs', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Image[] Returns an array of Image objects
     */
    public function findAllWithoutThumbs(): array
    {
        return $this->createQueryBuilder('i')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countAll(): int
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countPublic(): int
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->andWhere('i.public = :public')
            ->setParameter('public', true)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countMissingThumbs(): int
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->andWhere('i.hasThumbs = :hasThumbs')
            ->setParameter('hasThumbs', false)
            ->getQuery()
            ->getSingleScalarResult();
    }

//    /**
//     * @return Image[] Returns an array of Image objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Image
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
