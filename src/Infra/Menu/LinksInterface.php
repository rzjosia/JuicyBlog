<?php

declare(strict_types=1);

namespace App\Infra\Menu;

interface LinksInterface
{
    public function getLink(): array;
    public static function getDefaultPriority(): int;
}