<?php

declare(strict_types=1);

namespace App\Infra\Menu\TwigExtension;

use App\Infra\Menu\Menu;
use JetBrains\PhpStorm\ArrayShape;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class MenuExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private Menu $menu)
    {
    }
    
    #[ArrayShape(['menu' => "array"])]
    public function getGlobals(): array
    {
        return [
            'menu' => $this->menu->getItems()
        ];
    }
}