<?php

/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Parse and secure the tPath parameter values
function tep_parse_topic_path($tPath)
{
    // make sure the topic IDs are integers
    $tPath_array = array_map('tep_string_to_int', explode('_', $tPath));

// make sure no duplicate topic IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($tPath_array);
    for ($i = 0; $i < $n; $i++) {
        if (!in_array($tPath_array[$i], $tmp_array)) {
            $tmp_array[] = $tPath_array[$i];
        }
    }

    return $tmp_array;
}


////
// Return the number of articles in a topic
// TABLES: articles, articles_to_topics, topics
function tep_count_articles_in_topic($topic_id, $include_inactive = false)
{
    $articles_count = 0;
    if ($include_inactive == true) {
        $articles_query = tep_db_query("select count(*) as total from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a2t.topics_id = " . (int)$topic_id);
    } else {
        $articles_query = tep_db_query("select count(*) as total from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a2t.topics_id = " . (int)$topic_id);
    }
    $articles = tep_db_fetch_array($articles_query);
    $articles_count += $articles['total'];

    $child_topics_query = tep_db_query("select topics_id from " . TABLE_TOPICS . " where parent_id = " . (int)$topic_id);
    if (tep_db_num_rows($child_topics_query)) {
        while ($child_topics = tep_db_fetch_array($child_topics_query)) {
            $articles_count += tep_count_articles_in_topic($child_topics['topics_id'], $include_inactive);
        }
    }

    return $articles_count;
}

////
// Return all topics
// TABLES: topics, topic_descriptions
function tep_get_topics($topics_array = '', $parent_id = '0', $indent = '')
{
    global $languages_id;

    if (!is_array($topics_array)) {
        $topics_array = array();
    }

    $topics_query = tep_db_query("select t.topics_id, td.topics_name from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where parent_id = " . (int)$parent_id . " and t.topics_id = td.topics_id and td.language_id = " . (int)$languages_id . " order by sort_order, td.topics_name");
    while ($topics = tep_db_fetch_array($topics_query)) {
        $topics_array[] = array('id' => $topics['topics_id'],
                                  'text' => $indent . $topics['topics_name']);

        if ($topics['topics_id'] != $parent_id) {
            $topics_array = tep_get_topics($topics_array, $topics['topics_id'], $indent . '&nbsp;&nbsp;');
        }
    }

    return $topics_array;
}

////
// Recursively go through the topics and retreive all parent topic IDs
// TABLES: topics
function tep_get_parent_topics(&$topics, $topics_id)
{
    $parent_topics_query = tep_db_query("select parent_id from " . TABLE_TOPICS . " where topics_id = " . (int)$topics_id);
    while ($parent_topics = tep_db_fetch_array($parent_topics_query)) {
        if ($parent_topics['parent_id'] == 0) {
            return true;
        }
        $topics[sizeof($topics)] = $parent_topics['parent_id'];
        if ($parent_topics['parent_id'] != $topics_id) {
            tep_get_parent_topics($topics, $parent_topics['parent_id']);
        }
    }
}

////
// Construct a topic path to the article
// TABLES: articles_to_topics
function tep_get_article_path($articles_id)
{
    $tPath = '';

    $topic_query = tep_db_query("select a2t.topics_id from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t where a.articles_id = " . (int)$articles_id . " and a.articles_status = '1' and a.articles_id = a2t.articles_id limit 1");
    if (tep_db_num_rows($topic_query)) {
        $topic = tep_db_fetch_array($topic_query);

        $topics = array();
        tep_get_parent_topics($topics, $topic['topics_id']);

        $topics = array_reverse($topics);

        $tPath = implode('_', $topics);

        if (tep_not_null($tPath)) {
            $tPath .= '_';
        }
        $tPath .= $topic['topics_id'];
    }

    return $tPath;
}
