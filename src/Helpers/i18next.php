<?php

namespace ProcessMaker\i18next\Helpers;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class i18Next
{
    /**
     * Replace the :var syntax with {{var}} for compatibility
     * with i18next. Will optionally flatten the array.
     * 
     * @param array   $translations
     * @param boolean $flatten
     * 
     * @return array
     */
    public function laravelToI18next($translations, $flatten = false)
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

        return !$flatten ? $i18nTranslations : $this->flatten($i18nTranslations);
    }

    private function flatten($translations)
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($translations));
        $flattened = [];

        foreach ($iterator as $leafValue) {
            $keys = [];

            foreach (range(0, $iterator->getDepth()) as $depth) {
                $keys[] = $iterator->getSubIterator($depth)->key();
            }

            $flattened[join('.', $keys)] = $leafValue;
        }

        return $flattened;
    }
}