<?php

declare(strict_types=1);

namespace App\Infra\Admin\Controller;

use App\Domain\Blog\Entity\Article;
use App\Domain\Blog\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: "/admin/articles", name: "admin_articles")]
class CreateArticle extends AbstractController
{
    private \DateTime $datePublication;

    public function __construct(private Environment $twig, private RequestStack $requestStack, private ArticleRepository $articleRepository)
    {
        $this->datePublication = new \DateTime();
    }
    
    #[Route(path: "/create", name: "admin_create_article")]
    public function create(): Response
    {
        $article = new Article();
        $formBuilder = $this->createFormBuilder($article);

        $formBuilder
            ->add('titre', TextType::class)
            ->add('auteur', TextType::class)
            ->add('contenu', TextareaType::class)
            ->add('creer', SubmitType::class, ['label' => 'Créer']);

        $form = $formBuilder->getForm();
        
        $request = $this->requestStack->getCurrentRequest();
        $form->handleRequest($request);
        
        // Déclencher l'enregistrement
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setDatePublication($this->datePublication);
            $this->articleRepository->persist($article);
            $this->articleRepository->flush();
        }
        
        $formView = $form->createView();
        $title = "J'écris article";

        return new Response($this->twig->render('admin/create.html.twig', compact('formView', 'title')));
    }
}