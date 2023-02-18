<?php

ini_set('max_execution_time', 0);
use iamcal\SQLParser;

if (strpos($_SERVER['PHP_SELF'], 'uploadFile.php')) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'application_main.php';
}
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'functions.php');
$q = microtime(true);


if (!empty($_FILES)) {
    set_error_handler("warning_handler_folder_access", E_WARNING);
    if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'files')) {
        mkdir(__DIR__ . DIRECTORY_SEPARATOR . 'files');
    }
    if (!move_uploaded_file($_FILES['db']['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . 'files/db.sql')) {
        die;
    }
    restore_error_handler();

    require_once __DIR__ . DIRECTORY_SEPARATOR . 'SQLParser.php';


    //$iterator = readTheFile('files/db.sql');
    class createTableParser
    {

        private $parser = null;

        private $fileIterator;

        private $isCreateTable = false;

        private $i = 0;
        private $start = 0;
        private $end = 0;

        private $tables = [];
        private $parsedTables = [];


        public function __construct($filepath)
        {
            $this->parser = new SQLParser();
            $this->fileIterator = self::readFile($filepath);
        }

        static function readFile($path)
        {
            $handle = fopen($path, "r");

            while (!feof($handle)) {
                yield trim(fgets($handle));
            }

            fclose($handle);
        }

        private function parseString($string)
        {
            if (false !== strpos($string, 'CREATE TABLE')) {
                $this->isCreateTable = true;
                $this->start = $this->end = 0;
            }
            if ($this->isCreateTable) {
                foreach (str_split($string) as $pos => $char) {
                    if ($this->start === $this->end && $this->start > 0) {
                        break;
                    }
                    switch ($char) {
                        case '(':
                            $this->start++;
                            break;
                        case ')':
                            $this->end++;
                            break;
                        default:
                            break;
                    }
                }

                if (isset($pos) && ($pos + 1) !== strlen($string)) {
                    $this->isCreateTable = false;
                    $string = substr($string, 0, $pos) . ';';
                }
                $this->tables[$this->i] .= $string . PHP_EOL;
                if (!$this->isCreateTable) {
                    $this->i++;
                }
            }
        }

        private function parseStrings()
        {
            foreach ($this->fileIterator as $string) {
                $this->parseString($string);
            }
        }

        public function parseSql()
        {
            $this->parseStrings();
            $this->parsedTables = $this->parser->parse(implode(PHP_EOL, $this->tables));
        }

        public function getParsedTables()
        {
            return $this->parsedTables;
        }
    }

    $parser = new \createTableParser(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.sql');
    $parser->parseSql();
    $tables = $parser->getParsedTables();

    $q = microtime(true) - $q;
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.json', json_encode($tables));
} else {
    $tables = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.json'), true);
}

function _checkbox($name, $type, $checked, $inputName)
{
    foreach ($type as $t) {
        $inputName .= "[{$t}]";
    }
    $inputName .= '[]';

    // default checked only main tables
    $checked_tables = checked_tables();
    if ($inputName == 'tables[]') {
        $checked_table = (strpos_array($name, $checked_tables) && $checked !== 'field-not-exist') ? 'checked' : '';
    } else {
        $checked_table = (strpos_array($t, $checked_tables) && $checked !== 'field-not-exist') ? 'checked' : '';
    }

    return <<<CHECKBOX
<div class="form-check">
  <label class="form-check-label $checked">
    <input class="form-check-input" type="checkbox" $checked_table value="$name" name="$inputName">
    $name
  </label>
</div>
CHECKBOX;
}

/**
 * Returned array for select tables that should be checked by default
 *
 * @return array
 */
function checked_tables()
{
    return [
        'products',
        'categories',
        'manufacturers',
        'customers',
        'orders',
        'address'
    ];
}

/**
 * Check if should select the table by default or no
 *
 * @param $haystack
 * @param $needles
 * @return bool|false|int
 */
function strpos_array($haystack, $needles)
{
    if (is_array($needles)) {
        foreach ($needles as $str) {
            $pos = strpos($haystack, $str);
            if ($pos !== false) {
                return true;
            }
        }
        return false;
    } else {
        return strpos($haystack, $needles);
    }
}

?>
    <div class="buttons">
        <div class="btn btn-info button-check" data-check="true">Check all</div>
        <div class="btn btn-info button-check" data-check="false">Uncheck all</div>
    </div>
    <form id="oscImportDBTables" method="post">
        <div class="container">
            <?php foreach ($tables as $table) { ?>
                <?php $importFields = '';
                $checkedTable = true;
                $table['name'] = strtolower($table['name']);
                foreach ($table['fields'] as $field) { ?>
                    <?php $checkedFieldClass = isset($solomonoTables[$table['name']]) && in_array(
                        $field['name'],
                        $solomonoTables[$table['name']]
                    ) ? 'field-exist' : 'field-not-exist' ?>
                    <?php $checkedTable = $checkedTable ? isset($solomonoTables[$table['name']]) && in_array(
                        $field['name'],
                        $solomonoTables[$table['name']]
                    ) : false ?>
                    <?php $importFields .= _checkbox($field['name'], [$table['name']], $checkedFieldClass, 'table') ?>
                <?php } ?>
                <?php if (!isset($solomonoTables[$table['name']])) {
                    $checkedTableClass = 'field-not-exist';
                } elseif (!$checkedTable) {
                    $checkedTableClass = 'field-missing';
                } else {
                    $checkedTableClass = 'field-exist';
                } ?>
                <div class="row">
                    <div class="col-sm-3">
                        <?=_checkbox($table['name'], [], $checkedTableClass, 'tables')?>
                    </div>
                    <div class="col-sm-9">
                        <p class="show-fields">Show fields</p>
                        <div class="import-fields hidden">
                            <?=$importFields?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <input type="hidden" name="action" value="submit">
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
<?php
//$sql =  SqlFormatter::removeComments($sql);

//$queries = SqlFormatter::splitQuery($sql);

die;
