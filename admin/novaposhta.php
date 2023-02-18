<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');
define('WAREHOUSE_ID_1','841339c7-591a-42e2-8233-7a0a00f0ed6f'); //Поштове відділення
define('WAREHOUSE_ID_2','9a68df70-0267-42a8-bb5c-37f427e36ee4'); //Вантажне відділення
define('WAREHOUSE_ID_3','6f8c7162-4b72-4b0a-88e5-906948c6a92f'); //parcel shop
define('WAREHOUSE_ID_5','f9316480-5f2d-425d-bc2c-ac7cd29decf0'); //Поштомат
define('WAREHOUSE_ID_4','cab18137-df1b-472d-8737-22dd1d18b51d'); //Поштомат InPost
define('WAREHOUSE_ID_6','95dc212d-479c-4ffb-a8ab-8c1b9073d0bc'); //Поштомат приват банку
//function debug($var){
//	echo '<pre>';var_dump($var);die;
//}
$table_sql="CREATE TABLE IF NOT EXISTS `novaposhta_warehouses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `np_id` INT NOT NULL ,
  `language_id` INT NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `city` VARCHAR(255) NOT NULL ,
  `phone` VARCHAR(32) NOT NULL ,
  `type` VARCHAR(255) NOT NULL  ,
  `number` INT NOT NULL ,
  `lng` VARCHAR(255) NOT NULL ,
  `lat` VARCHAR(255) NOT NULL
   , PRIMARY KEY (`id`)
   , UNIQUE KEY (`language_id`,`np_id`)
 ) ENGINE=MyISAM";

// Include application configuration parameters

$rootPath=dirname(dirname($_SERVER['SCRIPT_FILENAME']));
require $rootPath . '/vendor/autoload.php';
require($rootPath.'/includes/bootstrap.php');
require('includes/configure.php');
require('includes/filenames.php');
require('includes/database_tables.php');
require('includes/functions/general.php');
require_once DIR_FS_DOCUMENT_ROOT . DIR_WS_FUNCTIONS . 'constants.php';
// include the database functions
require('includes/functions/database.php');
include( 'includes/classes/language.php');
$lng = new language();
include 'includes/classes/novaposhta.class.php';
include 'includes/modules/novaposhta/novaposhta_api.php';
$novaposhtaApi = new NovaPoshtaAPI();
tep_db_connect() or die('Unable to connect to database server!');
tep_db_query($table_sql);

//$method = $_SERVER['REQUEST_METHOD'];
$method = $_REQUEST['action'];

switch ($method) {
    case 'update_novaposhta_warehouses':
        $novaposhta_API_KEY = $_REQUEST['api-key'];
        $np = new NP($novaposhta_API_KEY);
        $params = [
            'Language'=>'ru',
        ];
        $wa = $np->request('AddressGeneral','getWarehouses',$params);
        // debug($wa);
        define('LANG_ID_RU',$lng->catalog_languages['ru']['id']);
        define('LANG_ID_UK',$lng->catalog_languages['uk']['id']);
        if ($wa['success']){
            tep_db_query("TRUNCATE TABLE `novaposhta_warehouses`");
            foreach ($wa['data'] as $key => $warehouse) {
                $warehouse = array_map(function($val){return is_array($val)?$val:htmlspecialchars_decode(addslashes($val));},$warehouse);
                if (LANG_ID_UK) {
                    tep_db_query("INSERT INTO novaposhta_warehouses
                                    (np_id,language_id,name,address,city,phone,type,number,lng,lat)
                                    VALUES('{$warehouse['SiteKey']}'," . LANG_ID_UK . ",'{$warehouse['Description']}','{$warehouse['ShortAddress']}','{$warehouse['CityDescription']}','{$warehouse['Phone']}','{$warehouse['TypeOfWarehouse']}','{$warehouse['Number']}','{$warehouse['Longitude']}','{$warehouse['Latitude']}')
                                    ON DUPLICATE KEY UPDATE
                                    name=VALUES(name),address=VALUES(address),city=VALUES(city),phone=VALUES(phone),type=VALUES(type),number=VALUES(number),lng=VALUES(lng),lat=VALUES(lat)");
                }
                if (LANG_ID_RU) {
                    tep_db_query("INSERT INTO novaposhta_warehouses
                                                (np_id,language_id,name,address,city,phone,type,number,lng,lat)
                                                VALUES('{$warehouse['SiteKey']}'," . LANG_ID_RU . ",'{$warehouse['DescriptionRu']}','{$warehouse['ShortAddressRu']}','{$warehouse['CityDescriptionRu']}','{$warehouse['Phone']}','{$warehouse['TypeOfWarehouse']}','{$warehouse['Number']}','{$warehouse['Longitude']}','{$warehouse['Latitude']}')
                                                ON DUPLICATE KEY UPDATE
                                                name=VALUES(name),address=VALUES(address),city=VALUES(city),phone=VALUES(phone),type=VALUES(type),number=VALUES(number),lng=VALUES(lng),lat=VALUES(lat)");
                }
            }

            $response = [
                'status'  => true,
                'msg' => 'Загружено: ' . $wa["info"]["totalCount"] . ' отделений.',
            ];
            echo json_encode($response);
        }else{
            foreach ($wa['errors'] as $key => $errorText) {
                $response = [
                    'status'  => false,
                    'msg' => 'Ошибка: ' . $errorText . ' !',
                ];
                echo json_encode($response);
                file_put_contents('novaposhta.log', date("Y-m-d H:i:s").' '.$wa['errorCodes'][$key].' - '.$errorText.PHP_EOL,FILE_APPEND);
            }
        }
        break;

    case 'update_novaposhta_areas':

        $dataAreas = $novaposhtaApi->update("areas");
        $dataWarehouses = $novaposhtaApi->update("warehouses");

        if($dataAreas) {
            $response = [
                'status'  => true,
                'msg' => 'Загружено: ' . $dataAreas . ' областей.',
            ];
            echo json_encode($response);
        }else{
            $response = [
                'status'  => false,
                'msg' => 'Ошибка !',
            ];
            echo json_encode($response);
        }
        break;

    case 'update_novaposhta_cities':

        $dataCities = $novaposhtaApi->update("cities");

        if($dataCities) {
            $response = [
                'status'  => true,
                'msg' => 'Загружено: ' . $dataCities . ' городов.',
            ];
            echo json_encode($response);
        }else{
            $response = [
                'status'  => false,
                'msg' => 'Ошибка !',
            ];
            echo json_encode($response);
        }
        break;

    case 'update_novaposhta_references':

        $dataReferences = $novaposhtaApi->update("references");

        if($dataReferences) {
            $response = [
                'status'  => true,
                'msg' => 'Загружено: ' . $dataReferences . ' справочников.',
            ];
            echo json_encode($response);
        }else{
            $response = [
                'status'  => false,
                'msg' => 'Ошибка !',
            ];
            echo json_encode($response);
        }
        break;
}
