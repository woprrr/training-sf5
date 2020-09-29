<?php

namespace App\Markdown;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class MarkdownHelper
 *
 * @package App\Markdown
 */
class MarkdownHelper
{

    /**
     * @var \Symfony\Contracts\Cache\CacheInterface
     */
    private CacheInterface $cache;

    /**
     * @var \Knp\Bundle\MarkdownBundle\MarkdownParserInterface
     */
    private MarkdownParserInterface $markdownParser;

    /**
     * @var bool
     */
    private bool $isDebug;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * MarkdownHelper constructor.
     *
     * @param \Symfony\Contracts\Cache\CacheInterface            $cache
     * @param \Knp\Bundle\MarkdownBundle\MarkdownParserInterface $markdownParser
     * @param bool                                               $isDebug
     */
    public function __construct(CacheInterface $cache, MarkdownParserInterface $markdownParser, bool $isDebug, LoggerInterface $markdownLogger)
    {
        $this->cache = $cache;
        $this->markdownParser = $markdownParser;
        $this->isDebug = $isDebug;
        $this->logger = $markdownLogger;
    }

    public function parse(string $source): string
    {
        if (stripos($source, 'cat') !== false) {
            $this->logger->info('Meow !');
        }

        if(!$this->isDebug) {
            return $this->markdownParser->transformMarkdown($source);
        }

        return $this->cache->get(
            'markdown_'.md5($source),
            fn(): string => $this->markdownParser->transformMarkdown($source)
        );
    }
}
