<?php

/*
  $Id: wishlist.php,v 3.0  2005/08/24 Dennis Blake
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

class wishlist
{
    var $wishID;

    function __construct()
    {
        $this->reset();
    }

    function reset($reset_database = false)
    {
        global $customer_id;

        // Remove all from database
        if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
            tep_db_query("delete from " . TABLE_WISHLIST . " where customers_id = " . (int)$customer_id);
            tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where customers_id = " . (int)$customer_id);
        }

        // reset session contents
        unset($this->wishID);
    }

    function restore_wishlist()
    {
        global $customer_id;

        if (!tep_session_is_registered('customer_id')) {
            return false;
        }

        // merge current wishlist items in database
        if (is_array($this->wishID)) {
            reset($this->wishID);

            foreach ($this->wishID as $wishlist_id => $val) {
                // while (list($wishlist_id, ) = each($this->wishID)) {
                $wishlist_query = tep_db_query("select products_id from " . TABLE_WISHLIST . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($wishlist_id) . "'");
                if (!tep_db_num_rows($wishlist_query)) {
                    tep_db_query("insert into " . TABLE_WISHLIST . " (customers_id, products_id) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($wishlist_id) . "')");
                    if (isset($this->wishID[$wishlist_id]['attributes'])) {
                        reset($this->wishID[$wishlist_id]['attributes']);
                        foreach ($this->wishID[$wishlist_id]['attributes'] as $option => $value) {
                            // while (list($option, $value) = each($this->wishID[$wishlist_id]['attributes'])) {
                            tep_db_query("insert into " . TABLE_WISHLIST_ATTRIBUTES . " (customers_id, products_id, products_options_id , products_options_value_id) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($wishlist_id) . "', " . (int)$option . ", " . (int)$value . " )");
                        }
                    }
                }
            }
        }

        // reset session contents
        unset($this->wishID);

        $wishlist_session = tep_db_query("select products_id from " . TABLE_WISHLIST . " where customers_id = " . (int)$customer_id);
        while ($wishlist = tep_db_fetch_array($wishlist_session)) {
            $this->wishID[$wishlist['products_id']] = [$wishlist['products_id']];
            // attributes
            $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_WISHLIST_ATTRIBUTES . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($wishlist['products_id']) . "'");
            while ($attributes = tep_db_fetch_array($attributes_query)) {
                $this->wishID[$wishlist['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
            }
        }
    }

    function add_wishlist($wishlist_id, $attributes_id)
    {
        global $customer_id;

        if (!$this->in_wishlist($wishlist_id)) {
            $wishlist_id = tep_get_uprid($wishlist_id, $attributes_id);
            // Insert into session
            $this->wishID[$wishlist_id] = [$wishlist_id];

            if (tep_session_is_registered('customer_id')) {
                // Insert into database
                tep_db_query("insert into " . TABLE_WISHLIST . " (customers_id, products_id) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($wishlist_id) . "')");
            }

            // Read array of options and values for attributes in id[]
            if (is_array($attributes_id)) {
                reset($attributes_id);
                foreach ($attributes_id as $option => $value) {
                    //while (list($option, $value) = each($attributes_id)) {
                    $this->wishID[$wishlist_id]['attributes'][$option] = $value;
                    // Add to customers_wishlist_attributes table
                    if (tep_session_is_registered('customer_id')) {
                        tep_db_query("insert into " . TABLE_WISHLIST_ATTRIBUTES . " (customers_id, products_id, products_options_id , products_options_value_id) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($wishlist_id) . "', " . (int)$option . ", " . (int)$value . " )");
                    }
                }
                tep_session_unregister('attributes_id');
            }
        }
    }

    function in_wishlist($wishlist_id)
    {
        global $customer_id;

        if (isset($this->wishID[$wishlist_id])) {
            return true;
        } else {
            return false;
        }
    }

    function remove($wishlist_id)
    {
        global $customer_id;

        // Remove from session

        // get clear product ID:
        $wishlist_id = $this->get_att($wishlist_id);
        unset($this->wishID[$wishlist_id]);

        //remove from database
        if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_WISHLIST . " where products_id = '" . tep_db_prepare_input($wishlist_id) . "' and customers_id = " . (int)$customer_id);
            tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where products_id = '" . tep_db_prepare_input($wishlist_id) . "' and customers_id = " . (int)$customer_id);
        }
    }

    function get_att($wishlist_id)
    {
        $pieces = explode('{', $wishlist_id);

        return $pieces[0];
    }

    function clear()
    {
        global $customer_id;

        // Remove all from database
        if (tep_session_is_registered('customer_id')) {
            $wishlist_products_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . (int)$customer_id);
            while ($wishlist_products = tep_db_fetch_array($wishlist_products_query)) {
                // get clear product ID:
                $wishlist_products['products_id'] = $this->get_att($wishlist_products['products_id']);

                unset($this->wishID[$wishlist_products['products_id']]);

                tep_db_query("delete from " . TABLE_WISHLIST . " where products_id = '" . tep_db_prepare_input($wishlist_products['products_id']) . "' and customers_id = " . (int)$customer_id);
                tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where products_id = '" . tep_db_prepare_input($wishlist_products['products_id']) . "' and customers_id = " . (int)$customer_id);
            }
        }
    }

    /**
     * @param int $prodId
     *
     * @return $result array
     */
    function getProductData($prodId)
    {
        global $languages_id;
        $query = tep_db_query("select p.products_price, pd.products_name, cd.categories_name
            from " . TABLE_PRODUCTS . " p
            left join  " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id
            left join  " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc on ptc.products_id = p.products_id
            left join  " . TABLE_CATEGORIES_DESCRIPTION . " cd on cd.categories_id = ptc.categories_id
            where p.products_id = " . (int)$prodId . "
            and pd.language_id = " . (int)$languages_id . "
            and cd.language_id = " . (int)$languages_id . "
            ");
        $result = tep_db_fetch_array($query);

        return $result;
    }
}
