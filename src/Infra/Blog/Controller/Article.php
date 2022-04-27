<?php

declare(strict_types=1);

namespace App\Infra\Blog\Controller;

use App\Domain\Blog\Entity\Article as ArticleModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/article/{slug}', 'article')]
class Article
{
    public function __invoke(Environment $twig, string $slug): Response
    {
        $today = new \DateTime();
        $article = new ArticleModel(
            $slug,
            "Anonyme",
            $today,
            "En cours d'écriture"
        );
        return new Response($twig->render('blog/article.html.twig', compact('article')));
    }
}