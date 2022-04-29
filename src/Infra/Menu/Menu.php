<?php

declare(strict_types=1);

namespace App\Infra\Menu;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class Menu
{
    private iterable $links;
    
    public function __construct(#[TaggedIterator('app.menu_link')] iterable $links)
    {
        $this->links = $links;
    }
    
    public function getItems(): array
    {
        $allLinks = [];
        
        foreach ($this->links as $linksByDomain) {
            $allLinks[] = $linksByDomain->getLink();
        }
        
        return $allLinks;
    }
}