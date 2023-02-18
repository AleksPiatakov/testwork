<?php


namespace SoloMono\LanguageEditor;


/**
 * Class PHPLanguageEditor
 *
 * @package SoloMono\LanguageEditor
 */
class PHPLanguageEditor implements LanguageEditorInterface {

    /**
     * @inheritDoc
     */
    public function update($constants, $fileName) {
        $file = file_get_contents($fileName);
        foreach ($constants as $const => $v) {
            $search_patterns = [
                'define(\'' . $const . '\', \'%s\')',
                'define(\'' . $const . '\', \'%s")',
                'define(\'' . $const . '\',\'%s\')',
                'define(\'' . $const . '\',\'%s")',
                'define(\'' . $const . '\', "%s")',
                'define(\'' . $const . '\', "%s\')',
                'define(\'' . $const . '\', %s)',
                'define(\'' . $const . '\',%s)',
                'define(\'' . $const . '\',"%s\')',
                'define(\'' . $const . '\',"%s")',
            ];

            function smartSlashes($const) {
                $patterns = [
                    '.\''  => '@{',
                    '\'.'  => '%^',
                    '. \'' => '@#',
                    '\' .' => '%#',
                    '\n'   => ')!',
                    '."'   => '%*',
                    '. "'  => '%*',
                    '".'   => '*?',
                    '" .'  => '*%',
                    '"'    => '$%',
                    '\''   => '^$',
                ];
                return strtr(addslashes(strtr($const, $patterns)), array_flip($patterns));
            }

            $list = get_html_translation_table(HTML_ENTITIES);
            unset($list['"'], $list['<'], $list['>'], $list['Α'], $list['Β'], $list['Γ'], $list['Δ'], $list['Ε'], $list['Ζ'], $list['Η'], $list['Θ'], $list['Ι'], $list['Κ'], $list['Λ'], $list['Μ'], $list['Ν'], $list['Ξ'], $list['Ο'], $list['Π'], $list['Ρ'], $list['Σ'], $list['Τ'], $list['Υ'], $list['Φ'], $list['Χ'], $list['Ψ'], $list['Ω'], $list['α'], $list['β'], $list['γ'], $list['δ'], $list['ε'], $list['ζ'], $list['η'], $list['θ'], $list['ι'], $list['κ'], $list['λ'], $list['μ'], $list['ν'], $list['ξ'], $list['ο'], $list['π'], $list['ρ'], $list['ς'], $list['σ'], $list['τ'], $list['υ'], $list['φ'], $list['χ'], $list['ψ'], $list['ω'], $list['ϑ'], $list['ϒ'], $list['ϖ']);
            $search = array_keys($list);
            $values = array_values($list);
            $v = array_map(function ($str) use ($search, $values) {
                return str_replace($search, $values, $str);
            }, $v);
            $srch = $replace = false;
            $v['base'] = smartSlashes($v['base']);
            $v['new'] = str_replace("\n", '<br />', smartSlashes($v['new']));
            if ($v['base'] != $v['new']) {
                foreach ($search_patterns as $search_pattern) {
                    if (strpos($file, sprintf($search_pattern, $v['base']))) {
                        $srch = sprintf($search_pattern, $v['base']);
                        $replace = sprintf($search_pattern, addslashes($v['new']));
                        break;
                    } else if (strpos($file, sprintf($search_pattern, addslashes($v['base'])))) {
                        $srch = sprintf($search_pattern, addslashes($v['base']));
                        $replace = sprintf($search_pattern, addslashes($v['new']));
                        break;

                    } else if (strpos($file, sprintf($search_pattern, html_entity_decode($v['base'])))) {
                        $srch = sprintf($search_pattern, html_entity_decode($v['base']));
                        $replace = sprintf($search_pattern, html_entity_decode($v['new']));
                        break;
                    } else if (strpos($file, sprintf($search_pattern, addslashes(html_entity_decode($v['base']))))) {
                        $srch = sprintf($search_pattern, addslashes(html_entity_decode($v['base'])));
                        $replace = sprintf($search_pattern, addslashes(html_entity_decode($v['new'])));
                        break;
                    }
                }
                if ($srch && $replace) {
                    $file = str_replace($srch, $replace, $file);
                }
            }
        }
        file_put_contents($fileName, $file);
    }

    /**
     * @inheritDoc
     */
    public function insert($constantName, $constantValue, $fileName) {
        $file = file_get_contents($fileName);
        $cVal = PHP_EOL.'define(\'' . $constantName . '\', \''.$constantValue.'\');'.PHP_EOL;
        if (strstr($file, $constantName)) {
            throw new ConstantAlreadyExistException($constantName);
        }
        if (strstr($file,'?>')) {
            $file = str_replace('?>', $cVal.'?>', $file);
        }else{
            $file = $file.$cVal;
        }
        file_put_contents($fileName, $file);
    }

    /**
     * @inheritDoc
     */
    public function parse($fileName) {
        $constants = file($fileName);
        $commented = false;
        $arr = [];
        foreach ($constants as $line => $v) {

            if (strpos($v, '/*') || strpos($v, '/*') === 0) {
                $commented = true;
            }

            if (
                (preg_match('/define\s*\([\'|"](.+)[\'|"]\s?\,\s?[\'|"](.*)[\'|"]\)/', $v, $matches)
                    || preg_match('/define\s*\([\'|"](.+)[\'|"]\s?\,\s?(.*[\'|"](.*)[\'|"].*)\)/', $v, $matches))
                && !$commented && !preg_match('/\/\/\s{0,1}define/', $v)) {
                $arr[$line + 1] = [
                    'const' => trim($matches[1]),
                    'val'   => str_replace('{}n', '\n', stripslashes(str_replace('\n', '{}n', htmlspecialchars_decode(html_entity_decode($matches[2]))))),
                ];
            }
            if (strpos($v, '*/') || strpos($v, '*/') === 0) {
                $commented = false;
            }
        }
        return $arr;
    }

    /**
     * @inheritDoc
     */
    public function getFileExtension() {
        return "php";
    }
}