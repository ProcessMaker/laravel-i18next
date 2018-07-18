<?php

/**
 * Get a collection of i18next namespaces that match 
 * our laravel translation namespaces.
 * 
 * @param boolean $asJson
 */
function i18next_namespaces($asJson = true)
{
    $translationLoader = app()['translation.loader'];
    $namespaces = array_merge(['_default'], array_keys($translationLoader->namespaces())); 
    
    return $asJson ? json_encode($namespaces) : $namespaces;
}