<?php

/**
 * Get a collection of i18next namespaces that match 
 * our laravel translation namespaces.
 */
function i18next_namespaces($json = true)
{
    $translationLoader = app()['translation.loader'];
    $namespaces = ['_default'];
    $namespaces = array_merge($namespaces, array_keys($translationLoader->namespaces())); 
    
    if(!$json) {
        return $contexts;
    }
    return json_encode($namespaces);

}