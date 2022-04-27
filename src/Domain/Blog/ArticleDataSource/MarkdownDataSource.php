<?php

declare(strict_types=1);

namespace App\Domain\Blog\ArticleDataSource;

use App\Domain\Blog\Entity\Article;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MarkdownDataSource implements ArticleDataSourceInterface
{
    private const markdownDir = 'ArticlesMarkdown';

    public function __construct(private string $projectDir, private SerializerInterface $serializer, private MarkdownParserInterface $markdownParser)
    {
    }

    public function getArticle(string $slug): ?Article
    {
        $filePath = $this->projectDir . '/' . self::markdownDir . '/' . $slug . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        $content = file_get_contents($filePath);

        $fileContent = htmlspecialchars_decode($this->markdownParser->transformMarkdown($content));

        preg_match('#<!---DataSource' . PHP_EOL . '(?<jsonContent>[\w\W]+)--->#', $fileContent, $matches);
        $jsonContent = '{' . str_replace(PHP_EOL . "\"", ',"', trim($matches['jsonContent'])) . '}';
        return $this->serializer->deserialize($jsonContent, Article::class, 'json');
    }
}