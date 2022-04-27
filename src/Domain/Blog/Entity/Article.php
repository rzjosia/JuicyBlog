<?php

declare(strict_types=1);

namespace App\Domain\Blog\Entity;

use DateTime;

class Article
{
    public function __construct(
        public string   $titre,
        public string   $auteur,
        public DateTime $datePublication,
        public string   $contenu,
    )
    {
    }
}