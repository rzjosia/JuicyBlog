<?php

declare(strict_types=1);

namespace App\Domain\Blog\ArticleDataSource;

use App\Domain\Blog\Entity\Article;
use Symfony\Component\Serializer\SerializerInterface;

class HtmlDataSource implements ArticleDataSourceInterface
{
    private const htmlDir = 'ArticlesHtml';

    public function __construct(private string $projectDir, private SerializerInterface $serializer)
    {
    }

    public function getArticle(string $slug): ?Article
    {
        $htmlFile = $this->projectDir . '/' . self::htmlDir . '/' . $slug . '.html';

        if (!file_exists($htmlFile)) {
            return null;
        }

        $fileContent = file_get_contents($htmlFile);
        preg_match('#<script type="application/ld\+json">(?<jsonContent>[\w\W]+)</script>#', $fileContent, $matches);
        $jsonContent = $matches['jsonContent'];

        return $this->serializer->deserialize($jsonContent, Article::class, 'json');
    }
}