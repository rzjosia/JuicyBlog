<?php

declare(strict_types=1);

namespace App\Infra\Blog\Controller;

use App\Domain\Blog\ArticleDataSource\ArticleDataSource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/article/{slug}', 'article')]
class Article
{
    public function __invoke(Environment $twig, string $slug, ArticleDataSource $articleDataSource): Response
    {
        $article = $articleDataSource->getArticle($slug);

        if (!$article) {
            throw new NotFoundHttpException("Article not found for slug: $slug");
        }

        return new Response($twig->render('blog/article.html.twig', compact('article')));
    }
}