<?php

namespace App\Repository;

use App\Entity\ArtistType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method ArtistType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistType[]    findAll()
 * @method ArtistType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtistType::class);
    }

    /*
    * @param integer $currentPage
    *
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminArtistTypes($currentPage = 1)
    {
        $query = $this->createQueryBuilder('at')
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

//    /**
//     * @return ArtistType[] Returns an array of ArtistType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArtistType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * Paginator Helper
    *
    * Pass through a query object, current page & limit
    * the offset is calculated from the page and limit
    * returns an `Paginator` instance, which you can call the following on:
    *
    *     $paginator->getIterator()->count() # Total fetched (ie: `5` posts)
    *     $paginator->count() # Count of ALL posts (ie: `20` posts)
    *     $paginator->getIterator() # ArrayIterator
    *
    * @param Doctrine\ORM\Query $dql   DQL Query Object
    * @param integer            $page  Current page (defaults to 1)
    * @param integer            $limit The total number per page (defaults to 5)
    *
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function paginate($dql, $page = 1, $limit = 10)
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }
}
