<?php
namespace ProcessMaker\i18next\Controllers;

use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    /**
     * @param string $lang
     * @param string $namespace
     */
    public function test()
    {
        return view('i18next::test', [
            'lang' => request()->get('lang', app()->getLocale())
        ]);
    }
}
