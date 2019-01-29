<?php

Route::get('/i18next/test', 'ProcessMaker\i18next\Controllers\TestController@test');

Route::get('/i18next/fetch/{lang}/{namespace?}', 'ProcessMaker\i18next\Controllers\FetchController@fetch');
