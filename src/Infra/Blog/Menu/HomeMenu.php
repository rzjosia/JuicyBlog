<?php

declare(strict_types=1);

namespace App\Infra\Blog\Menu;

use App\Infra\Menu\LinksInterface;

class HomeMenu implements LinksInterface
{
    private const priority = 0;
    
    public function getLink(): array
    {
        return ['label' => 'Home', 'route' => 'home'];
    }
    
    public function getPriority(): int
    {
        return self::priority;
    }
}
