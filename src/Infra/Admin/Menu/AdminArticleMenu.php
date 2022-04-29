<?php

declare(strict_types=1);

namespace App\Infra\Admin\Menu;

use App\Infra\Menu\LinksInterface;
use App\Infra\Menu\MenuItem;

class AdminArticleMenu implements LinksInterface
{
    private const priority = 2;
    
    public function getLink(): array
    {
        return ['label' => 'Créer un article', 'route' => 'admin_articlesadmin_create_article'];
    }
    
    public function getPriority(): int
    {
        return self::priority;
    }
}