<?php

Route::get('/i18next/test', function() {
    return view('i18next::test', [
        'lang' => request()->get('lang', App::getLocale())
    ]);
});

Route::get('/i18next/fetch/{lang}/{namespace}', 'ProcessMaker\i18next\Controllers\FetchController@fetch');
