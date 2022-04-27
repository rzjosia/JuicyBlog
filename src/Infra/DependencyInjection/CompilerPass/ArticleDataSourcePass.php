<?php

declare(strict_types=1);

namespace App\Infra\DependencyInjection\CompilerPass;

use App\Domain\Blog\ArticleDataSource\ArticleDataSource;
use App\Domain\Blog\ArticleDataSource\ArticleDataSourceInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ArticleDataSourcePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
//        $articleDataSourceDefinition = $container->getDefinition(ArticleDataSource::class);
//
//        $serviceIds = $container->findTaggedServiceIds('app.article_data_source');
//        $services = [];
//
//        foreach ($serviceIds as $serviceId => $tags) {
//            $services[] = new Reference($serviceId);
//        }
//
//        $articleDataSourceDefinition->setArgument('$sources', $services);
    }
}