<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\PostTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct($registry, Post::class);
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('p')
            ->select('p','t')
            ->innerJoin('p.translations', 't')
            ->where('p.publishedAt <= :now')
            ->orderBy('p.publishedAt', 'DESC')
            ->setParameter('now', new \DateTime())
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySlug($slug): ?Post
    {
        //https://stackoverflow.com/questions/6637506/doing-a-where-in-subquery-in-doctrine-2

        $expr = $this->entityManager->getExpressionBuilder();
        $qb = $this->entityManager->createQueryBuilder();

        $post = $this->createQueryBuilder('p')
            ->select('p', 't')
            ->innerJoin('p.translations', 't')
            ->where(
                $expr->in(
                    'p.id',
                    $qb->select('p1.id')
                        ->from('App\Entity\Post', 'p1')
                        ->join('p1.translations', 't1')
                        ->andWhere('t1.slug = :slug')
                    ->getDQL()
                )
            )
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();

        return $post;
    }


    /*
    public function findOneBySlug($slug): ?Post
    {
        //#locale: "en"
        //#translatable: Proxies\__CG__\App\Entity\Post {#9547 ▼

        $qb = $this->entityManager->createQueryBuilder();
        $result = $qb->select('t')
            ->from('App\Entity\PostTranslation', 't')
            ->andWhere('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();

            //->getDQL();

        dump( $result );






        $post = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin('p.translations', 't')
            ->andWhere('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();

        if ($post != null){
            $id = $post->getId();

            $post = $this->createQueryBuilder('p')
                ->select('p','t')
                ->innerJoin('p.translations', 't')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        }

        return $post;
    }
    */


    /*
    public function findOneBySlug($slug): ?Post
    {
        $post = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin('p.translations', 't')
            ->andWhere('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();

        if ($post != null){
            $id = $post->getId();

            $post = $this->createQueryBuilder('p')
                ->select('p','t')
                ->innerJoin('p.translations', 't')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        }

        return $post;
    }
    */

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

        return $this->createQueryBuilder('p')
            ->select('p','t')
            ->leftJoin('p.translations', 't', 'WITH', 't.locale = :locale')
            ->where('p.publishedAt <= :now')
            ->orderBy('p.publishedAt', 'DESC')
            ->setParameter('now', new \DateTime())
            ->setParameter('locale', $locale)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        return $this->createQueryBuilder('p')
            ->select('p','t')
            ->innerJoin('p.translations', 't')
            ->andWhere('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
