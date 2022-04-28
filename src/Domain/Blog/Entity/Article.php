<?php

declare(strict_types=1);

namespace App\Domain\Blog\Entity;

use App\Domain\Blog\Repository\ArticleRepository;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\Length;

#[Entity(repositoryClass: ArticleRepository::class)]
#[UniqueEntity('slug')]
class Article
{
    #[Id]
    #[Column]
    public string $slug;
    
    #[Column]
    #[Length(min: 3)]
    public string $titre;
    
    #[Column]
    public string $auteur;
    
    #[Column(type: 'datetime')]
    public DateTime $datePublication;
    
    #[Column]
    public string $contenu;
    
    /**
     * @param DateTime $datePublication
     */
    public function setDatePublication(DateTime $datePublication): void
    {
        $this->datePublication = $datePublication;
    }
    
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
        $this->slug = (new AsciiSlugger())->slug($titre)->toString();
    }

    public function getTitre(): string
    {
        return $this->titre;
    }
}