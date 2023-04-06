<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Utilisateur>
 *
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function save(Utilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Utilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getCadurciens(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u FROM App\Entity\Utilisateur u WHERE u.ville = :laVille");
        $query->setParameter(":laVille", 'Cahors');
        $laListe = $query->getResult();
        return $laListe;
    }
       
    public function getAvecFrais() {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u.nom, u.prenom, SUM(f.montantValide) AS total FROM App\Entity\Fichefrais f JOIN App\Entity\Utilisateur u 
        WITH f.idUtilisateur = u.id GROUP BY u.id");
        return $query->getResult();
    }

    public function getSansFrais(){
        //SELECT * FROM `utilisateur`
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();
        $query->select("u.nom, u.prenom, COUNT(u2.id) AS count")
            ->from("App\Entity\Utilisateur"," u")
            ->leftJoin('App\Entity\Fichefrais','u2',  \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = u2.idUtilisateur')
            ->groupBy("u.id")
            ->orderBy("u.nom")
            ->where("u2.id is null");
        $laListe = $query->getQuery()->getResult();
        return $laListe;
    }

    public function getNbFrais(){
        //SELECT * FROM `utilisateur`
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();
        $query->select("u.nom, COUNT(u2.id) AS count")
            ->from("App\Entity\Utilisateur"," u")
            ->leftJoin('App\Entity\Fichefrais','u2',  \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = u2.idUtilisateur')
            ->groupBy("u.id")
            ->orderBy("u.nom");
        $laListe = $query->getQuery()->getResult();
        return $laListe;
    }

//    /**
//     * @return Utilisateur[] Returns an array of Utilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Utilisateur
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
