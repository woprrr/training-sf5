<?php

namespace App\Twig;

use App\Markdown\MarkdownHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class MarkdownExtension
 *
 * @package App\Twig
 */
class MarkdownExtension extends AbstractExtension
{
    /**
     * @var \App\Markdown\MarkdownHelper
     */
    private MarkdownHelper $markdownHelper;

    /**
     * MarkdownExtension constructor.
     *
     * @param \App\Markdown\MarkdownHelper $markdownHelper
     */
    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'parse_markdown',
                [$this, 'parseMarkdown'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * Apply markdown cached parse action.
     *
     * @param string $value Value to be parsed.
     *
     * @return string Value transformed to markdown format.
     */
    public function parseMarkdown(string $value): string
    {
        return $this->markdownHelper->parse($value);
    }
}
