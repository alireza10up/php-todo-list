<?php

if (! function_exists('jalali')) {
    /**
     * @param null $datetime
     * @param null $timezone
     * @return \Hekmatinasser\Jalali\Jalali
     */
    function jalali($datetime = null, $timezone = null)
    {
        return new \Hekmatinasser\Jalali\Jalali($datetime, $timezone);
    }
}
