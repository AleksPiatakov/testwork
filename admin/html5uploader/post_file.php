<?php
ini_set('memory_limit', '100M');

if ($_REQUEST['opid'] == 'second') {
    $myfile = 'files';
} else {
    $myfile = 'pic';
}

require_once __DIR__ . '/../../vendor/autoload.php';
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
require($rootPath . '/includes/bootstrap.php');
require($rootPath . '/includes/configure.php');
require($rootPath . '/includes/functions/database.php'); // include server parameters

$configuration_query = tep_db_query('select configuration_value as cfgValue from configuration WHERE configuration_key = "SET_HTTPS"');
$set_https = tep_db_fetch_array($configuration_query)['cfgValue'];

define('HTTP_SERVER', (($set_https == 'true') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $add_folder);
$adminPath = dirname(dirname($_SERVER['SCRIPT_NAME']));

if ($_REQUEST['opid'] == 'second') {
    $upload_dir = $path . 'images/downloads/' . (int)$_REQUEST['pid'] .  '/';
} else {
    $upload_dir = $path . 'images/products/';
}
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$r_json_array = array();
if ($_REQUEST['opid'] == 'second') {
    $allowed_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp', 'video/mp4', 'video/avi', 'video/mov',
        'application/octet-stream', 'application/zip', 'application/vnd.rar', 'application/rtf', 'application/epub+zip',
        'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/x-7z-compressed', 'text/csv', 'text/plain'
    ];
} else { //загрузка только картинок*/
    $allowed_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp', 'video/mp4', 'video/avi', 'video/mov'];
}

function clearImageCache($name)
{
    global $path;
    $cache_folder = $path . 'images/cache/';
    if(file_exists($cache_folder)){
        $it = new RecursiveDirectoryIterator($cache_folder);
        foreach (new RecursiveIteratorIterator($it) as $file) {
            if (strtolower($file->getBasename()) === strtolower($name))
                unlink($file->getRealPath());
        }
    }
}

if ($_REQUEST['act'] == 'read') {

    if ($_REQUEST['opid'] == 'first') {
        $zap = tep_db_query('SELECT products_image FROM products WHERE products_id=' . (int)$_REQUEST['pid']);
        $row = tep_db_fetch_array($zap);
        $oldarray = array_values(array_filter(explode(';', $row['products_image'])));
        if (!empty($oldarray[0])) echo json_encode($oldarray);

    } else if ($_REQUEST['opid'] == 'second') {
        $zap = tep_db_query('SELECT products_file FROM products_to_download WHERE products_id=' . (int)$_REQUEST['pid']);

        while ($row = tep_db_fetch_array($zap)) {
            $oldarray[] = $row['products_file'];
        }

        if (!empty($oldarray[0])) echo json_encode($oldarray);

    } else {
        $zap = tep_db_query('SELECT pa_imgs FROM products_attributes WHERE options_values_id=' . (int)$_REQUEST['opid'] . ' and products_id=' . (int)$_REQUEST['pid']);
        $row = tep_db_fetch_array($zap);
        $oldarray = array_values(array_filter(explode('|', $row['pa_imgs'])));
        if (!empty($oldarray[0])) echo json_encode($oldarray);
    }
} elseif ($_REQUEST['act'] == 'custom_update') {

    function rearrange_files($arr)
    {
        foreach ((array)$arr as $key => $all) {
            foreach ($all as $i => $val) {
                $new_array[$i][$key] = $val;
            }
        }
        return $new_array;
    }

    $files_array = rearrange_files($_FILES[$myfile]);

    foreach ($files_array as $_file) {
        if (!in_array($_file['type'], $allowed_types)) {
            $_file['error'] = 1;
        }
        if ($_file['error'] == 0) {
            $uploadfile = sanit_fname($_file['name']); // проверка на кривые символы
            $tmpfile = $_file['tmp_name'];
            $r_name = check_name($upload_dir, $uploadfile, $tmpfile);
            $file = $r_name;
            $orig_directory = $upload_dir;      //Папка для полноразмерных изображений
            //    $thumb_directory = $upload_dir.'thumb';       //Папка для миниатюр

            //Проверяем, что папка открыта и в ней есть файлы
            /*
                        $allowed_image_types = array('jpg', 'jpeg', 'gif', 'png'); // Список обрабатываемых расширений
                        $file_parts = array();
                        $ext = '';
                        $title = '';
                        $i = 0;

                        $file = $r_name;

                        // Пропускаем системные файлы:
                        if ($file == '.' || $file == '..') return;

                        $file_parts = explode('.', $file);     //Разделяем имя файла на части
                        $ext = strtolower(array_pop($file_parts));

                        // Используем имя файла (без расширения) как заголовок изображения:
                        $title = implode('.', $file_parts);
                        $title = htmlspecialchars($title);

                        // Если расширение входит в список обрабатываемых:
                        if (in_array($ext, $allowed_image_types)) {
                            //    resize_image($_REQUEST['img_w'], $_REQUEST['img_h'], $thumb_directory, $file, $orig_directory . $file); // thumb от загруженной кратинки
                        }
            */
            if ($_GET['opid'] == 'first') {
                $zap = tep_db_query('SELECT products_image FROM products WHERE products_id=' . (int)$_GET['pid']);
                $row = tep_db_fetch_array($zap);

                if (!empty($row['products_image'])) {
                    $oldnames = $row['products_image'];
                    $oldarray = array_values(array_filter(explode(';', $row['products_image'])));
                    if (!in_array($file, $oldarray)) {
                        $oldnames .= ';' . $file;
                    }
                } else $oldnames = $file;
                if (strlen($oldnames) < 500) {
                    $zap = 'UPDATE products SET products_image="' . $oldnames . '" WHERE products_id=' . (int)$_GET['pid'];
                    $res = tep_db_query($zap);
                }
                $r_json_array['products_image'] = $oldnames;

                $r_json_array['status'] = 'go';
                $r_json_array['current'] = $file;

//           echo json_encode($r_json_array);
            } else if ($_GET['opid'] == 'second') { //загрузка файлов
                $data = [
                    'products_id' => $_GET['pid'],
                    'products_file' => $file,
                ];
                tep_db_perform('products_to_download', $data);

            } else {
                $zap = tep_db_query('SELECT pa_imgs FROM products_attributes WHERE options_values_id=' . (int)$_GET['opid'] . ' and products_id=' . (int)$_GET['pid']);
                $row = tep_db_fetch_array($zap);

                if (!empty($row['pa_imgs'])) {
                    $oldnames = $row['pa_imgs'];
                    $oldarray = array_values(array_filter(explode('|', $row['pa_imgs'])));
                    if (!in_array($file, $oldarray)) {
                        $oldnames .= '|' . $file;
                    }
                } else {
                    $oldnames = $file;
                }
                $zap = 'UPDATE products_attributes SET pa_imgs="' . $oldnames . '" WHERE options_values_id=' . (int)$_GET['opid'] . ' and products_id=' . (int)$_GET['pid'];
                $res = tep_db_query($zap);
                $r_json_array['products_image'] = $oldnames;

                $r_json_array['status'] = 'go';
                $r_json_array['current'] = $file;
                echo json_encode($r_json_array);
            }
        }
        if ($_REQUEST['opid'] == 'second') {
            $tabname = 'downloads';
        } else {
            $tabname = 'images';
        }

        $url = HTTP_SERVER . '/' . $admin . '/products.php?pID=' . $_REQUEST['pid'] . '&cPath=' . $_REQUEST['cPath'] . '&action=new_product#' . $tabname;
        header('Location:' . $url);
//        exit;
    }


} elseif ($_REQUEST['act'] == 'update') {
    if (isset($_GET['opid']) && $_GET['opid'] == 'second') {
        $myfile = 'files';
        $upload_dir = $path . 'images/downloads/' . (int)$_REQUEST['pid'] .  '/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
    }
    $uploadfile = sanit_fname($_FILES[$myfile]['name']); // проверка на кривые символы
    $tmpfile = $_FILES[$myfile]['tmp_name'];

    $r_name = check_name($upload_dir, $uploadfile, $tmpfile);
    $file = $r_name;
    /*
        $orig_directory = $upload_dir;        //Папка для полноразмерных изображений
    //$thumb_directory = $upload_dir.'thumb';      	//Папка для миниатюр

        //Проверяем, что папка открыта и в ней есть файлы

            $allowed_image_types = array('jpg', 'jpeg', 'gif', 'png'); // Список обрабатываемых расширений
            $file_parts = array();
            $ext = '';
            $title = '';
            $i = 0;

            $file = $r_name;

            // Пропускаем системные файлы:
            if ($file == '.' || $file == '..') return;

            $file_parts = explode('.', $file);        //Разделяем имя файла на части
            $ext = strtolower(array_pop($file_parts));

            // Используем имя файла (без расширения) как заголовок изображения:
            $title = implode('.', $file_parts);
            $title = htmlspecialchars($title);

            // Если расширение входит в список обрабатываемых:
            if (in_array($ext, $allowed_image_types)) {
                //   resize_image($_REQUEST['img_w'], $_REQUEST['img_h'], $thumb_directory, $file, $orig_directory . $file); // thumb от загруженной кратинки
            }
        */
    if ($_GET['opid'] == 'first') {
        $zap = tep_db_query('SELECT products_image FROM products WHERE products_id=' . (int)$_GET['pid']);
        $row = tep_db_fetch_array($zap);

        if (!empty($row['products_image'])) {
            $oldnames = $row['products_image'];
            $oldarray = array_values(array_filter(explode(';', $row['products_image'])));
            if (!in_array($file, $oldarray)) {
                $oldnames .= ';' . $file;
            }
        } else $oldnames = $file;
        $zap = 'UPDATE products SET products_image="' . $oldnames . '" WHERE products_id=' . (int)$_GET['pid'];
        $res = tep_db_query($zap);
        $r_json_array['products_image'] = $oldnames;

        $r_json_array['status'] = 'go';
        $r_json_array['current'] = $file;
        echo json_encode($r_json_array);

    } else if ($_GET['opid'] == 'second') {
        $data = [
            'products_id' => (int)$_GET['pid'],
            'products_file' => $file,
        ];
        tep_db_perform('products_to_download', $data);
        $r_json_array['status'] = 'go';
        $r_json_array['current'] = $file;
        echo json_encode($r_json_array);

    } else {
        $zap = tep_db_query('SELECT pa_imgs FROM products_attributes WHERE options_values_id=' . (int)$_GET['opid'] . ' and products_id=' . (int)$_GET['pid']);
        $row = tep_db_fetch_array($zap);

        if (!empty($row['pa_imgs'])) {
            $oldnames = $row['pa_imgs'];
            $oldarray = array_values(array_filter(explode('|', $row['pa_imgs'])));
            if (!in_array($file, $oldarray)) {
                $oldnames .= '|' . $file;
            }
        } else $oldnames = $file;
        $zap = 'UPDATE products_attributes SET pa_imgs="' . $oldnames . '" WHERE options_values_id=' . (int)$_GET['opid'] . ' and products_id=' . (int)$_GET['pid'];
        $res = tep_db_query($zap);
        $r_json_array['products_image'] = $oldnames;

        $r_json_array['status'] = 'go';
        $r_json_array['current'] = $file;
        echo json_encode($r_json_array);
    }


} elseif ($_REQUEST['act'] == 'del') {
    if ($_REQUEST['opid'] == 'first' or $_REQUEST['opid'] == '' or $_REQUEST['opid'] == 'undefined') {
        $zap = tep_db_query('SELECT products_image FROM products WHERE products_id=' . (int)$_REQUEST['pid']);
        $row = tep_db_fetch_array($zap);

        if (!empty($row['products_image'])) {
            $oldnames = $row['products_image'];
            $oldarray = array_values(array_filter(explode(';', $row['products_image'])));
            if (in_array($_REQUEST['img'], $oldarray)) {
                $key = array_search($_REQUEST['img'], $oldarray);
                unset($oldarray[$key]);
            }
            $oldnames = implode(';', $oldarray);
        }
        $zap = 'UPDATE products SET products_image="' . $oldnames . '" WHERE products_id=' . (int)$_REQUEST['pid'];
        $res = tep_db_query($zap);
    } else if ($_REQUEST['opid'] == 'second') { //удаление файлов
        $zap = "DELETE FROM products_to_download WHERE products_id='" . (int)$_REQUEST['pid'] . "' AND products_file='" . tep_db_prepare_input($_REQUEST['file']) . "'";
        $res = tep_db_query($zap);
        //status
        $key = 'ok';

    } else {
        $zap = tep_db_query('SELECT pa_imgs FROM products_attributes WHERE options_values_id=' . (int)$_REQUEST['opid'] . ' and products_id=' . (int)$_REQUEST['pid']);
        $row = tep_db_fetch_array($zap);

        if (!empty($row['pa_imgs'])) {
            $oldnames = $row['pa_imgs'];
            $oldarray = array_values(array_filter(explode('|', $row['pa_imgs'])));
            if (in_array($_REQUEST['img'], $oldarray)) {
                $key = array_search($_REQUEST['img'], $oldarray);
                unset($oldarray[$key]);
            }
            $oldnames = implode('|', $oldarray);
        }
        $zap = 'UPDATE products_attributes SET pa_imgs="' . $oldnames . '" WHERE options_values_id=' . (int)$_REQUEST['opid'] . ' and products_id=' . (int)$_REQUEST['pid'];
        $res = tep_db_query($zap);
    }
    $_REQUEST['img'] = urldecode($_REQUEST['img']);
    $file2del_lrg = $upload_dir . $_REQUEST['img'];
    $allImg=tep_db_query('SELECT products_image FROM products WHERE products_image LIKE"%'.$_REQUEST['img'].'%"');
    $thisImageExistInOtherProd = $allImg->num_rows;
    $r_json_array['status'] = $key;

    echo json_encode($r_json_array);
    if (!$thisImageExistInOtherProd && file_exists($file2del_lrg)) {
        @unlink($file2del_lrg);
    }
//		 $file2del_sma = $path.'/images/thumb'.$_REQUEST['img'];
//    if(file_exists($file2del_sma)) @unlink($file2del_sma);

} elseif ($_REQUEST['act'] == 'sort') {

    if ($_REQUEST['opid'] == 'first' or $_REQUEST['opid'] == '' or $_REQUEST['opid'] == 'undefined') {
        $oldnames = str_replace(',', ';', $_REQUEST['order']);
        $zap = 'UPDATE products SET products_image="' . $oldnames . '" WHERE products_id=' . (int)$_REQUEST['pid'];
        $res = tep_db_query($zap);
    } else {
        $oldnames = str_replace(',', '|', $_REQUEST['order']);
        $zap = 'UPDATE products_attributes SET pa_imgs="' . $oldnames . '" WHERE options_values_id=' . (int)$_REQUEST['opid'] . ' and products_id=' . (int)$_REQUEST['pid'];
        $res = tep_db_query($zap);
    }
    $r_json_array['status'] = 'ok';
    $r_json_array['opid'] = $_REQUEST['opid'];
    echo json_encode($r_json_array);

} elseif ($_REQUEST['act'] == 'crop') { // -----------ОБРЕЗАНИЕ-----------
    $tmp_array = explode('?', $_REQUEST['fn']);
    $_REQUEST['fn'] = $tmp_array[0];

    $_REQUEST['v_w'] = (int)$_REQUEST['v_w'];
    $_REQUEST['v_h'] = (int)$_REQUEST['v_h'];
    $_REQUEST['v_x'] = (int)$_REQUEST['v_x'];
    $_REQUEST['v_y'] = (int)$_REQUEST['v_y'];

    $source = $upload_dir . $_REQUEST['fn'];

    $stype = explode(".", $source);
    $stype = $stype[count($stype) - 1];

    switch ($stype) {
        case 'gif':
            $img_r = imagecreatefromgif($source);
            break;
        case 'jpg':
            $img_r = imagecreatefromjpeg($source);
            break;
        case 'jpeg':
            $img_r = imagecreatefromjpeg($source);
            break;
        case 'png':
            $img_r = imagecreatefrompng($source);
            break;
    }

    $dst_r = ImageCreateTrueColor($_REQUEST['v_w'], $_REQUEST['v_h']);
    imagealphablending($dst_r, false); // красивая прозрачность для временной картинки
    imagesavealpha($dst_r, true);
    $background = imagecolorallocate($dst_r, 0, 0, 0);
    ImageColorTransparent($dst_r, $background);

    imagecopyresampled($dst_r, $img_r, 0, 0, $_REQUEST['v_x'], $_REQUEST['v_y'],
        $_REQUEST['v_w'], $_REQUEST['v_h'], $_REQUEST['v_w'], $_REQUEST['v_h']);

    $r_json_array['status'] = $_REQUEST['v_x'];
    echo json_encode($r_json_array);

    switch ($stype) {
        case 'gif':
            imagegif($dst_r, $source);
            break;
        case 'jpg':
            imagejpeg($dst_r, $source, 80);
            break;
        case 'jpeg':
            imagejpeg($dst_r, $source, 80);
            break;
        case 'png':
            imagepng($dst_r, $source);
            break;
    }
    clearImageCache($_REQUEST['fn']);

    //	  $thumb_name = 'thumb'.$_REQUEST['fn'];

    //   resize_image($_REQUEST['img_w'], $_REQUEST['img_h'], $upload_dir, $thumb_name, $source); // thumb от обрезанной кратинки

}

// Helper functions

function exit_status($str)
{
    $r_json_array['status'] = $str;
    echo json_encode($r_json_array);
    exit;
}

function get_extension($file_name)
{
    $ext = explode('.', $file_name);
    $ext = array_pop($ext);
    return strtolower($ext);
}

function check_name($uploaddir, $uploadfile, $tmpfile)
{

    if (file_exists($uploaddir . $uploadfile)) {
        /*
            $rexplode = explode('.', $uploaddir.$uploadfile); // разрезаем имя по точкам
            $ri = count($rexplode) - 1; // извращаемся на случай, если в названии файла были еще точки
            $rextension = $rexplode[$ri]; // расширение файла нашли
            $rlen = strlen($rextension)+1;
            $new_name = substr($uploadfile, 0, -$rlen);
            $picture = $new_name.'_.'.$rextension;
            */
        $img_name = $uploadfile;
        if (preg_match_all('#\((.*?)\)\.#', $img_name, $matches_tmp) and preg_match_all('#\((.*?)\)#', $img_name, $matches)) { // если есть чтото в кавычках перед точкой
            $last_el = $matches[1][count($matches[1]) - 1]; // ищем последние кавычки в названии
            $newimage_file = preg_replace('/\(' . $last_el . '\)\./', '(' . ($last_el + 1) . ').', $img_name);  // увеличиваем значение на 1
        } else {
            $curr_img_name = explode('.', $img_name);
            $extension = $curr_img_name[count($curr_img_name) - 1];
            unset($curr_img_name[count($curr_img_name) - 1]);
            $newimage_file = implode('.', $curr_img_name) . '(1).' . $extension;
        }
        $picture = $newimage_file;

        return check_name($uploaddir, $picture, $tmpfile);
    } else {
        $stype = explode(".", $uploadfile);
        $stype = $stype[count($stype) - 1];
        if ($stype == 'gif' or $stype == 'jpg' or $stype == 'jpeg' or $stype == 'png') {
            resize_image(3000, 3000, $uploaddir, $uploadfile, $tmpfile);
        } else {
            if (strlen($uploadfile) > 100) $uploadfile = substr($uploadfile, 0, 32);
            move_uploaded_file($tmpfile, $uploaddir . $uploadfile);
            chmod($uploaddir . $uploadfile, 0777);
        }

        return $uploadfile;
    }
}

// ---------------перевод с кирилицы и всякие проверки-------------------------
function sanit_fname($string)
{
    $string = urldecode($string);
    $cyrillic = array("Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M", "ж", "ё", "й", "ю", "ь", "ч", "щ", "ц", "у", "к", "е", "н", "г", "ш", "з", "х", "ъ", "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "э", "я", "с", "м", "и", "т", "б", "Ё", "Й", "Ю", "Ч", "Ь", "Щ", "Ц", "У", "К", "Е", "Н", "Г", "Ш", "З", "Х", "Ъ", "Ф", "Ы", "В", "А", "П", "Р", "О", "Л", "Д", "Ж", "Э", "Я", "С", "М", "И", "Т", "Б", "і", "І", "ї", "Ї", "є", "Є");
    $translit = array("q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m", "zh", "yo", "i", "yu", "'", "ch", "sh", "c", "u", "k", "e", "n", "g", "sh", "z", "h", "'", "f", "y", "v", "a", "p", "r", "o", "l", "d", "yе", "jа", "s", "m", "i", "t", "b", "yo", "i", "yu", "ch", "'", "sh", "c", "u", "k", "e", "n", "g", "sh", "z", "h", "'", "f", "y", "v", "a", "p", "r", "o", "l", "d", "zh", "ye", "ja", "s", "m", "i", "t", "b", "i", "i", "ji", "ji", "ie", "ie");
    $string = str_replace($cyrillic, $translit, $string);
    $string = preg_replace(array('@\s@', '@[^a-z0-9\-_\.]+@', "@_+\-+@", "@\-+_+@", "@\-\-+@", "@__+@"), array('_', '', "-", "-", "-", "_"), $string);
    $string = mb_strtolower($string);
    $string = preg_replace('/ /', '_', $string); // пробел
    $string = preg_replace('#\(?(\w)\)?#s', '$1', $string); // замена скобок
    $string = preg_replace(['/[\p{Han}？]/u', '/(\s)+/'], ['', '$1'], $string); // Удаление иероглифов
    preg_replace('/(?:[^-a-z0-9]|(?<=-)-+)/i', '', $string); // Оставляем только латиницу и цифры
    //$string = md5(time()) . $string;
    //$mime = substr($string, strrpos($string, '.') + 1); //чистое расширение без точки
    // длина расширения с точкой (strlen($mime) + 1)
    //длина имени без расширения: strlen($string) - (strlen($mime) + 1)
    //$name = substr($string, 0, strlen($string) - (strlen($mime) + 1)); //имя = длина строки - длин расширения
    //$name = substr($name, -16); //обрезаем имя по 16 символов с конца
    //$string = $name . '.' . $mime; //новое имя

    return $string;
}

function resize_image($new_w, $new_h, $uploaddir, $uploadfile, $source)
{
    $stype = explode(".", $uploadfile);
    $stype = $stype[count($stype) - 1];
    $dest = $uploaddir . $uploadfile;

    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];

    if ($new_w > $w and $new_h > $h) {
        move_uploaded_file($source, $dest); // если размер картинки меньше чем тот что мы задали то НЕ растягиваем
    } else {

        switch ($size[2]) {
            case 1:
                $simg = imagecreatefromgif($source);
                break;
            case 2:
                $simg = imagecreatefromjpeg($source);
                break;
            case 3:
                $simg = imagecreatefrompng($source);
                break;
        }

        if ($w > $h) {
            $r_height = $new_w * $h / $w;
            $r_width = $new_w;
        } else {
            $r_height = $new_h;
            $r_width = $new_h * $w / $h;
        }

        $dimg = imagecreatetruecolor($r_width, $r_height);
        imagealphablending($dimg, false); // красивая прозрачность для временной картинки
        imagesavealpha($dimg, true);
        $background = imagecolorallocate($dimg, 0, 0, 0);
        ImageColorTransparent($dimg, $background);
        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $r_width, $r_height, $w, $h);

        switch ($stype) {
            case 'gif':
                imagegif($dimg, $dest);
                break;
            case 'jpg':
                imagejpeg($dimg, $dest, 80);
                break;
            case 'jpeg':
                imagejpeg($dimg, $dest, 80);
                break;
            case 'png':
                imagepng($dimg, $dest);
                break;
        }
    }

    chmod($uploaddir . $uploadfile, 0777);
}

?>