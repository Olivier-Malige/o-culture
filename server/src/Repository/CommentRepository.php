<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /*
    * @param integer $currentPage
    *
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminComments($currentPage = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

//    /**
//     * @return Comment[] Returns an array of Comment objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
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
