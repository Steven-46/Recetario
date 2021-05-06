<?php

namespace App\Repository;

use App\Entity\Recetas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recetas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recetas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recetas[]    findAll()
 * @method Recetas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recetas::class);
    }

    public function BuscarTodasLasRecetas()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r.id, r.receta, r.ingredientes, r.preparacion, r.categoria, r.imagen, u.nombre
            From App:Recetas r
            JOIN r.user u');
    }
    public function EditarReceta($id, $receta, $ingredientes, $preparacion, $categoria)
    {
        return $this->getEntityManager()
            ->createQuery('UPDATE recetas SET r.receta = $receta, r.ingredientes = $ingredientes, r.preparacion
                 = $preparacion, r.categoria = $categoria where id =$id');
    }

    // /**
    //  * @return Recetas[] Returns an array of Recetas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recetas
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
