<?php

namespace Yu\Core;

use Laminas\Stdlib\ArrayObject;
use Laminas\Serializer\Serializer;
use Yu\Site\ValueObject\Lang;

/**
 * Universal data container with array access implementation
 *
 */
class DataHelper
{
    /**
     * @param $data
     * @param null $lang
     * @return mixed
     */
    public static function unserialize($data, $lang = null)
    {
        if ($lang === null) {
            $lang = Lang::getCurrentLang()['code'];
        }

        if (self::checkSerializeString($data)) {
            $unserializ = Serializer::unserialize($data);
            if (is_array($unserializ) && isset($unserializ[$lang])) {
                $data = $unserializ[$lang];

                if (empty($data)) {
                    $data = $unserializ[Lang::getDefaultLangCode()];
                }
            }
        }
        return $data;
    }

    /**
     * @param $data
     * @return string|array
     */
    public static function prepareDataForForm($data)
    {
        if (self::checkSerializeString($data)) {
            return Serializer::unserialize($data);
        }
        return $data;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function getDefaultLangValue($string)
    {
        if (self::checkSerializeString($string)) {
            $data = Serializer::unserialize($string);
            return $data[\Yu\Site\ValueObject\Lang::getDefaultLangCode()];
        }
        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function getCurrentLangValue($string)
    {
        if (self::checkSerializeString($string)) {
            $data = Serializer::unserialize($string);
            $value = $data[\Yu\Site\ValueObject\Lang::getCurrentLang()['code']];
            if (empty($value)) {
                $value = self::getDefaultLangValue($string);
            }
            return $value;
        }
        return $string;
    }

    public static function checkSerializeString($data)
    {
        if (!empty($data) && is_string($data) && preg_match("/^(i|s|a|o|d):(.*);/si", $data) == 1) {
            return true;
        }
        return false;
    }

    public static function toCamelCase($str)
    {
        $i = array("-", "_");
        $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
        $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
        $str = str_replace($i, ' ', $str);
        $str = str_replace(' ', '', ucwords(strtolower($str)));
        $str = strtolower(substr($str, 0, 1)) . substr($str, 1);
        return $str;
    }

    public static function unCamelCase($str)
    {
        $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $str);
        $str = strtolower($str);
        return $str;
    }

    public static function substring($stringFull, $start, $end)
    {
        $string = $stringFull;
        for ($i = $end; $i > $start+1; $i--) {
            $string = mb_substr($stringFull, $start, $i);
            if (mb_substr($stringFull, $i, 1) == " " && mb_substr($stringFull, $i - 1, 1) <> ",") {
                break;
            }
        }

        return $string;
    }
}
