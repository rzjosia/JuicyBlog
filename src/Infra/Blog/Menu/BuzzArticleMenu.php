<?php

declare(strict_types=1);

namespace App\Infra\Blog\Menu;

use App\Infra\Menu\LinksInterface;

class BuzzArticleMenu implements LinksInterface
{
    private const priority = 1;
    
    public function getLink(): array
    {
        return [
            'label' => 'Qui a fait le buzz ?',
            'route' => 'article',
            'parameters' => [
                'slug' => 'Test-Logitech-Lift-une-souris-ergonomique-verticale-pour-plus-de-confort-en-bureautique',
            ]
        ];
    }
    
    public function getPriority(): int
    {
        return self::priority;
    }
}
