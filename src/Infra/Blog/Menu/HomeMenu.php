<?php

declare(strict_types=1);

namespace App\Infra\Blog\Menu;

use App\Infra\Menu\LinksInterface;

class HomeMenu implements LinksInterface
{
    private const PRIORITY = 999;
    
    public function getLink(): array
    {
        return ['label' => 'Home', 'route' => 'home'];
    }
    
    public static function getDefaultPriority(): int
    {
        return self::PRIORITY;
    }
}
