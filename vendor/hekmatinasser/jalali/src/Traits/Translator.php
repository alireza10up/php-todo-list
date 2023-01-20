<?php

namespace Hekmatinasser\Jalali\Traits;

trait Translator
{
    /**
     * List of custom localized messages.
     *
     * @var array
     */
    public static array $messages = [];

    /**
     * List of custom localized messages.
     *
     * @var string|null
     */
    public static ?string $locale = null;

    /**
     * Reset the format used to the default when type juggling a Jalali instance to a string
     */
    public static function resetLocale()
    {
        static::setLocale(static::DEFAULT_LOCALE);
    }

    /**
     * Set the default locale
     *
     * @param string $locale
     * @return bool
     */
    public static function setLocale(string $locale): bool
    {
        if ($result = static::loadMessages($locale)) {
            static::$locale = $locale;
        }

        return $result;
    }

    /**
     * Get the default locale
     *
     * @return string
     */
    public static function getLocale(): string
    {
        return static::$locale ?: static::DEFAULT_LOCALE;
    }

    /**
     * Return a singleton instance of Translator.
     *
     * @param string|null $locale optional initial locale ("fa" -  by default)
     *
     * @return bool
     */
    public static function loadMessages(string $locale = null): bool
    {
        if ($messages = static::getMessages($locale)) {
            static::$messages = $messages;

            return true;
        }

        return false;
    }

    /**
     * Set messages of a locale and take file first if present.
     *
     * @param string|null $locale
     *
     * @return array|bool
     */
    public static function getMessages(string $locale = null): bool|array
    {
        $data = @include sprintf('%s/Lang/%s.php',  dirname(__DIR__), $locale ?: static::getLocale());
        if ($data !== false) {
            return $data;
        }

        return false;
    }

    /**
     * Set messages of a locale and take file first if present.
     *
     * @param string $locale
     * @param array $messages
     */
    public function setMessages(string $locale, array $messages)
    {
        if (static::loadMessages($locale)) {
            static::$messages = array_merge(static::$messages, $messages);
        }
        static::$messages = $messages;
    }
}
