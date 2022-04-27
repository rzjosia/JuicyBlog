<?php

declare(strict_types=1);

namespace App\Infra\Blog\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/', "home")]
class Home
{
    public function __invoke(Environment $twig): Response
    {
        return new Response($twig->render('blog/home.html.twig'));
    }
}