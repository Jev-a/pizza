<?php

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Order $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Order $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param string $orderNr
     * @return array
     */
    public function getOrder(string $orderNr): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.orderNr, o.queue, p.name, i.title, i.price')
            ->Join('App\Entity\Ingredient', 'i', 'WITH', 'o.ingredientId = i.id')
            ->Join('App\Entity\Pizza', 'p', 'WITH', 'o.pizzaId = p.id')
            ->andWhere('o.orderNr = :val')
            ->setParameter('val', $orderNr)
            ->orderBy('o.orderNr')
            ->getQuery()
            ->getResult();
    }


    /**
     * @return null|Order
     */
    public function getLastOrder(): ?Order
    {
        return $this->findOneBy([], ['id' => Criteria::DESC]);
    }

}
