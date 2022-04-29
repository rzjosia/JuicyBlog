<?php

declare(strict_types=1);

namespace App\Infra\Blog\Controller;

use App\Domain\Blog\ArticleDataSource\ArticleDataSource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: '/articles', name: 'articles')]
class Articles
{
    public function __construct(private Environment $twig, private ArticleDataSource $articleDataSource)
    {
    }

    public function __invoke(): Response
    {
        $articles = $this->articleDataSource->getAll();
        return new Response($this->twig->render('blog/articles.html.twig', ['articles' => $articles]));
    }
}