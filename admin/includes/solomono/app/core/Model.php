<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:23
 */

namespace admin\includes\solomono\app\core;

abstract class Model
{
    const DEBUG = true;
    /**
     * @var table = file_name
     */
    protected $table;
    protected $prefix_id;
    /**
     * @var $folder =folder where class is
     */
    protected $folder;
    protected $language_id;
    protected $allowed_fields;
    public $error;
    public $data;

    abstract public function select();

    public function __construct()
    {
        $this->language_id = $_SESSION['languages_id'] ?: 1;
        $pathToClass = get_class($this);
        $arrExp = explode('\\', $pathToClass);
        $tableName = end($arrExp);
        $folderName = $arrExp[count($arrExp) - 2];
        $this->table = $this->table ?: $tableName;
        $this->folder = $folderName;
        // разрешенные поля для вывода и для формы option
        //example in admin_member admin.php
        if (!empty($this->allowed_fields)) {
            $this->data['allowed_fields'] = $this->allowed_fields;
            if (!isset($_GET['ajax_load']) || $_GET['ajax_load'] != 'show') {
                $this->getOptions();
            }
        }
        if (isset($this->title)) {
            $this->data['title'] = $this->title;
        }
    }

    /**
     * @return table|mixed
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * @return string
     * return key from Allowed fields for sql query
     */

    protected function getField()
    {
        $select = $this->prefix_id . ' as id,' . "`" . implode("`, `", array_keys($this->allowed_fields)) . "`";
        return $select;
    }

    /**
     * @param $request
     * @return array
     * Проверяет запрос на page, perPage,order,search and ID
     * создаёт $this->data['pagination']
     * if(ID==true) return one row
     */

    public function query($request)
    {
        $main_query = $this->select();
        preg_match('/(\bwhere\b)/i', $main_query, $matches);//[0]=>where
        //        $id = $this->getById($request);
        //        if ($id !== '' ) {
        //            $add = $matches ? ' AND ' : " WHERE ";
        //            $main_query = $main_query . $add . "{$this->prefix_id} = {$id}";
        //            return $this->data['data'] = $this->getResult($main_query);
        //        }


        $filter = $this->filter($request);
        $order = $this->order($request);
        $limit = $this->limit($request);
        $connector = $matches ? ' AND ' : ' WHERE ';
        $filter = $filter ? $connector . $filter : '';
        if (strpos($main_query, 'group by')) {
            $main_query = substr_replace($main_query, $filter . ' ', strpos($main_query, 'group by'), 0);
        } else {
            $main_query = $filter ? $main_query . $filter : $main_query;
        }


        $recordsTotal = $request['count'] ?: $this->getResult($main_query, true);
        $this->paginate($recordsTotal, $request['page'], $request['perPage']);


        $this->modal($request);
        $main_query = $main_query . ' ' . $order . ' ' . $limit;

        $this->data['data'] = $this->getResult($main_query);
        $this->debug($main_query, __METHOD__, 'pre');
        $this->debug($this->data['data'], 'DATA');
        $this->debug($this->data['allowed_fields'], 'allowed_fields');
        $this->debug($recordsTotal, 'recordsTotal', 'pre');

        global $login_email_address;
        $this->data['sql'] = !empty($this->data['sql']) ? $this->data['sql'] : [];
        if ($login_email_address == 'admin@solomono.net' && is_array($this->data['sql'])) {
            $this->data['sql'][] = preg_replace(['/\r\n|\r|\n/u', '!\s+!'], ['', ' '], $main_query);
        }
    }

    protected function modal($request)
    {
        if (!empty($request['action'])) {
            $this->data['modal'] = true;
        }
    }

    protected function debug($data, $name = null, $tag = 'p')
    {
        static $cnt = 0;
        $name = $name ?: ++$cnt;
        //        if(self::DEBUG===true){
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' && self::DEBUG === true) {
            if (is_array($data)) {
                $this->data['debug'][$name] = $data;
            } else {
                $this->data['debug'][$name] = "<$tag>$data</$tag>";
            }
        }
    }

    protected function getById($request)
    {
        $id = '';
        if (isset($request['id'])) {
            $id = $request['id'];
        }
        return $id;
    }

    protected function filter($request)
    {
        $columnSearch = [];
        if (isset($request['search']) && count($request['search'])) {
            foreach ($request['search'] as $field => $search) {
                if (!empty($search)) {
                    $columnSearch[] = $field . " LIKE '%" . tep_db_input($search) . "%'";
                }
            }
            $columnSearch = $columnSearch ? implode(' AND ', $columnSearch) : '';
        }
        return $columnSearch;
    }

    protected function order($request)
    {
        $order = '';
        if (isset($request['order']) && strlen($request['order']) && strstr($request['order'], '-')) {
            $order_by = explode('-', $request['order']);
            if (count($order_by) === 2 && in_array($order_by[1], ['asc','desc'])) {
                $order = $this->allowed_fields[$order_by[0]] ? 'ORDER BY ' . $order_by[0] . ' ' . $order_by[1] : '';
            }
        }
        return $order;

    }

    protected function limit($request)
    {
        $limit = '';
        if (isset($request['page']) && $request['perPage']) {
            $start = ($request['page'] - 1) * $request['perPage'];
            $limit = "LIMIT " . intval($start) . ", " . intval($request['perPage']);
        }
        return $limit;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * получить связку
     */
    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                $this->optionFields($field_name, $value['option']);
            }
        }
    }

    public function optionFields($field_name, $value)
    {
        $id = $value['id'];
        $name = $value['title'];
        $table = $value['table'];
        $value['where'] = str_replace('THIS_LANGUAGE_ID', $this->language_id, $value['where']);
        $result = $value['is_empty_value']?['Null'=>($value['empty_value_title']?:'')]:[];
        $where = $value['where'] ? " WHERE " . $value['where'] : '';
        $sql = "SELECT `{$id}`,`{$name}` FROM `{$table}` {$where}";
        $sql = tep_db_query($sql);
        while ($row = tep_db_fetch_array($sql)) {
            $result[$row[$id]] = $row[$name];
        }
        $this->data['option'][$field_name] = $result;
    }

    public function getResult($sql, $count = false)
    {
        $result = [];
        if ($count) {
            $sql = tep_db_query($sql);
            return (int) tep_db_num_rows($sql);
        } else {
            $sql = tep_db_query($sql);
            while ($row = tep_db_fetch_array($sql)) {
                $result[] = $row;
            }
            return $result;
        }

    }

    /**
     * @param $fields
     * @return string
     * Подготовить sql запрос UPDATE || INSERT
     */

    public function prepareFields(array $fields, $table = null, $prefix_id = null)
    {
        global $saveDbPrepareInput;
        $table = is_null($table) ? $this->table : $table;
        $prefix_id = is_null($prefix_id) ? $this->prefix_id : $prefix_id;
        $query = [];
        if (empty($fields['id'])) {
            unset($fields['id']);
        } else {
            $id = $fields['id'];
            unset($fields['id']);
        }
        foreach ($fields as $key => $value) {
            $value = tep_db_prepare_input($value);
            if ($value === null) {
                $query[] = "`{$key}` = null";
            } elseif ($value === 'now()') {
                $query[] = "`{$key}` = now()";
            } else {
                if (!in_array($value, $saveDbPrepareInput)) {
                    $query[] = "`{$key}` = " . '\'' . tep_db_input($value) . '\'';
                }else{
                    $query[] = "`{$key}` = " . '\'' . $value . '\'';
                }
            }
        }
        $query = implode(', ', $query);
        if (isset($id)) {
            $sql = ("UPDATE {$table} SET $query WHERE `{$prefix_id}`='{$id}'");
        } else {
            $sql = ("INSERT INTO {$table} SET $query");
        }
        return $sql;
    }

    /**
     * @param null $view
     * @return string
     */

    public function getView($view = null, $additional_object = null)
    {
        $view = is_null($view) ? $this->folder . '/' . $this->table : $view;
        $obg = new View($view);
        if (!is_null($additional_object)) {
            $obg->setObject($additional_object);
        }
        return $obg->render($this->data, $this->table);
    }


    /**
     * $pattern for get constant
     * from :
     * admin\includes\languages\russian.php
     * admin\includes\languages\currentPage.php
     */
    public function getTranslation()
    {
        global $add_folder;
        $translations = [];
        $pattern = '/define\(\'([a-zA-Z_0-9]+)\'\,\s?\'(.+)\'\)/';
        $current_page = basename($_SERVER['SCRIPT_NAME']);
        $translation = file_get_contents(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
        preg_match_all($pattern, $translation, $trans);
        for ($i = 0; $i < count($trans[1]); $i++) {
            $translations['all'][$trans[1][$i]] = $trans[2][$i];
        }
        if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $current_page)) {
            $translation_current_page = file_get_contents(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $current_page);
            preg_match_all($pattern, $translation_current_page, $transCP);
            for ($i = 0; $i < count($transCP[1]); $i++) {
                $translations['currentPage'][$transCP[1][$i]] = $transCP[2][$i];
            }
        }
        $translations['siteFolder'] = $add_folder;
        return json_encode($translations);
    }

    protected function getResultKey($sql, $id)
    {
        $result = [];
        $sql = tep_db_query($sql);
        while ($row = tep_db_fetch_array($sql)) {
            $result[$row[$id]] = $row;
        }
        return $result;
    }

    protected function getLanguages()
    {
        $sql = "SELECT `languages_id` AS `language_id`,`name`,`code` FROM `languages` WHERE `lang_status`='1'";
        $this->data['languages'] = $this->getResultKey($sql, 'language_id');
    }

    protected function prepareGeneralField(&$data, $glue = ', ')
    {
        $query = [];
        foreach ($data as $k => $v) {
            if (!is_array($v)) {
                $v = tep_db_prepare_input($v);
                $query[] = "`{$k}` = " . '\'' . tep_db_input($v) . '\'';
                unset($data[$k]);
            }
        }

        return implode($glue, $query);
    }

    public function update($data)
    {
        //        $id = $data['id'];
        if (!tep_db_query($data = $this->prepareFields($data))) {
            $this->error = "Error 'update' ({$data})";
            return false;
        }
        //        $this->query(array('id'=>$id));
        return true;
    }

    /**
     * @param $data
     * @return bool
     * Удаляет пустой ключ ID,который передаётся POST-ом
     */
    public function insert($data)
    {
        unset($data['id']);
        if (!tep_db_query($data = $this->prepareFields($data))) {
            $this->error = "Error 'insert'({$data})";
            return false;
        }
        return tep_db_insert_id();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}";
        return tep_db_query($sql);
    }

    protected function insertUpdate($data, $id, $action = 'update', $table = null, $lang = 'language_id')
    {
        $table = $table ?: $this->table;
        $this->getLanguages();
        $languages = $this->data['languages'];

        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $tmp_val = [];
                    foreach ($languages as $lk => $lv) {
                        $tmp_val[$lk] = $value;
                    }
                    $value = $tmp_val;
                }
                $value = tep_db_prepare_input($value[$k]);
                $query .= "`{$key}` = " . '\'' . $value . '\', ';
            }
            $query .= "`{$this->prefix_id}`= {$id}, `{$lang}`={$k}";

            if ($action == 'update') {
                $sql = "INSERT INTO `{$table}` SET {$query} ON DUPLICATE KEY UPDATE {$query}";
            } elseif ($action == 'insert') {
                $sql = "INSERT INTO `{$table}` SET {$query}";
            }
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

    protected function moveUploadFile($tmp_name, $name, $path)
    {
        $uploads_dir = DIR_FS_CATALOG . DIR_WS_IMAGES . $path;
        if (!is_dir($uploads_dir) && strlen($uploads_dir) > 0) {
            @mkdir($uploads_dir, 0777, true);
        }
        if (!move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
            $this->error[] = ERROR_FILE_NOT_SAVED;
            return false;
        }
        return true;
    }

    public function checkFile($field_name, $id = null, $path = null, $allowed_types = [])
    {
        $path = is_null($path) ? $this->table : $path;
        if (!empty($allowed_types) && !in_array($_FILES[$field_name]['type'], $allowed_types)) {
            return false;
        }
        if (!empty($_FILES[$field_name]['name']) && $_FILES[$field_name]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$field_name]["tmp_name"];
            $name = basename($_FILES[$field_name]["name"]);
            $name = $this->generateFilename($name);
            if (!is_null($id)) {
                $this->delFile($id, $field_name);
            }
            if ($this->moveUploadFile($tmp_name, $name, $path)) {
                $_POST[$field_name] = "$path/$name";
            }
        }
    }

    public function generateFilename($string) {
        $string = urldecode($string) ;
        $cyrillic = array("Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M","ж", "ё", "й","ю", "ь","ч", "щ", "ц","у","к","е","н","г","ш", "з","х","ъ","ф","ы","в","а","п","р","о","л","д","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б","і","І","ї","Ї","є","Є");
        $translit = array("q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","zh","yo","i","yu","'","ch","sh","c","u","k","e","n","g","sh","z","h","'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "yе", "jа", "s",  "m",  "i",  "t",  "b",  "yo", "i",  "yu", "ch", "'",  "sh", "c",  "u",  "k",  "e",  "n",  "g",  "sh", "z",  "h",  "'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "zh", "ye", "ja", "s",  "m",  "i",  "t",  "b","i","i","ji","ji","ie","ie");
        $string = str_replace($cyrillic, $translit, $string);
        $string = preg_replace(array('@\s@','@[^a-z0-9\-_\.]+@',"@_+\-+@","@\-+_+@","@\-\-+@","@__+@"), array('_', '', "-","-","-","_"), $string);
        $string = mb_strtolower($string);
        $string = preg_replace('/ /','_',$string); // пробел
        $string = preg_replace('#\(?(\w)\)?#s','$1',$string); // замена скобок
        $string = preg_replace(['/[\p{Han}？]/u', '/(\s)+/'], ['', '$1'], $string); // Удаление иероглифов
        preg_replace('/(?:[^-a-z0-9]|(?<=-)-+)/i', '', $string); // Оставляем только латиницу и цифры
        $string = md5(time()) . $string;
        return $string;
    }

    /**
     * @param $id
     * @param $field
     * @return bool
     * Удаляет файл по полю с ID записи
     */
    public function delFile($id, $field, $table = null)
    {
        $table = is_null($table) ? $this->table : $table;
        $sql = "SELECT `{$field}` FROM `{$table}` WHERE `{$this->prefix_id}` = {$id}";
        $file = $this->getResult($sql)[0];
        if ($file[$field] !== null) {
            $file_path = DIR_FS_CATALOG . DIR_WS_IMAGES;
            if (file_exists($file_path . $file[$field]) && !is_dir($file_path . $file[$field])) {
                @unlink($file_path . $file[$field]);
                return true;
            } elseif (file_exists($file_path . $this->table . DIRECTORY_SEPARATOR . $file[$field]) && !is_dir($file_path . $this->table . DIRECTORY_SEPARATOR . $file[$field])) {
                @unlink($file_path . $this->table . DIRECTORY_SEPARATOR . $file[$field]);
                return true;
            }
            $this->error = TEXT_ERROR_DEL_FILE;
        }
    }

    public function statusUpdate($status, $id, $field = 'status', $table = null, $prefixId = null)
    {
        $table = is_null($table) ? $this->table : $table;
        $prefixId = is_null($prefixId) ? $this->prefix_id : $prefixId;
        $sql = ("UPDATE `{$table}` SET `{$field}`='{$status}' WHERE `{$prefixId}`='{$id}'");
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function paginate($recordsTotal, $current_page, $per_page)
    {
        $this->data['paginate']['count'] = $recordsTotal;
        $this->data['paginate']['current_page'] = $current_page;
        $this->data['paginate']['start'] = $current_page * $per_page - $per_page;
        $this->data['paginate']['total'] = intval(($this->data['paginate']['count'] - 1) / $per_page) + 1;
        $this->data['paginate']['per_page'] = $per_page;
        $this->debug($this->data['paginate'], __METHOD__);
    }

    public function showMsg($trueMsg = TEXT_SAVE_DATA_OK, $falseMsg = false)
    {
        if (!$this->checkErrors()) {
            $msg = $trueMsg;
        } else {
            $msg = $falseMsg ?: implode(";<br>", $this->error);
        }
        return $msg;
    }

    public function checkErrors()
    {
        return is_null($this->error) ? false : true;
    }

}