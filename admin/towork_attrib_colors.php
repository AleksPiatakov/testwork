<?php   
$rootPath = dirname(dirname($_SERVER['SCRIPT_FILENAME']));
require($rootPath.'/includes/bootstrap.php');
require($rootPath.'/includes/configure.php');
require($rootPath.'/includes/functions/database.php');    

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

   if ($_REQUEST['act']=='read'){
     $zap='SELECT products_options_values_image FROM products_options_values WHERE products_options_values_id='.$_REQUEST['attr'];
     $res = tep_db_query($zap);
     $row = tep_db_fetch_array($res);
     echo $row['products_options_values_image'];

   } elseif ($_REQUEST['act']=='write'){
     $zap='UPDATE products_options_values SET products_options_values_image="'.$_REQUEST['img'].'" WHERE products_options_values_id='.$_REQUEST['attr'];
     $res = tep_db_query($zap);
     echo 'ok';

   } elseif ($_REQUEST['act']=='del'){
     $zap='UPDATE products_options_values SET products_options_values_image="" WHERE products_options_values_id='.$_REQUEST['attr'];
     $res = tep_db_query($zap);
     $path='../images/';
     $randintval = $_REQUEST['fn'];
     if (file_exists($path.$randintval)) {
          unlink($path.$randintval);
          unlink($path."thumb".$randintval);
       echo 'ok';
     }  else echo 'no';
   }
//   die;
}
?>