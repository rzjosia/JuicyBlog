<?php

declare(strict_types=1);

namespace App\Infra\Blog\Menu;

use App\Infra\Menu\LinksInterface;

class ArticleMenu implements LinksInterface
{
    private const priority = 0;
    
    private const menuItems = [
        ['label' => 'Home', 'route' => 'home']
    ];
    
    public function getLinks(): iterable
    {
        foreach (self::menuItems as $item) {
            yield $item;
        }
    }
    
    public function getPriority(): int
    {
        return self::priority;
    }
}
