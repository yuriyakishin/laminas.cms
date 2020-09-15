<?php

namespace Yu\Core\View\Helper;

use Yu\Site\ValueObject\Lang;

class UrlWithLang extends \Laminas\View\Helper\AbstractHelper
{

    /**
     * @param string|null $url
     * @param array $options
     * @return string
     */
    public function __invoke(string $url = null, array $options = [])
    {
        $pathArray = explode('/', $url);
        if(!empty($pathArray) && count($pathArray) > 1 && $pathArray[1] !== 'admin') {
            $currentLang = Lang::getCurrentLang();
            $defaultLang = Lang::getDefaultLang();
            if($currentLang !== $defaultLang) {
                if($url == '/') {
                    $url = '/' . $currentLang['code'];
                } else {
                    $url = '/' . $currentLang['code'] . $url;
                }
            }
        }
        return $url;
    }
}