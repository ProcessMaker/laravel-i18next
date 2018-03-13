<?php
namespace ProcessMaker\i18next\Controllers;
use Illuminate\Routing\Controller as BaseController;

class FetchController extends BaseController
{
    
    public function fetch($lang, $namespace)
    {
        $translationLoader = app()['translation.loader'];
        // Get our default files
        $files = app()['files'];
        if($namespace == "_default") {
            // Attempt to reference the Translation Strings as Key format
            $result = ($translationLoader->load($lang, '*', '*'));
       } else {
            $result = [];
            // First verify if namespace exists
            $namespaces = $translationLoader->namespaces();
            if(!array_key_exists($namespace, $namespaces)) {
                // Empty array
                return $result;
            }
            // Now fetch all groups for the namespace
            $groups = $files->files($namespaces[$namespace] . '/' . $lang . '/');
            // This is namespaced, let's fetch the namespace
            foreach($groups as $group) {
                $group = basename($group, '.php');
                $groupData = $translationLoader->load($lang, $group, $namespace);
                foreach($groupData as $key => $val) {
                    $result[$group . '.' . $key] = $val;
                }
            }
        }
        $keys = array_keys($result);
        // Replace the :var syntax with {{var}}
        for($i = 0; $i < count($keys); $i++) {
            $newkey = preg_replace("/:([\w\d]+)/", "{{\$1}}", $keys[$i]);
            $item = preg_replace("/:([\w\d]+)/", "{{\$1}}", $result[$keys[$i]]);
            if($newkey != $keys[$i]) {
                unset($result[$keys[$i]]);
            }
            $result[$newkey] = $item;
        }
        return $result;
    }
}
