<?php


namespace SfDoctrineBundle\Twig;


use SfDoctrineBundle\Service\MarkdownTransformer;
use Twig_Extension;
use Twig_SimpleFilter;

class MarkdownExtension extends Twig_Extension
{

    private $markdownTransformer;

    public function __construct(MarkdownTransformer $markdownTransformer)
    {
        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('markdownify', array($this, 'parseMarkdown'))
        ];

    }

    public function parseMarkdown($str)
    {
        return $this->markdownTransformer->parse($str);
    }

    public function getName()
    {
        return 'app_markdown';
    }

}