<?php
ini_set('memory_limit', '100M');
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/bootstrap.php';

$image_cache_arr = parse_ini_file(".env");
if (!isset($image_cache_arr['IMAGE_CACHE'])) {
    $image_cache = false;
} else {
    $image_cache = !!($image_cache_arr['IMAGE_CACHE']);
}

define('IMAGE_CACHE', $image_cache);
$forceJpeg = false;
$base_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
// new sizes view:
$thump_check = explode('/', $_GET['thumb']);
$offset = 0;
if (strpos($thump_check[0], 'x') !== false and count($thump_check) > 1) {
    $dimensions = explode('x', $thump_check[0]);
    if (is_numeric($dimensions[0]) and is_numeric($dimensions[1])) {
        $_GET['w'] = $dimensions[0];
        $_GET['h'] = $dimensions[1];
    }
    $offset++;
} else {
    $image = __DIR__ . '/images/' . $_GET['thumb'];
    if (file_exists($image)) {
        $size = getimagesize($image);
        $_GET['w'] = $size[0];
        $_GET['h'] = $size[1];
    } else {
        $_GET['w'] = $_GET['h'] = 0;
    }
}
if ($thump_check[0] === 'jpeg' || $thump_check[1] === 'jpeg') {
    $forceJpeg = true;
    $offset++;
}
if ($offset) {
    $_GET['thumb'] = implode('/', array_slice($thump_check, $offset));
}

if ($_GET['w'] > 2000) {
    $_GET['w'] = 2000;
}
if ($_GET['h'] > 2000) {
    $_GET['h'] = 2000;
}
if (IMAGE_CACHE === true) {
    $filename = end($thump_check);
    $rotate_folder = isset($_GET['rotate']) ? $_GET['rotate'] . DIRECTORY_SEPARATOR : '' ;
    $file_folder = $base_path . 'cache' . DIRECTORY_SEPARATOR . $_GET['w'] . 'x' . $_GET['h'] . DIRECTORY_SEPARATOR . $rotate_folder;
    $file_name = $file_folder . $filename;
}
if (!empty($_GET['thumb'])) {
    if (IMAGE_CACHE === true) {
        if (file_exists($file_name)) {
            $filename = basename($file_name);
            $file_extension = strtolower(substr(strrchr($filename, "."), 1));

            switch ($file_extension) {
                case "gif":
                    $ctype = "image/gif";
                    break;
                case "png":
                    $ctype = "image/png";
                    break;
                case "webp":
                    $ctype = "image/webp";
                    break;
                case "jpeg":
                case "jpg":
                    $ctype = "image/jpeg";
                    break;
                default:
            }

            header('Content-type: ' . (isUseWebP($ctype) ? 'image/webp' : $ctype));
            readfile($file_name);

            //      file_put_contents('rimg.log','from cache: '.$new_file_path.' '.(microtime(true)-$time).PHP_EOL,FILE_APPEND);
            die;
        }
    }
    if (strpos($_GET['thumb'], 'products/') === false) {
        $watermark = false;
    }

    $image = __DIR__ . '/images/' . $_GET['thumb'];



    if (file_exists($image)) {
        if (strstr(strtolower($image), 'webp') && exif_imagetype($image) === IMAGETYPE_WEBP) {
            // if original webP without width, height, just read it!
            if (!isset($_GET['w']) and !isset($_GET['w'])) {
                header('Content-type: image/webp');
                readfile($image);
                die;
            } else {
                // sometimes getimagesize() does not work for webp
                $img = imagecreatefromwebp($image);
                $image_size['mime'] == 'image/webp';
                $image_size[0] = imagesx($img);
                $image_size[1] = imagesy($img);
                $image_size[2] = 18;
            }
        } else {
            $image_size = getimagesize($image);
        }
    } else {
        $image = __DIR__ . '/images/default.png';
        $image_size = getimagesize($image);
        $watermark = false;
    }

    if (is_array($image_size)) {
        switch ($image_size[2]) {
            case IMAGETYPE_GIF:
                $img = ImageCreateFromGIF($image);
                break;
            case IMAGETYPE_JPEG:
                $img = imagecreatefromjpeg($image);
                break;
            case IMAGETYPE_PNG:
                $img = ImageCreateFromPNG($image);
                break;
            case IMAGETYPE_WEBP:
                if (!$img) {
                    $img = imagecreatefromwebp($image);
                }
                break;
            default:
                $img = false;
        }

        $last_modified_time = filemtime($image);
        $etag = md5_file($image);

        header("Last-Modified: " . gmdate("D, d M Y H:i:s", $last_modified_time) . " GMT");
        header("Etag: $etag");
        header("Cache-Control: must_revalidate, public");

        if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time || trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }
        if (!checkBrowserIE() and function_exists('imagewebp') and !$forceJpeg and ($image_size['mime'] == 'image/jpeg' or ($image_size['mime'] == 'image/png' and (float)phpversion() >= 7.0))) {
            $cont_type = 'image/webp';
        } else {
            $cont_type = $image_size['mime'];
        }

        header("Content-Type: " . $cont_type);

      // load watermark to memory
        if (!empty($watermark)) {
            if (!isset($_GET['w'])) {
                $_GET['w'] = $image_size[0];
            }
            if (!isset($_GET['h'])) {
                $_GET['h'] = $image_size[1];
            }

            // if watermark width > image width, then resize watermark:
            if ($watermark_size[0] >= $image_size[0]) {
                $ratio = 0.7;

                $dst = imagecreatetruecolor($watermark_size[0] * $ratio, $watermark_size[1] * $ratio);
                imagesavealpha($dst, true);
                imagefill($dst, 0, 0, IMG_COLOR_TRANSPARENT);
                imagecopyresampled($dst, $watermark, 0, 0, 0, 0, $watermark_size[0] * $ratio, $watermark_size[1] * $ratio, $watermark_size[0], $watermark_size[1]);
                $watermark = $dst;
                $watermark_size[0] *= $ratio;
                $watermark_size[1] *= $ratio;
            }

            //  bottom right watermark:
            $watermark_pos_x = $image_size[0] - $watermark_size[0];
            $watermark_pos_y = $image_size[1] - $watermark_size[1];

            //  watermark on center:
            /*$background = imagecolorallocate($watermark , 0, 0, 0);
            imagecolortransparent($watermark, $background);
            imagealphablending($watermark, false);
            imagesavealpha($watermark, true);
            $watermark_pos_x = ($image_size[0] - $watermark_size[0])/2;
            $watermark_pos_y = ($image_size[1] - $watermark_size[1])/2; */

            // do no add watermark to small images:
            if ((!empty($_GET['w']) or !empty($_GET['h'])) and ($_GET['w'] < 300 and $_GET['h'] < 300)) {
            } elseif ($image_size[0] < 300 and $image_size[1] < 300) {
            } else {
                imagecopy($img, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, $watermark_size[0], $watermark_size[1]);
            }

            // watermark pave
            //imageSetTile ($img, $watermark); // watermark pave
            //imagefilledrectangle($img,0,0,$image_size[0],$image_size[1],IMG_COLOR_TILED);

            // END watermark
        }

        $current_X = $image_size[0];
        $current_Y = $image_size[1];

        if (($_GET['w'] == '' and $_GET['h'] == '') or ($current_X < $_GET['w'] and $current_Y < $_GET['h'])) {
            $fix_to_X = $current_X;
            $fix_to_Y = $current_Y;
        } else {
            //$fix_to_X = 150;
            //$fix_to_Y = 150;
            if (isset($_GET['w'])) {
                $fix_to_X = $_GET['w'];
            } else {
                $fix_to_X = $_GET['h'] * $current_X / $current_Y;
            }

            if (isset($_GET['h'])) {
                $fix_to_Y = $_GET['h'];
            } else {
                $fix_to_Y = $_GET['w'] * $current_Y / $current_X;
            }
        }

        if (isset($_COOKIE['isMobile']) && $_COOKIE['isMobile'] == 1) {
            if ($image_size[0] > 500) {
                if (isset($_GET['w']) and $_GET['w'] < 500) {
                    $fix_to_X = $_GET['w'];
                } else {
                    $fix_to_X = 500;
                }
            }
            if ($image_size[1] > 500) {
                if (isset($_GET['h']) and $_GET['h'] < 500) {
                    $fix_to_Y = $_GET['h'];
                } else {
                    $fix_to_Y = 500;
                }
            }
        }

      // protection!!
//        Off because don't work with image cache

//        $iOSIncreaseValue = 1.5; //% of width
//        if (isset($_COOKIE['isiOS']) && $_COOKIE['isiOS'] == 1) {
//            if ($image_size[0] > $fix_to_X * $iOSIncreaseValue) {
//                $fix_to_X = $fix_to_X * $iOSIncreaseValue;
//            }
//            if ($image_size[1] > $fix_to_Y * $iOSIncreaseValue) {
//                $fix_to_Y = $fix_to_Y * $iOSIncreaseValue;
//            }
//        }

        if ($current_X > $current_Y) {
            $x = $fix_to_X;            //
            $y = intval($x * $current_Y / $current_X);    //
        } else {
            $y = $fix_to_Y;
            $x = intval($y * $current_X / $current_Y);    //
        }
        if (isset($_GET['r'])) {
            if ($_GET['r'] == 'x') {
                $y = $fix_to_Y;
                $x = intval($y * $current_X / $current_Y);    //
            }
            if ($_GET['r'] == 'y') {
                $x = $fix_to_X;            //
                $y = intval($x * $current_Y / $current_X);    //
            }
        }

        $thumb = imagecreatetruecolor($x, $y);

        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);    //
        imagefill($thumb, 0, 0, IMG_COLOR_TRANSPARENT);
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $x, $y, $current_X, $current_Y);
        imageinterlace($thumb, true);

        if (isset($_GET['rotate'])) {
            $rotate = (int)$_GET['rotate'] > 360 ? 360 : (int)$_GET['rotate'];
            $thumb = imagerotate($thumb, $rotate, 0);
        }

    if (IMAGE_CACHE === true) {
        if (!file_exists($file_name)) {
            if (strstr(strtolower(PHP_OS), 'win')) {
                mkdir($file_folder, 775, true);
            } else {
                system("mkdir -m 775 -p " . $file_folder);
            }
        }
    }

        switch ($image_size[2]) {
            case IMAGETYPE_GIF:
                imagegif($thumb);
                if (IMAGE_CACHE === true) {
                    imagegif($thumb, $file_name);
                }
                break;
            case IMAGETYPE_JPEG:
            case 18:
                if (!checkBrowserIE() and function_exists('imagewebp') and !$forceJpeg) {
                    ob_start();
                    imagewebp($thumb, null, 85);
                    if (ob_get_length() % 2 == 1) {
                        echo "\0"; // fix webp php 5.6 bug: sometimes black image!
                    }
                    ob_end_flush();

                    if (IMAGE_CACHE === true) {
                        imagewebp($thumb, $file_name, 85);
                    }
                } else {
                    imagejpeg($thumb, null, 90);
                    if (IMAGE_CACHE === true) {
                        imagejpeg($thumb, $file_name, 90);
                    }
                }
                break;
            case IMAGETYPE_PNG:
                if ((float)phpversion() >= 7.0 and !checkBrowserIE() and function_exists('imagewebp') and !$forceJpeg) {
                    ob_start();
                    imagewebp($thumb, null, 85);
                    if (ob_get_length() % 2 == 1) {
                        echo "\0"; // fix webp php 5.6 bug: sometimes black image!
                    }
                    ob_end_flush();
                    if (IMAGE_CACHE === true) {
                        imagewebp($thumb, $file_name, 85);
                    }
                } else {
                    imagepng($thumb, null, 8);
                    if (IMAGE_CACHE === true) {
                        imagepng($thumb, $file_name, 9);
                    }
                }

                break;
            default:
                $im_med = false;
        }

  //      file_put_contents('rimg.log','creating: '.$new_file_path.' '.(microtime(true)-$time).PHP_EOL,FILE_APPEND);
        imagedestroy($thumb);

        die;
    } elseif (mime_content_type($image) == 'image/svg+xml') { //svg
        header("Content-Type: image/svg+xml");
        echo file_get_contents($image);
    }
} else {
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function checkBrowserIE()
{
    // ONLY detect IE (all other browsers deleted))
    $fullUserBrowser = $_SERVER['HTTP_USER_AGENT'];
    $userBrowser = explode(')', $fullUserBrowser);
    $userBrowser = $userBrowser[count($userBrowser) - 1];

    if ((!$userBrowser || $userBrowser === '' || $userBrowser === ' ' || strpos($userBrowser, 'like Gecko') === 1) && strpos($fullUserBrowser, 'Windows') !== false) {
        // IE
        return true;
    } else if (isset($_COOKIE['isiOS']) && $_COOKIE['isiOS'] == 1) {
        // SAFARI
        return true;
    }
    return false;
}

/**
 * Check use WebP or not
 *
 * @param string $ctype
 * @return bool
 */
function isUseWebP($ctype) : bool
{
    return (
        !checkBrowserIE() &&
        ($ctype == 'image/jpeg' || ($ctype == 'image/png' && (float) phpversion() >= 7.0)) &&
        function_exists('imagewebp')
    );
}
