<?php

namespace ProcessMaker\i18next\Helpers;

class i18Next
{
    /**
     * Replace the :var syntax with {{var}} for
     * compatibility with i18next
     * 
     * @param array $translations
     * 
     * @return array
     */
    public function laravelToI18next($translations)
    {
        $i18nTranslations = [];
        $keys = array_keys($translations);

        for($i = 0; $i < count($keys); $i++) {
            $laravelKey = $keys[$i];
            $i18nKey = preg_replace("/:([\w\d]+)/", "{{\$1}}", $laravelKey);
            $laravelValue = $translations[$laravelKey];

            if (is_array($laravelValue)) {
                $i18nTranslations[$i18nKey] = $this->laravelToI18next($laravelValue);
            } else {
                $i18nTranslations[$i18nKey] = preg_replace("/:([\w\d]+)/", "{{\$1}}", $laravelValue);
            }
        }

        return $i18nTranslations;
    }
}