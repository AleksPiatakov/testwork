<?php
ini_set('memory_limit', '100M');

  chdir('../../images/');

  // load watermark to memory
  $watermark_path = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . $_GET['watermark'];
if (file_exists($watermark_path)) {
      $watermark_size = getimagesize($watermark_path);
    if ($watermark_size['mime'] == 'image/png') {
        $watermark = imagecreatefrompng($watermark_path);
    }
}
  include('../r_imgs.php');
