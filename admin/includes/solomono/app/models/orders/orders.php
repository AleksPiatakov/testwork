<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\orders;

use admin\includes\solomono\app\core\Model;

class orders extends Model
{

    protected $allowed_fields = [
        'dynamic' => [
            'label' => '<input type="checkbox">',
            'type' => 'checkbox'
        ],
        'id' => [
            'label' => 'id',
            'sort' => true,
            'filter' => true,
        ],
        'customers_name' => [
            'label' => TABLE_HEADING_CUSTOMERS,
            'filter' => true,
            'sort' => true
        ],
        'order_total' => [
            'label' => TEXT_OP_TOTAL,
            'type' => 'text',
            'sort' => false
        ],
        'date_purchased' => [
            'label' => TABLE_HEADING_DATE_PURCHASED,
            'type' => 'text',
            'filter' => true,
            'sort' => true,
            'filter_class' => 'orderdatepicker',
            'tooltip' => TOOLTIP_ORDER_DATE,
        ],
        'orders_status_name' => [
            'label' => HEADING_TITLE_STATUS,
            'filter_select' => true,
            'table_select' => 'orders_status',
            'option' => [
                'table' => 'orders_status',
                'id' => 'orders_status_id',
                'title' => 'orders_status_name',
                'where' => 'language_id = THIS_LANGUAGE_ID order by orders_status_name'
            ],
            'sort' => true
        ],
        'customers_company' => [
            'label' => 'customers_company',
            'show' => false,
        ],
        'customers_street_address' => [
            'label' => 'customers_street_address',
            'show' => false,
        ],
        'customers_suburb' => [
            'label' => 'customers_suburb',
            'show' => false,
        ],
        'customers_city' => [
            'label' => 'customers_city',
            'show' => false,
        ],
        'customers_postcode' => [
            'label' => 'customers_postcode',
            'show' => false,
        ],
        'customers_state' => [
            'label' => 'customers_state',
            'show' => false,
        ],
        'customers_country' => [
            'label' => 'customers_country',
            'show' => false,
        ],
        'customers_address_format_id' => [
            'label' => 'customers_address_format_id',
            'show' => false,
        ],
        'customers_shipping_fields' => [
            'label' => 'customers_shipping_fields',
            'show' => false,
        ],
        'currency' => [
            'label' => TEXT_CURRENCY,
            'show' => false,
        ],
        'currency_value' => [
            'label' => TEXT_CURRENCY_VALUE,
            'show' => false,
        ],
        'delivery_name' => [
            'label' => 'delivery_name',
            'show' => false,
        ],
        'delivery_company' => [
            'label' => 'delivery_company',
            'show' => false,
        ],
        'delivery_street_address' => [
            'label' => 'delivery_street_address',
            'show' => false,
        ],
        'delivery_city' => [
            'label' => 'delivery_city',
            'show' => false,
        ],
        'delivery_postcode' => [
            'label' => 'delivery_postcode',
            'show' => false,
        ],
        'delivery_state' => [
            'label' => 'delivery_state',
            'show' => false,
        ],
        'delivery_country' => [
            'label' => 'delivery_country',
            'show' => false,
        ],
        'delivery_suburb' => [
            'label' => 'delivery_suburb',
            'show' => false,
        ],
        //
        'billing_name' => [
            'label' => 'billing_name',
            'show' => false,
        ],
        'billing_company' => [
            'label' => 'billing_company',
            'show' => false,
        ],
        'billing_street_address' => [
            'label' => 'billing_street_address',
            'show' => false,
        ],
        'billing_city' => [
            'label' => 'billing_city',
            'show' => false,
        ],
        'billing_postcode' => [
            'label' => 'billing_postcode',
            'show' => false,
        ],
        'billing_state' => [
            'label' => 'billing_state',
            'show' => false,
        ],
        'billing_country' => [
            'label' => 'billing_country',
            'show' => false,
        ],
        'billing_suburb' => [
            'label' => 'billing_suburb',
            'show' => false,
        ],
        'payment_method' => [
            'label' => ENTRY_PAYMENT_METHOD,
            'show' => false,
        ],
        'telephone' => [
            'label' => ENTRY_TELEPHONE_NUMBER,
            'show' => false,
        ],
        'fax' => [
            'label' => ENTRY_FAX_NUMBER,
            'show' => false,
        ],
        'email_address' => [
            'label' => ENTRY_EMAIL_ADDRESS,
            'show' => false,
        ],
        'orders_id' => [
            'label' => TEXT_INFO_DELETE_DATA_OID,
            'show' => false,
        ],
        'referer_url' => [
            'label' => TEXT_REFERER,
            'show' => false,
        ],
        'products_id' => [
            'label' => 'id',
            'show' => false,
        ],
        'products_model' => [
            'label' => TABLE_HEADING_PRODUCTS_MODEL,
            'show' => false,
        ],
        'products_name' => [
            'label' => TABLE_HEADING_PRODUCTS,
            'show' => false,
        ],
        'products_quantity' => [
            'label' => TABLE_HEADING_QUANTITY,
            'show' => false,
        ],
        'products_price' => [
            'label' => TABLE_HEADING_PRICE_INCLUDING_TAX,
            'show' => false,
        ],
        'final_price' => [
            'label' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
            'show' => false,
        ],
        'cc_type' => [
            'label' => ENTRY_CREDIT_CARD_CC_TYPE,
            'show' => false,
        ],
        'cc_owner' => [
            'label' => ENTRY_CREDIT_CARD_CC_OWNER,
            'show' => false,
        ],
        'cc_number' => [
            'label' => ENTRY_CREDIT_CARD_CC_NUMBER,
            'show' => false,
        ],
        'cc_expires' => [
            'label' => ENTRY_CREDIT_CARD_CC_EXPIRES,
            'show' => false,
        ],
        'nwposhta_address' => [
            'label' => NWPOSHTA_DELIVERY_TITLE,
            'show' => false,
        ],
    ];
    protected $prefix_id = 'o.orders_id';

    public function query($request)
    {
        if ($request['search']['id']) {
            $request['search'][$this->prefix_id] = $request['search']['id'];
            unset($request['search']['id']);
        }

        $check_search = 0;
        if (!empty($request['search'])) {
            foreach ($request['search'] as $v) {
                if ($v) {
                    $check_search++;
                }
            }
        }

        if (!$check_search) {
            $request['count'] = $this->getResult('select count(*) as total from orders')[0]['total'];
        }

        parent::query($request);
    }

    public function select($id = false)
    {
        $sql = "SELECT
                      `o`.`orders_id` as id,
                      `o`.`customers_name`,
                      `o`.`customers_id` as cid,
                      `o`.`date_purchased`,
                      `o`.`orders_status`,
                      `s`.`orders_status_name`,
                      `s`.orders_status_color as 'background-color',
                      `ot`.`text` AS `order_total`
                    FROM `orders` `o`
                      LEFT JOIN `orders_total` `ot` ON `o`.`orders_id` = `ot`.`orders_id` AND `ot`.`class` = 'ot_total'
                      LEFT JOIN `orders_status` `s` ON `o`.`orders_status` = `s`.`orders_status_id` AND `s`.`language_id` = {$this->language_id}
                     ";
        return $sql;
    }

    public function selectOne($id)
    {
        $sql = "SELECT
                  `customers_name`,
                  `customers_company`,
                  `customers_street_address`,
                  `customers_suburb`,
                  `customers_city`,
                  `customers_postcode`,
                  `customers_state`,
                  `customers_country`,
                  `customers_address_format_id`,
                  `delivery_name`,
                  `delivery_company`,
                  `delivery_street_address`,
                  `delivery_suburb`,
                  `delivery_city`,
                  `delivery_postcode`,
                  `delivery_state`,
                  `delivery_country`,
                  `delivery_address_format_id`,
                  `billing_name`,
                  `billing_company`,
                  `billing_street_address`,
                  `billing_suburb`,
                  `billing_city`,
                  `billing_postcode`,
                  `billing_state`,
                  `billing_country`,
                  `billing_address_format_id`,
                  `customers_telephone` as `telephone`,
                  `customers_fax` as `fax`,
                  `customers_email_address`  as `email_address`,
                  `customers_referer_url` as `referer_url`,
                  `orders_id`,
                  `payment_method`,
                  `shipping_method_code`,
                  `customers_shipping_fields`,
                  `cc_type`,
                  `cc_owner`,
                  `cc_number`,
                  `cc_expires`,
                  `cvvnumber`,
                  `currency`,
                  `currency_value`,
                  `date_purchased`,
                  `nwposhta_address`
                FROM `orders`
                WHERE `orders_id` = " . (int) $id;
        $data = $this->getResult($sql)[0];
        $this->getShip2Fields();
        $this->prepareInfo($data);
        $this->getProducts($id);
        $this->getOrdersTotal($id);
        updateOrderViewsCount($id);
    }

    private function getShip2Fields()
    {
        $this->ship2Fields = [];
        $query = tep_db_query("select s2f.id,
                        s2f.shipping_code,
                        s2f.field_allowed,
                        s2f.field_required,
                        s2f.min_length,
                        s2fd.language_id,
                        s2fd.field_title
				from " . TABLE_SHIP2FIELDS . " s2f
				LEFT JOIN " . TABLE_SHIP2FIELDS_DESCRIPTION . " s2fd ON s2fd.id = s2f.id 
				where s2fd.language_id = '" . $this->language_id . "'");

        while ($row = tep_db_fetch_array($query)) {
            $this->ship2Fields[$row['id']] = $row['field_title'];
        }
    }

    private function getOrdersTotal($id)
    {
        $sql = "SELECT
                  `ot`.`title`,
                  `ot`.`class`,
                  `ot`.`text`
                FROM `orders_total` `ot`
                WHERE `orders_id` = '{$id}'
                ORDER BY `sort_order`";
        $this->data['orders_total'] = $this->getResult($sql);
    }

    private function getProducts($id)
    {
        $sql = "SELECT
              `op`.`orders_products_id`,
              `op`.`products_id`,
              `op`.`products_model`,
              `op`.`products_quantity`,
              `op`.`products_name`,
              /*`op`.`products_price`,*/
              `op`.`final_price` as `products_price`,
              `op`.`final_price`*`op`.`products_quantity` as final_price
            FROM `orders_products` `op`
            WHERE `op`.`orders_id` = '{$id}'";

        $this->data['products'] = $this->getResult($sql);

        /**
         * add attributes array to products
         */
        $productsAttr = $this->getProductsAttrs($id);
        foreach ($this->data['products'] as &$product) {
            $product['products_attr'] = $productsAttr[$product['orders_products_id']] ?: [];
        }

        $this->data['order_id'] = $id;
    }

    /**
     * @param $order_id
     * @return array
     */
    private function getProductsAttrs(string $order_id): array
    {
        $sql = "SELECT `products_options`, 
                       `products_options_values`, 
                       `orders_products_id`,
                       `products_options_id`,
                       `products_options_values_id`
                FROM `orders_products_attributes` 
                WHERE `orders_id` = '{$order_id}'";
        $sql = tep_db_query($sql);
        $result = [];
        while ($row = tep_db_fetch_array($sql)) {
            $productsId = $row["orders_products_id"];
            unset($row["orders_products_id"]);
            $result[$productsId][] = $row;
        }
        return $result;
    }

    /**
     * @param string $ordersId
     * @return array
     */
    private function getProductsAttrsPrice(string $ordersId): array
    {
        $sql = "select ps.products_combination_price, s.specials_new_products_price as special_price, ps.products_id, ps.products_stock_attributes
                        from " . TABLE_PRODUCTS_STOCK . " ps 
                        left join " . TABLE_SPECIALS . " s on s.attribute_combination = ps.products_stock_attributes and status = '1' 
                            and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
                            and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)
                        left join " . TABLE_ORDERS_PRODUCTS . " o on o.products_id=ps.products_id
                        where o.orders_id = " . (int)$ordersId;
        $sql = tep_db_query($sql);
        $result = [];
        while ($row = tep_db_fetch_array($sql)) {
            $productId = $row["products_id"];
            $productStockAttr = $row["products_stock_attributes"];
            unset($row["products_id"]);
            unset($row["products_stock_attributes"]);
            $result[$productId . '-' . $productStockAttr] = $row;
        }
        return $result;
    }

    private function prepareInfo($data)
    {
        foreach ($data as $k => $v) {
            //if (preg_match('/^(customers|delivery|billing|.+)/', $k,$matches)) {
            if (!preg_match('/^(customers|delivery|billing)_(.+)/', $k, $matches)) {
                $matches[1] = 'info';
                $matches[2] = $this->allowed_fields[$k] ? $this->allowed_fields[$k]['label'] : $k;
            }
            if ($k == 'customers_shipping_fields') {
                foreach ((array)json_decode($v) as $key => $value) {
                    $title = $this->ship2Fields[$key] ?: $key;
                    $this->data['data']['INFO'][$title] = $value;
                }
                continue;
            }
            //$this->data['data']['test'][$matches[0]][$this->allowed_fields[$k]['label']]=$v;
            $this->data['data'][strtoupper($matches[1])][$matches[2]] = $v;
        }
    }

    private function checkOtherFilter(&$request)
    {
        if (isset($request['cID'])) {
            $request['search']['customers_id'] = $request['cID'];
        }
    }

    protected function filter($request)
    {
        $this->checkOtherFilter($request);
        if (isset($request['search']) && count($request['search'])) {
            foreach ($request['search'] as $field => $search) {
                if (!empty($search)) {
                    if ($field == 'date_purchased' && strpos($search, ' - ')) {
                        list($from, $to) = explode(' - ', $search);
                        $columnSearch[] = "(DATE(`o`.`date_purchased`) >= str_to_date('" . date('d.m.Y',
                                strtotime($from)) . "', '%d.%m.%Y') and DATE(`o`.`date_purchased`) <= str_to_date('" . date('d.m.Y',
                                strtotime($to)) . "', '%d.%m.%Y'))";
                    } elseif ($field == 'customers_name') {
                        $columnSearch[] = "(`o`.`customers_email_address` LIKE '%{$search}%' OR `o`.`customers_telephone` LIKE '%{$search}%' OR " . $field . " LIKE '%" . $search . "%')";
                    } else {
                        $columnSearch[] = $field . " LIKE '%" . $search . "%'";
                    }
                }
            }
        }

        if (!empty($request['orders_status'])) {
            $columnSearch[] = " orders_status = '" . $request['orders_status'] . "'";
        }

        return $columnSearch ? implode(' AND ', $columnSearch) : '';
    }

    protected function order($request)
    {
        $request['order'] = $request['order'] ?: 'id-desc';

        if ($request['order'] == 'order_total-desc') {
            $request['order'] = 'ot.value-desc';
        } elseif ($request['order'] == 'order_total-asc') {
            $request['order'] = 'ot.value-asc';
        }

        return parent::order($request);
    }

    private function checkPaylike($order_id)
    {
        // unfortunately osc doesnt store payment method class name, so we can only use like %%
        $sql = "SELECT payment_method FROM orders WHERE orders_id = '$order_id' and LOWER(payment_method) LIKE '%paylike%' ";
        $query = tep_db_query($sql);
        return $query->num_rows ? true : false;
    }

    public function statusUpdate($status, $id, $field = 'status', $table = null, $prefixId = null)
    {
        if ($this->checkPaylike($id)) {
            chdir('../');
            require(DIR_WS_MODULES . 'payment/paylike.php');
            $paylike = new \paylike();
            if (!$paylike->manual_status_update($status, $id)) {
                return false;
            }
        }
        parent::statusUpdate($status, $id, $field, $table, $prefixId);
    }

}