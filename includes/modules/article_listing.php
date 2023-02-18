<?php
/*
  $Id: article_listing.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

$listing_split = new splitPageResults($listing_sql, 10);

?>
<div class="row article_listing">
    <?php
    if ($listing_split->number_of_rows > 0) {
        $articles_listing_query = tep_db_query($listing_split->sql_query);
        $i = 0;
        while ($articles_listing = tep_db_fetch_array($articles_listing_query)) {
            // IMAGE
            if (!empty($articles_listing['articles_image'])) {
                $image_file_name = 'getimage/380x380/' . $articles_listing['articles_image'];
                $product_image = '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $image_file_name . '" alt="' . $articles_listing['articles_name'] . '" title="' . $articles_listing['articles_name'] . '" />';
            } else {
                $product_image = '';
            }
            // IMAGE

            if (!empty($articles_listing['articles_link'])) {
                if (strpos($articles_listing['articles_link'], "http://") !== false or strpos($articles_listing['articles_link'], "https://") !== false) {
                    $link = $articles_listing['articles_link'];
                } else {
                    $link = tep_href_link($articles_listing['articles_link']);
                }
            } elseif ($articles_listing['articles_url']) {
                if (defined('PROM_URLS') && constant('PROM_URLS')) {
                    $link = tep_href_link('a' . $articles_listing['articles_id'] . '-' . $articles_listing['articles_url'] . '.html');
                } else {
                    $link = tep_href_link($articles_listing['articles_url'] . '/a-' . $articles_listing['articles_id'] . '.html');
                }
            } else {
                $link = tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $articles_listing['articles_id']);
            }
            ?>

            <div class="col-sm-3"<?= ($i % 4) ? '' : ' style="clear:both"'?>>
                <div>
                    <?php echo $product_image; ?>
                    <small><?php echo tep_date_short_custom($articles_listing['articles_date_added'], true); ?></small>
                    <?php echo '<a href="' . $link . '">' . $articles_listing['articles_name'] . '</a>'; ?>
                    <small><?php echo clean_html_comments(mb_substr($articles_listing['articles_head_desc_tag'], 0, 100)) . ((strlen($articles_listing['articles_head_desc_tag']) >= 100) ? '...' : ''); ?></small>
                </div>
            </div>
            <?php $i++;
        }
    } else { ?>
        <div class=""><?php echo TEXT_NO_ARTICLES; ?></div>
    <?php } ?>

</div>
<?php
if ($listing_split->number_of_rows > 0) {
    ?>
    <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td style="padding-left:2px" class="smallText"><?php echo TOTAL_ARTICLES; ?>:
                        <b><?php echo $listing_split->number_of_rows; ?></b></td>
                    <td align="right"
                        class="smallText countPages "><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y','language'))); ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php
}
?>
