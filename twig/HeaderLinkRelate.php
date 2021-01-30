<?php

namespace Grav\Plugin;
use \Grav\Common\Grav;

class HeaderLinkRelate extends \Twig_Extension
{
    private $grav;

    public function __construct($grav) {
        $this->grav = $grav;
    }

    public function getName()
    {
        return 'HeaderLinkRelate';
    }

    public function getFunctions()
    {
        
        return [
            new \Twig_SimpleFunction('headerLinkRelate', [$this, 'headerLinkRelate'])
        ];
    }

    public function headerLinkRelate($page, $collection)
    {
        $language = $this->grav['language'];
        $defaultLanguage = $language->getDefault();
        $translatedPages = $page->translatedLanguages(true);
        $alternates = '';
        foreach ($translatedPages as $language => $route) {
            if ($language == $page->language()) {
                continue;
            }
            $alternates .=  '<link rel="alternate" href="/' . $language . $route . ( $defaultLanguage == $language ?  '" hreflang="x-default"':'"') . '/>' . PHP_EOL;
        }
        return $alternates;
    }
}
