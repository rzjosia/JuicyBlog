<?php

declare(strict_types=1);

namespace App\Domain\Blog\Repository;

use App\Domain\Blog\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }
    
    public function persist(Article $article): void
    {
        $this->_em->persist($article);
    }
    
    public function flush(): void
    {
        $this->_em->flush();
    }
}