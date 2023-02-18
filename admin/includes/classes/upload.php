<?php
/*
  $Id: upload.php,v 1.2 2003/06/20 00:18:30 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class upload {
    var $file, $filename, $destination, $permissions, $extensions, $tmp_filename, $message_location;

    function __construct($file = '', $destination = '', $permissions = '777', $extensions = array('svg', 'gif', 'jpg', 'jpeg', 'png', 'bmp', 'swf', 'sql', 'pdf', 'webp')) {
      $this->set_file($file);
      $this->set_destination($destination);
      $this->set_permissions($permissions);
      $this->set_extensions($extensions);

      $this->set_output_messages('direct');

      if (tep_not_null($this->file) && tep_not_null($this->destination)) {
        $this->set_output_messages('session');
      if ($both='false') {
        if ( ($this->parse() == true) && ($this->save() == true) ) {
          return true;
        } else {
// self destruct
foreach ($this as $key => $val) {
// while(list($key,) = each($this)) {
  $this->$key = null;
}

          return false;
        }
       }
       else {
        if ( ($this->parse() == true) && ($this->save() == true) ) {
          return true;
        } else {
// self destruct
foreach ($this as $key => $val) {
// while(list($key,) = each($this)) {
  $this->$key = null;
}

          return false;
        }       
       } 
      }
    }


    function parse() {
      global $messageStack;

      if (isset($_FILES[$this->file])) {
        $file = array('name' => $_FILES[$this->file]['name'],
                      'type' => $_FILES[$this->file]['type'],
                      'size' => $_FILES[$this->file]['size'],
                      'tmp_name' => $_FILES[$this->file]['tmp_name']);
      } elseif (isset($GLOBALS['HTTP_POST_FILES'][$this->file])) {
        global $_FILES;

        $file = array('name' => $_FILES[$this->file]['name'],
                      'type' => $_FILES[$this->file]['type'],
                      'size' => $_FILES[$this->file]['size'],
                      'tmp_name' => $_FILES[$this->file]['tmp_name']);
      } else {
        $file = array('name' => (isset($GLOBALS[$this->file . '_name']) ? $GLOBALS[$this->file . '_name'] : ''),
                      'type' => (isset($GLOBALS[$this->file . '_type']) ? $GLOBALS[$this->file . '_type'] : ''),
                      'size' => (isset($GLOBALS[$this->file . '_size']) ? $GLOBALS[$this->file . '_size'] : ''),
                      'tmp_name' => (isset($GLOBALS[$this->file]) ? $GLOBALS[$this->file] : ''));
      }

      if ( tep_not_null($file['tmp_name']) && ($file['tmp_name'] != 'none') && is_uploaded_file($file['tmp_name']) ) {
        if (sizeof($this->extensions) > 0) {
          if (!in_array(strtolower(substr($file['name'], strrpos($file['name'], '.')+1)), $this->extensions)) {
            if ($this->message_location == 'direct') {
              $messageStack->add(ERROR_FILETYPE_NOT_ALLOWED, 'error');
            } else {
              $messageStack->add_session(ERROR_FILETYPE_NOT_ALLOWED, 'error');
            }

            return false;
          }
        }

        $this->set_file($file);
        $this->set_filename($file['name']);
        $this->set_tmp_filename($file['tmp_name']);

        return $this->check_destination();
      } else {


        return false;
      }
    }

    function save($filename,$r_wi='',$r_he='',$proporcii='true') {
      global $messageStack;

      if (!$overwrite and file_exists($this->destination . $this->filename)) {
            $messageStack->add_session(TEXT_IMAGE_OVERWRITE_WARNING . $this->filename, 'caution');
            return true;
      } else {

      if (substr($this->destination, -1) != '/') $this->destination .= '/';

      if (move_uploaded_file($this->file['tmp_name'], $this->destination . $this->filename)) {
        chmod($this->destination . $this->filename, $this->permissions);

        if ($this->message_location == 'direct') {
          $messageStack->add(SUCCESS_FILE_SAVED_SUCCESSFULLY, 'success');
        } else {
          $messageStack->add_session(SUCCESS_FILE_SAVED_SUCCESSFULLY, 'success');
        }

$img = $this->destination . $this->filename;


$jpg_quality = 90; // Yuzde olarak JPG kalitesi
$constrain = 1;  // 1 veya 0 : en veya boy her ikiside verilmi?se 1 ayarlay?n, yoksa en veya boydan daralma olur
if($r_wi==''&&$r_he==''){
  $fw = 150;  // k???lt?lecek resmin eni
  $fh = 150;  // k???lt?lecek resmin yuksekligi
}
else {
  $fw = $r_wi;  
  $fh = $r_he; 
}
  $w = $fw;  
  $h = $fh; 
$x = @getimagesize($img); // imaj?n boyutunu ve tipini bulal?m

$sw = $x[0]; // yuklenen resmin eni
$sh = $x[1]; // yuklenen resmin boyu

if ($sw > $w || $sh > $h) { // e?er y?klenen resmin en veya boyu istedi?imiz boyuttan b?y?kse i?leme devm edelim
	if (isset ($w) AND !isset ($h)) { // sadece y?kseklik de?eri verilmi?se
		$h = (100 / ($sw / $w)) * .01;
		$h = @round ($sh * $h);
	} elseif (isset ($h) AND !isset ($w)) { // sadece en de?eri verilmi?se
		$w = (100 / ($sh / $h)) * .01;
		$w = @round ($sw * $w);
	} elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
		// $constrain de?eri ve olu?turulacak resmin boyutunun en ve boy de?eri beraber verilmi?se hangisi uygun ise o boyuta g?re ayarlan?r
		$hx = (100 / ($sw / $w)) * .01;
		$hx = @round ($sh * $hx);

		$wx = (100 / ($sh / $h)) * .01;
		$wx = @round ($sw * $wx);

		if ($hx < $h) {
			$h = (100 / ($sw / $w)) * .01;
			$h = @round ($sh * $h);
		} else {
			$w = (100 / ($sh / $h)) * .01;
			$w = @round ($sw * $w);
		}
	}

	if (function_exists( 'exif_imagetype' )) $img_type = exif_imagetype($img); // bu fonksiyon varm??
	else $img_type = $x[2];

	switch ($img_type) {
	   case 1  : $im = @ImageCreateFromGIF ($img); break;
	   case 2  : $im = @ImageCreateFromJPEG ($img); break;
	   case 3  : $im = @ImageCreateFromPNG ($img); break;
//	   case IMAGETYPE_WBMP : $im = @ImageCreateFromwbmp ($img); break;
	   default : $im = false; // E?er imaj JPEG, PNG, wBMP veya GIF de?ilse
	   }

	if ($im) {
      if($proporcii=='true') {
		$thumb = @ImageCreateTrueColor ($w, $h);
//---------------------raid--------------------------//
		$thumb2 = @ImageCreateTrueColor ($fw, $fh);

        $flol = imagecolorallocate($thumb2, 255, 255, 255); 
		@imageFilledRectangle ($thumb2,0,0,$fw, $fh,$flol);

		@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		@ImageCopyResampled ($thumb2, $thumb, ($fw-$w)/2, ($fh-$h)/2, 0, 0, $w, $h, $w, $h);
		@ImageJPEG ($thumb2, $img, $jpg_quality); // boyutland?r?lm?? imaj? olu?tural?m
		@imagedestroy($thumb2);
        }
      else
 {
		$thumb = @ImageCreateTrueColor ($w, $h);
		@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		
		@imagedestroy($thumb);
//---------------------raid---END----------------------//
        }
        
  	switch ($img_type) {
  	   case 1  : $im = @imagegif ($thumb); // boyutland?r?lm?? imaj? olu?tural?m
  	   case 2  : $im = @imagejpeg ($thumb, $jpg_quality); // boyutland?r?lm?? imaj? olu?tural?m
  	   case 3  : $im = @imagepng ($thumb); break;
  	}
     
	}
}



        return true;
      } else {
        if ($this->message_location == 'direct') {
          $messageStack->add(ERROR_FILE_NOT_SAVED, 'error');
        } else {
          $messageStack->add_session(ERROR_FILE_NOT_SAVED, 'error');
        }

        return false;
      }
    }
}
    function set_file($file) {
      $this->file = $file;
    }

    function set_destination($destination) {
      $this->destination = $destination;
    }

    function set_permissions($permissions) {
      $this->permissions = octdec($permissions);
    }

    function set_filename($filename) {
      $this->filename = $this->sanit_fname($filename);
    }

    function set_tmp_filename($filename) {
      $this->tmp_filename = $filename;
    }

    function set_extensions($extensions) {
      if (tep_not_null($extensions)) {
        if (is_array($extensions)) {
          $this->extensions = $extensions;
        } else {
          $this->extensions = array($extensions);
        }
      } else {
        $this->extensions = array();
      }
    }

    function check_destination() {
      global $messageStack;

      if (!is_writeable($this->destination)) {
        if (is_dir($this->destination)) {
          if ($this->message_location == 'direct') {
            $messageStack->add(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
          } else {
            $messageStack->add_session(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
          }
        } else {
          if ($this->message_location == 'direct') {
            $messageStack->add(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
          } else {
            $messageStack->add_session(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
          }
        }

        return false;
      } else {
        return true;
      }
    }

    function set_output_messages($location) {
      switch ($location) {
        case 'session':
          $this->message_location = 'session';
          break;
        case 'direct':
        default:
          $this->message_location = 'direct';
          break;
      }
    }
    
    function sanit_fname($string) {
			$cyrillic = array("Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M","ж", "ё", "й","ю", "ь","ч", "щ", "ц","у","к","е","н","г","ш", "з","х","ъ","ф","ы","в","а","п","р","о","л","д","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б","і","І","ї","Ї","є","Є");
			$translit = array("q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","zh","yo","i","yu","'","ch","sh","c","u","k","e","n","g","sh","z","h","'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "yе", "jа", "s",  "m",  "i",  "t",  "b",  "yo", "i",  "yu", "ch", "'",  "sh", "c",  "u",  "k",  "e",  "n",  "g",  "sh", "z",  "h",  "'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "zh", "ye", "ja", "s",  "m",  "i",  "t",  "b","i","i","ji","ji","ie","ie");
			$string = str_replace($cyrillic, $translit, $string);
			$string = preg_replace(array('@\s@','@[^a-z0-9\-_\.]+@',"@_+\-+@","@\-+_+@","@\-\-+@","@__+@"), array('_', '', "-","-","-","_"), $string);
			$string = strtolower($string);
			return($string);
    } 
  }
?>
