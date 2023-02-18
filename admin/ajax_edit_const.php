<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 23.05.2019
 * Time: 17:23
 */

require('includes/application_top.php');

use App\Classes\Filesystem\Filesystem;

$lang_translate = new Filesystem();
if (isset($_GET['translate']) && $_GET['translate'] == 'admin') {
    chdir('includes/languages');
} else {
    chdir('../includes/languages');
}

function smartSlashes($const) {
    $patterns = [
        '.\'' => '@{',
        '\'.' => '%^',
        '. \'' => '@#',
        '\' .' => '%#',
        '\n' => ')!',
        '."' => '%*',
        '. "' => '%*',
        '".' => '*?',
        '" .' => '*%',
        '"' => '$%',
        '\'' => '^$',
    ];
    return strtr(addslashes(strtr($const, $patterns)), array_flip($patterns));
}

$tmp_dir = getcwd();
$dirs = glob('*', GLOB_ONLYDIR);
$current_dir = ($_GET['path'] ? $tmp_dir . DS . $_GET['path'] : $tmp_dir);
$dir = new DirectoryIterator($current_dir);
$lng = new language();
if (!empty($_POST['constname']) && !empty($_POST['constArray']) && is_array($_POST['constArray'])) {
    foreach ($_POST['constArray'] as $file_path => $v) {
        $file = file_get_contents($v['directory']);
            $const = $_POST['constname'];
            //        $pattern = '/define\(\'(' . $const . ')\'\,\s?\'(.+)\'\)/';

            /*if (preg_match('/(\'\s?\.)/', $v, $matches)) {
                $replecer = $v;
            } else {
                //$replecer = str_replace('\'', '', $v);
                //$replacement = 'define(\'$1\', \'' . $v . '\')';
                $replecer = addslashes($v);
            }*/
            //        $v = str_replace('\'', '', $v);
            //        $replecer = addslashes($v);
            //        $replacement = 'define(\'$1\', \'' . $replecer . '\')';
            $search_patterns = [
                'define(\'' . $const . '\', \'%s\')',
                'define(\'' . $const . '\', \'%s")',
                'define(\'' . $const . '\',\'%s\')',
                'define(\'' . $const . '\',\'%s")',
                'define(\'' . $const . '\', "%s")',
                'define(\'' . $const . '\', "%s\')',
                'define(\'' . $const . '\', %s)',
                'define(\'' . $const . '\',"%s\')',
                'define(\'' . $const . '\',"%s")',
            ];


        $list = get_html_translation_table(HTML_ENTITIES);
        unset($list['"'], $list['<'], $list['>'], $list['&'], $list['Α'], $list['Β'], $list['Γ'], $list['Δ'], $list['Ε'], $list['Ζ'], $list['Η'], $list['Θ'], $list['Ι'], $list['Κ'], $list['Λ'], $list['Μ'], $list['Ν'], $list['Ξ'], $list['Ο'], $list['Π'], $list['Ρ'], $list['Σ'], $list['Τ'], $list['Υ'], $list['Φ'], $list['Χ'], $list['Ψ'], $list['Ω'], $list['α'], $list['β'], $list['γ'], $list['δ'], $list['ε'], $list['ζ'], $list['η'], $list['θ'], $list['ι'], $list['κ'], $list['λ'], $list['μ'], $list['ν'], $list['ξ'], $list['ο'], $list['π'], $list['ρ'], $list['ς'], $list['σ'], $list['τ'], $list['υ'], $list['φ'], $list['χ'], $list['ψ'], $list['ω'], $list['ϑ'], $list['ϒ'], $list['ϖ']);
        $search = array_keys($list);
            $values = array_values($list);
            $v = array_map(function ($str) use ($search, $values) {
                return str_replace($search, $values, $str);
            }, $v);
            $srch = $replace = false;
            $v['base'] = smartSlashes($v['base']);
            $v['new'] = str_replace("\n", '<br />', smartSlashes($v['new']));
            //        $v['base'] = addslashes($v['base']);
            if ($v['base'] != $v['new']) {
                foreach ($search_patterns as $search_pattern) {
                    if (strpos($file, sprintf($search_pattern, $v['base']))) {
                        $srch = sprintf($search_pattern, $v['base']);
                        $replace = sprintf($search_pattern, $v['new']);
                        break;
                    } elseif (strpos($file, sprintf($search_pattern, addslashes($v['base'])))) {
                        $srch = sprintf($search_pattern, addslashes($v['base']));
                        $replace = sprintf($search_pattern, addslashes($v['new']));
                        break;
                    }
                }
                if ($srch && $replace) {
                    $file = str_replace($srch, $replace, $file);
                }
            }

            //        $file = preg_replace($pattern, $replacement, $file);

        file_put_contents($v['directory'], $file);

    }
    if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        die(1);
    }
}

$arr = [];
foreach ($lng->catalog_languages as $lang_array) {
    $current_dir = getcwd();
    if (empty($_GET['path'])) {
        $filename = $current_dir . DIRECTORY_SEPARATOR .$lang_array['directory'].'.php';
    }else{
        $current_dir .= DIRECTORY_SEPARATOR.$lang_array['directory'];
        $path = explode('\\',$_GET['path']);
        array_shift($path);
        $filename = $current_dir . DIRECTORY_SEPARATOR . implode('\\',$path).$_GET['file'];
    }
        if ($filename && file_exists( $filename)):
            $constants = file($filename);
            $commented = false;
            foreach ($constants as $line => $v) {

                if (strpos($v, '/*') || strpos($v, '/*') === 0) {
                    $commented = true;
                }

                if ((preg_match('/define\s*\([\'|"](.+)[\'|"]\s?\,\s?[\'|"](.*)[\'|"]\)/', $v, $matches) || preg_match('/define\s*\([\'|"](.+)[\'|"]\s?\,\s?(.*[\'|"](.*)[\'|"].*)\)/', $v, $matches)) && !$commented && !preg_match('/\/\/\s{0,1}define/', $v)) {
                    if ( $matches[1] == $_GET['constname']) {
                        $arr[$lang_array['directory']] = [
                                'directory'=>$filename,
                            'const' => trim($matches[1]),
                            'val' => str_replace('{}n', '\n', stripslashes(str_replace('\n', '{}n', htmlspecialchars_decode(html_entity_decode($matches[2])))))
                        ];
                    }
                }
                if (strpos($v, '*/') || strpos($v, '*/') === 0) {
                    $commented = false;
                }
            }
        endif;


}
foreach ($arr as $lang=>$data){?>
    <div class="form-group row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label"><?=$lang?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="<?=$lang?>[new]" value="<?=$data['val']?>">
        <input type="hidden" name="<?=$lang?>[base]" value="<?=$data['val']?>">
        <input type="hidden" name="<?=$lang?>" class="file_name" value="<?=$data['val']?>">
        <input type="hidden" name="<?=$lang?>[directory]" class="directory" value="<?=$data['directory']?>">
    </div>
    </div>
<?}?>
    <div class="row">

    <div class="btn btn-primary mb-2 pull-right m-r submit-edit-const" data-constname="<?=$_GET['constname']?>">Submit</div>
    </div>
<?php
die();