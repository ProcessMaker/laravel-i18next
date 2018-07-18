<?php
namespace ProcessMaker\i18next\Controllers;

use Illuminate\Routing\Controller as BaseController;
use ProcessMaker\i18next\Helpers\i18Next;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;

class FetchController extends BaseController
{
    /**
     * @var i18next
     */
    private $i18next;

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * @var FileLoader
     */
    private $translationLoader;

    /**
     * @param i18next $i18next
     */
    public function __construct(i18Next $i18next)
    {
        $this->i18next = $i18next;
        $this->files = app()['files'];
        $this->translationLoader = app()['translation.loader'];
    }

    /**
     * @param string $lang
     * @param string $namespace
     */
    public function fetch($lang, $namespace = '_default')
    {
        if ($namespace === '_default') {
            // Attempt to reference the Translation Strings as Key format
            $translations = $this->translationLoader->load($lang, '*', '*');
       } else {
            $translations = [];
            $namespaces = $this->translationLoader->namespaces();

            // Verify namespace exists
            if (!array_key_exists($namespace, $namespaces)) {
                return $translations;
            }

            // Now fetch all groups for the namespace
            $groups = $this->files->files(sprintf('%s/%s/', $namespaces[$namespace], $lang));

            // This is namespaced, let's fetch the namespace
            foreach($groups as $group) {
                $group = basename($group, '.php');
                $groupData = $this->translationLoader->load($lang, $group, $namespace);

                foreach($groupData as $key => $val) {
                    $translations[$group . '.' . $key] = $val;
                }
            }
        }

        return $this->i18next->laravelToI18next($translations, config('i18next.flatten'));
    }
}
