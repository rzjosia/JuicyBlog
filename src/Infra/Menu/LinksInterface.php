<?php

declare(strict_types=1);

namespace App\Infra\Menu;

interface LinksInterface
{
    public function getLinks(): iterable;
    public function getPriority(): int;
}