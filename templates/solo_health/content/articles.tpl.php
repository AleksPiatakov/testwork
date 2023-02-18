<?php

// the following tPath references come from application_top.php
$topic_depth = 'top';

if (isset($tPath) && tep_not_null($tPath)) {
    $topics_articles_query = tep_db_query(
        "select count(*) as total from " . TABLE_ARTICLES_TO_TOPICS . " where topics_id = '" . (int)$current_topic_id . "'");
    $topics_articles = tep_db_fetch_array($topics_articles_query);
    if ($topics_articles['total'] > 0) {
        $topic_depth = 'articles'; // display articles
    } else {
        $topic_parent_query = tep_db_query(
            "select count(*) as total from " . TABLE_TOPICS . " where parent_id = '" . (int)$current_topic_id . "'");
        $topic_parent = tep_db_fetch_array($topic_parent_query);
        if ($topic_parent['total'] > 0) {
            $topic_depth = 'nested'; // navigate through the topics
        } else {
            $topic_depth = 'articles'; // topic has no articles, but display the 'no articles' message
        }
    }
}

if ($topic_depth == 'top') {
    $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLES));
}

$requiredFileName = 'FILENAME_ARTICLES_' . strtoupper($topic_depth);
if (defined($requiredFileName)) {
    includeLanguages(DIR_WS_LANGUAGES . $language . '/' . constant($requiredFileName));
} else {
    includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES);
}


// Set number of columns in listing
define('NR_COLUMNS', 2); ?>

    <!-- body_txt //-->
<?php

if ($topic_depth == 'nested') {
    $topic_query = tep_db_query(
        "select td.topics_id, td.topics_name, td.topics_heading_title, td.topics_description from " . TABLE_TOPICS_DESCRIPTION . " td where td.topics_id = '" . (int)$current_topic_id . "' and td.language_id = '" . (int)$languages_id . "'");
    $topic = tep_db_fetch_array($topic_query);


    if (isset($tPath) && strpos('_', $tPath)) {
// check to see if there are deeper topics within the current topic
        $topic_links = array_reverse($tPath_array);
        for ($i = 0, $n = sizeof($topic_links); $i < $n; $i++) {
            $topics_query = tep_db_query(
                "select count(*) as total from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.parent_id = '" . (int)$topic_links[$i] . "' and t.topics_id = td.topics_id and td.language_id = '" . (int)$languages_id . "'");
            $topics = tep_db_fetch_array($topics_query);
            if ($topics['total'] < 1) {
                // do nothing, go through the loop
            } else {
                $topics_query = tep_db_query(
                    "select t.topics_id, td.topics_name, t.parent_id from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.parent_id = '" . (int)$topic_links[$i] . "' and t.topics_id = td.topics_id and td.language_id = '" . (int)$languages_id . "' order by sort_order, td.topics_name");
                break; // we've found the deepest topic the customer is in
            }
        }
    } else {
        $topics_query = tep_db_query(
            "select t.topics_id, td.topics_name, t.parent_id from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.parent_id = '" . (int)$current_topic_id . "' and t.topics_id = td.topics_id and td.language_id = '" . (int)$languages_id . "' order by sort_order, td.topics_name");
    }

// needed for the new articles module shown below
    $new_articles_topic_id = $current_topic_id;
    ?>

    <?php
} elseif ($topic_depth == 'articles') {
    /* bof catdesc for bts1a */
// Get the topic name and description from the database
    $topic_query = tep_db_query(
        "select td.topics_id, td.topics_name, td.topics_heading_title, td.topics_description from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.topics_id = '" . (int)$current_topic_id . "' and td.topics_id = '" . (int)$current_topic_id . "' and td.language_id = '" . (int)$languages_id . "'");
    $topic = tep_db_fetch_array($topic_query);
    /* bof catdesc for bts1a */

// show the articles in a given category
    if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
        $listing_sql = "select ad.articles_url, a.articles_link, a.articles_id, a.articles_image, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id where (a.articles_date_available IS NULL or a.articles_date_available = '0000-00-00 00:00:00' or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a2t.topics_id = '" . (int)$current_topic_id . "' order by a.articles_date_added desc, ad.articles_name";
    } else {
// We show them all
        $listing_sql = "select ad.articles_url, a.articles_link, a.articles_id, a.articles_image, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id where (a.articles_date_available IS NULL or a.articles_date_available = '0000-00-00 00:00:00' or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a2t.topics_id = '" . (int)$current_topic_id . "' order by a.articles_date_added desc, ad.articles_name";
    }

    ?>

    <?php include(DIR_WS_MODULES . FILENAME_ARTICLE_LISTING); ?>


    <?php if (tep_not_null($topic['topics_description'])) { ?>

        <tr>
            <td align="left" colspan="2"
                class="main"><?php echo $topic['topics_description']; ?></td>
        </tr>

    <?php } ?>


    <?php
} else {  // default page
    ?>
    <td width="100%" valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td><?php include(DIR_WS_MODULES . FILENAME_ARTICLES_UPCOMING); ?></td>
            </tr>

            <tr>
                <td class="main"><?php echo '<b>' . TEXT_CURRENT_ARTICLES . '</b>'; ?></td>
            </tr>

            <?php
            $articles_all_array = array();
            $articles_all_query_raw = "select a.articles_id, a.articles_date_added, a.articles_date_available, ad.articles_name, ad.articles_head_desc_tag, ad.articles_viewed, td.topics_id, td.topics_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id, " . TABLE_ARTICLES_DESCRIPTION . " ad where (a.articles_date_available IS NULL or a.articles_date_available = '0000-00-00 00:00:00' or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' ORDER BY IF (`a`.`articles_date_available`,`a`.`articles_date_available`, `a`.`articles_date_added`) DESC";

            $articles_all_split = new splitPageResults($articles_all_query_raw, 10);
            if (($articles_all_split->number_of_rows > 0) && ((ARTICLE_PREV_NEXT_BAR_LOCATION == 'top') || (ARTICLE_PREV_NEXT_BAR_LOCATION == 'both'))) {
                ?>
                <tr>
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tr>
                                <td class="smallText"><?php echo $articles_all_split->display_count(
                                        TEXT_DISPLAY_NUMBER_OF_ARTICLES); ?></td>
                                <td align="right"
                                    class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $articles_all_split->display_links(
                                            MAX_DISPLAY_PAGE_LINKS,
                                            tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <?php
                        if ($articles_all_split->number_of_rows > 0) {
                            $articles_all_query = tep_db_query($articles_all_split->sql_query);
                            ?>

                            <?php
                            while ($articles_all = tep_db_fetch_array($articles_all_query)) {
                                ?>
                                <tr>
                                    <td valign="top" class="main" width="100%">
                                        <?php
                                        echo '<h1><a href="' . tep_href_link(
                                                FILENAME_ARTICLE_INFO,
                                                'articles_id=' . $articles_all['articles_id']) . '"><b>' . $articles_all['articles_name'] . '</a></h1> ';
                                        ?>
                                    </td>
                                    <td valign="top" class="main" width="5"></td>
                                    <?php
                                    if (tep_not_null($articles_all['topics_name'])) {
                                        ?>
                                        <td valign="top" class="main" width="140"
                                            nowrap><?php echo TEXT_TOPIC . '&nbsp;<a href="' . tep_href_link(
                                                    FILENAME_ARTICLES,
                                                    'tPath=' . $articles_all['topics_id']) . '">' . $articles_all['topics_name'] . '</a>'; ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td class="main"
                                        style="padding-left:2px"><?php echo clean_html_comments(
                                                substr($articles_all['articles_head_desc_tag'], 0, 300)) . ((strlen(
                                                    $articles_all['articles_head_desc_tag']) >= 300) ? '...' : ''); ?>
                                        <br><br></td>
                                    <td></td>
                                    <td class="smalltext" valign="top"
                                        style="color:#737373; padding-left:2px"><?php echo tep_date_long(
                                            $articles_all['articles_date_added']); ?></td>

                                </tr>

                                <?php
                            } // End of listing loop
                        } else {
                            ?>
                            <tr>
                                <td class="main"><?php echo TEXT_NO_ARTICLES; ?></td>
                            </tr>


                            <?php
                        }
                        ?>

                    </table>
                </td>
            </tr>
        </table>
    </td>

<?php }
if ($articles_all_split->number_of_rows > 0): ?>
    <div>
        <div class="left"> <?php echo TOTAL_ARTICLES; ?>: <b><?php echo $articles_all_split->number_of_rows; ?></div>
        <div class="right"> <?php echo TEXT_RESULT_PAGE . ' ' . $articles_all_split->display_links(
                    MAX_DISPLAY_PAGE_LINKS,
                    tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
    </div>
<?php endif; ?>
