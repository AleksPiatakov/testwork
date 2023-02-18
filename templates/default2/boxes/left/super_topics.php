<?php


$sql = "
SELECT
  `td`.`topics_id` as id,
  `td`.`topics_name` as name,
  count(1) AS `amount`
FROM `articles_to_topics` `att`
  LEFT JOIN `topics` `t` ON `t`.`topics_id` = `att`.`topics_id`
  LEFT JOIN `topics_description` `td` ON `att`.`topics_id` = `td`.`topics_id`
WHERE `t`.`parent_id` = 0 AND `td`.`language_id` = $languages_id and att.topics_id not in (16,22,15)
GROUP BY `td`.`topics_id`
ORDER BY `t`.`sort_order` ASC
"; // 15,16,22  - блоки контента (blocks,information,slider)
$query = tep_db_query($sql);

$category_str = '';
while ($row = tep_db_fetch_array($query)) {
    $clink = '<a href="' . tep_href_link(
        FILENAME_ARTICLES,
        'tPath=' . $row['id'],
        'NONSSL'
    ) . '">' . $row['name'] . '</a>'; // show link to current category
    $category_str .= '<li class="custom_id' . $row['id'] . '">' . $clink . '</li>';
}
// start functions
echo '<div class="box-category accordion "><ul id="cat_accordion">';
if ($category_str) {
    echo $category_str;
} else {
    echo '<h3 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h3>';
}
echo '</ul></div>';
