<?php

namespace App\Repository;

use App\Entity\AppUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method AppUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppUser[]    findAll()
 * @method AppUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppUser::class);
    }
       
    public function findByEmail($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.email = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByUsername($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.username = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByStatus($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.status = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByName($searchData)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT a.id, a.name
            FROM App\Entity\AppUser a
            WHERE a.status = 2
            AND a.name LIKE :data"
        )->setParameter('data', '%'.$searchData.'%');

        return $query->execute();
    }

    /*
    * @param integer $currentPage
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminAppUsers($currentPage = 1)
    {
        $query = $this->createQueryBuilder('a')
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

    /*
    * @param integer $currentPage
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminSpectators($currentPage = 1)
    {
        $value = 28;

        $query = $this->createQueryBuilder('a')
            ->andWhere('a.role = :val')
            ->setParameter('val', $value)
            ->getQuery();
        
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

    /*
    * @param integer $currentPage
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminArtists($currentPage = 1)
    {
        $value = 29;

        $query = $this->createQueryBuilder('a')
            ->andWhere('a.role = :val')
            ->setParameter('val', $value)
            ->getQuery();
        
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }
    /*
    * @param integer $currentPage
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminOrganizers($currentPage = 1)
    {
        $value = 30;

        $query = $this->createQueryBuilder('a')
            ->andWhere('a.role = :val')
            ->setParameter('val', $value)
            ->getQuery();
        
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }


    /*
    public function findOneBySomeField($value): ?AppUser
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
