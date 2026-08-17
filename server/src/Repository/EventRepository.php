<?php

namespace App\Repository;

use DateTime;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

//    /**
//     * @return Event[] Returns an array of Event objects
//     */
    
    public function findByCity($value)
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->leftJoin('e.eventPlace' , 'p')
            // ->addSelect('p')
            ->andWhere('p.city = :val')
            ->setParameter('val',$value)
            // ->orderBy('e.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByZipCode($value)
    {
        return $this->createQueryBuilder('e')
        ->select('e')
        ->leftJoin('e.eventPlace' , 'p')
        ->andWhere('p.zipcode LIKE :val')
        ->setParameter('val',$value.'%')
        ->getQuery()
        ->getResult()
        ;
    }

    public function findByArtist($value)
    {
        return $this->createQueryBuilder('e')
        ->select('e')
        ->leftJoin('e.AppUserPerformer' , 'a')
        ->andWhere('a.id LIKE :val')
        ->setParameter('val',$value.'%')
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function findByType($value)
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->leftJoin('e.eventType' , 'et')
            ->andWhere('et.name LIKE :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByName($searchData)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT e
            FROM App\Entity\Event e
            WHERE e.name LIKE :data"
        )->setParameter('data', '%'.$searchData.'%');

        return $query->execute();
    }

    public function findByDate($searchData)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT e
            FROM App\Entity\Event e
            WHERE e.plannedDate LIKE :data"
        )->setParameter('data', '%'.$searchData.'%');

        return $query->execute();
    }

    
    public function findEventsByCurrentDate()
    {
        return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.plannedDate >= :date')
        ->setParameter('date', new DateTime('NOW'))
        ->getQuery()
        ->getResult()
        ;
    }

    /*
    * @param integer $currentPage
    *
    * @return \Doctrine\ORM\Tools\Pagination\Paginator
    */
    public function getAllAdminEvents($currentPage = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage);

        return $paginator;
    }

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
