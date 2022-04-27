<?php

declare(strict_types=1);

namespace App\Infra\Blog\Controller;

use App\Domain\Blog\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/articles')]
class Articles
{
    public function __construct(private Environment $twig)
    {
    }

    public function __invoke(): Response
    {
        $today = new \DateTime();
        $articles = [
            new Article(
                "Alaphilippe, scandale",
                "Sport.fr",
                $today,
                "J'étais pas content alors j'ai freiné",
            ),
            new Article(
                "Arnaud, pris en flagrant délit",
                "Anonyme",
                $today,
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            ),
        ];
        return new Response($this->twig->render('blog/articles.html.twig', ['articles' => $articles]));
    }
}