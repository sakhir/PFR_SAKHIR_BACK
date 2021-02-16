<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findByProfil($value)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.profil', 'p')
            ->andWhere('p.libelle = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    

    public function findDeleted()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.isdeleted = :val')
            ->setParameter('val', '1')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findUsersActif()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.isdeleted = :val')
            ->setParameter('val', '0')
            ->orderBy('u.prenom', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //recupere un user en fonction de son profil et de son id
    public function findOneById($value,$id): ?User
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.profil', 'profil')
            ->andWhere('profil.libelle = :val')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    } 


    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
