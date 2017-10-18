<?php
namespace App\Core;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

class TwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'app';
    }

    /**
     * App Twig Functions
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('env', 'getenv'),
        ];
    }

    /**
     * App Twig Filters
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('tagify', [$this, 'tagify'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Convert a string of comma separated values into tags.
     *
     * @param string $tags      CSV tags
     * @param string $add_class Additional class(es) to add
     * @return string
     */
    public function tagify($tags, $add_class = '')
    {
        $return = '';
        if ($tags) {
            $list = explode(',', $tags);
            foreach ($list as $tag) {
                if (trim($tag)) {
                    $return .= ' <span class="tag '.$add_class.'">'.trim(htmlspecialchars($tag)).'</span>';
                }
            }
        }
        return trim($return);
    }
}
