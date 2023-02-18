<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');
ini_set('display_errors', '1');
require('includes/application_top.php');
if (!function_exists('saveImg')) {
    $imageDownloadCounter = 0;
    $imageFolder = DIR_FS_CATALOG_IMAGES;
    function saveImg($url,$download = false) {
        global $imageFolder,$imageDownloadCounter;
        $imageFolder = $imageFolder ?: DIR_WS_IMAGES;
        $filename_arr = explode('/', $url);
        $filename = end($filename_arr);
        if (!$download) return $filename;
        if ($imageDownloadCounter > 500) die('refresh page');
        if (!file_exists($imageFolder . 'products/' . $filename)) {
            $imageDownloadCounter++;
            $url = explode('/',$url);
            $url[count($url)-1] = str_replace('+','%20',urlencode($url[count($url)-1]));
            $url = implode('/',$url);
            $img = file_get_contents($url);
            $imagesize = getimagesize($url);
            $end = '';
            if ($imagesize["mime"] == 'image/gif') {
                $end = ".gif";
            } elseif ($imagesize["mime"] == 'image/png') {
                $end = ".png";
            } elseif ($imagesize["mime"] == 'image/jpeg') {
                $end = ".jpg";
            }
            $filename = explode('.', $filename);
            array_pop($filename);
            $filename = implode('_', $filename) . $end;
            if (!file_exists($imageFolder . 'products/')) {
                mkdir($imageFolder . 'products/');
            }
            $path = $imageFolder . 'products/' . $filename;
            file_put_contents($path, $img);
        }
        return $filename;
    }
}
$error = $xmlMsg = '';
switch ($_POST['xml_type']){
    case 'fst':
        $xml = $_FILES['xml']['tmp_name'];
        $percent = !empty($_POST['percent']) ? 1+((int)$_POST['percent']/100) : 1;
        require_once 'xml/parse_fst.php';
        break;
    case 'snd':
        $xml = $_FILES['xml']['tmp_name'];
        $percent = !empty($_POST['percent']) ? 1+((int)$_POST['percent']/100) : 1;
        require_once 'xml/parse_snd.php';
        break;
    default:
        break;
}
include_once('html-open.php');
include_once('header.php');
$query = tep_db_query("SELECT cd.categories_id, cd.categories_name 
        FROM categories_description cd 
        LEFT JOIN categories c ON c.categories_id = cd.categories_id
        WHERE c.parent_id = '0'");
$categories = [];
while ($row = tep_db_fetch_array($query)){
    $categories[$row['categories_id']] = $row['categories_name'];
}
?>

<div class="container">
    <h1>Xml import</h1>
    <?php if ($error): ?>
        <div class="btn-danger btn-rounded padder-v m-b-sm">
            <?=$error?>
        </div>
    <?php endif; ?>
    <?php if ($xmlMsg): ?>
        <div class="btn-success btn-rounded padder-v m-b-sm">
           <?=$xmlMsg?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-12">
            <form method="post" enctype="multipart/form-data" onsubmit="document.getElementById('xmlsubmit').disabled = true;">
                <div class="form-group">
                    <select name="xml_type" required class="form-control">
                        <option disabled selected value="">Select xml type</option>
                            <option value="fst">ledking.gr</option>
                            <option value="snd">data-media.gr</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="xml1">Select xml</label>
                    <input type="file" name="xml" class="form-control" required>
                </div>
                <?php /*
                <div class="form-group">
                    <select name="cat_id" required class="form-control">
                        <option disabled selected value="">Select category</option>
                        <?php foreach ($categories as $id=>$name): ?>
                            <option value="<?=$id?>"><?=$name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                */
                ?>
                <div class="form-group">
                    <label for="percent">Increase all prices by %
                        <input type="number" name="percent" value="50" class="form-control" required>
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Insert
                        <input type="radio" name="type" value="insert" class="form-control" required>
                    </label>
                    <label for="type">Update
                        <input type="radio" name="type" value="update" class="form-control" required checked>
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" id="xmlsubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
