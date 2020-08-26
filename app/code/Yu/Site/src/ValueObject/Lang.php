<?php

namespace Yu\Site\ValueObject;

class Lang
{
    private static $LANG = [
        [
            'id' => 1,
            'code' => 'ru',
            'i18n' => 'ru_RU',
            'name' => 'Русский',
            'main' => 1,
        ],
        [
            'id' => 2,
            'code' => 'ua',
            'i18n' => 'ua_UA',
            'name' => 'Украинский',
            'main' => 0,
        ],
        [
            'id' => 3,
            'code' => 'en',
            'i18n' => 'en_EN',
            'name' => 'English',
            'main' => 0,
        ],
    ];

    private static $currentLang;

    /**
     * @return array
     */
    public static function getMainLang()
    {
        return static::$LANG[0];
    }

    /**
     * @return array
     */
    public static function getDefaultLang()
    {
        return static::$LANG[0];
    }

    /**
     * @return array
     */
    public static function getDefaultLangCode()
    {
        return static::$LANG[0]['code'];
    }

    public static function getLangs()
    {
        return static::$LANG;
    }

    public static function getCurrentLang()
    {
        if(empty(self::$currentLang)) {
            self::$currentLang = self::getMainLang();
        }

        return self::$currentLang;
    }

    public static function setCurrentLang(array $lang)
    {
        self::$currentLang = $lang;
    }
}