<?php

namespace admin\includes\solomono\app\models\mysqlperformance;

use admin\includes\solomono\app\core\Model;
use App\Classes\Filesystem\Filesystem;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class mysqlperformance extends Model
{
    protected $allowed_fields = [
        '4' => [
            'label' => TABLE_HEADING_NUMBER,
            'general' => 'text',
            'thWidth' => '50',
        ],
        '0' => [
            'label' => TABLE_HEADING_QUERY,
            'general' => 'text',
        ],
        '1' => [
            'label' => TABLE_HEADING_QLOCATION,
            'general' => 'text',
            'thWidth' => '500',
        ],
        '2' => [
            'label' => TABLE_HEADING_QUERY_TIME,
            'general' => 'text',
            'thWidth' => '130',
        ],
        '3' => [
            'label' => TABLE_HEADING_DATE_CREATED,
            'general' => 'disabled',
            'thWidth' => '120',
        ],
    ];

    protected $prefix_id = 'manufacturers_id';

    public function select()
    {
        $sql = "SELECT
                  `m`.`manufacturers_id` as id,
                  `mi`.`manufacturers_name`,
                  `m`.`manufacturers_countries`,
                  `m`.`manufacturers_image`,
                  `m`.`status`
                FROM `manufacturers` `m`
                JOIN `manufacturers_info` `mi` ON
                    `m`.`manufacturers_id` = `mi`.`manufacturers_id`
                    where `mi`.`languages_id` = {$this->language_id}";
        return $sql;
    }

    public function query($request)
    {
        // File location (URL or server path)
        $FilePath = DIR_FS_LOGS . '/MYSQL/admin/slow_query/slow_query_log.txt';

        $lines = (new Filesystem())->lines($FilePath);
        $rows = [];
        foreach ($lines as $key => $line) {
            $rows[] = array_merge([$key], explode("\t", $line), ['id' => $key]);
        }

        $recordsTotal = $request['count'] ?: count($rows);
        $this->paginate($recordsTotal, $request['page'], $request['perPage']);

        $offset = ($request['page'] - 1) * $request['perPage'];
        $this->data['data'] = array_slice($rows, $offset, $request['perPage']);
    }

    public function delete($id)
    {
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            $this->delFile($id, 'manufacturers_image');
            return tep_db_query("DELETE FROM `manufacturers_info` WHERE `{$this->prefix_id}`={$id}");
        }
        return false;
    }
}
