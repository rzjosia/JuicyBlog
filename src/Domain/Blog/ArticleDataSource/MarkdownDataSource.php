<?php

declare(strict_types=1);

namespace App\Domain\Blog\ArticleDataSource;

use App\Domain\Blog\Entity\Article;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\SerializerInterface;

class MarkdownDataSource implements ArticleDataSourceInterface
{
    private const MARKDOWN_DIR = 'ArticlesMarkdown';

    public function __construct(private string $projectDir, private SerializerInterface $serializer, private MarkdownParserInterface $markdownParser)
    {
    }

    public function getAll(): iterable
    {
        $finder = Finder::create()->files()->name('*.md')->in($this->projectDir . '/' . self::MARKDOWN_DIR);

        foreach ($finder->getIterator() as $file) {
            yield $this->parse($file->getPathname());
        }
    }

    public function getArticle(string $slug): ?Article
    {
        if (file_exists($path = $this->projectDir . '/' . self::MARKDOWN_DIR . '/' . $slug . '.md')) {
            return $this->parse($path);
        }

        return null;
    }

    private function parse(string $path): Article
    {
        $content = file_get_contents($path);
        $fileContent = htmlspecialchars_decode($this->markdownParser->transformMarkdown($content));

        preg_match('#<!---DataSource' . PHP_EOL . '(?<jsonContent>[\w\W]+)--->#', $fileContent, $matches);

        $jsonContent = '{' . str_replace(PHP_EOL . "\"", ',"', trim($matches['jsonContent'])) . '}';

        return $this->serializer->deserialize($jsonContent, Article::class, 'json');
    }
}