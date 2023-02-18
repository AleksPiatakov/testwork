<?php

if ($template->show('M_SEARCH_QUERIES') && getConstantValue("STATS_KEYWORDS_POPULAR_ENABLED") == 'true') {
    $queries = getPopularQueries();
    if (tep_db_num_rows($queries)) {
        ?>
        <div class="container">
            <div class="popular_queries">
                <h3><strong><span><?= TEXT_POPULAR_SEARCH_QUERIES ?></span></strong></h3>
                <div class="popular_queries_container">
                    <?php
                    while ($query = tep_db_fetch_array($queries)) {
                        $url = ($query['canonical'] ?: '?keywords=' . $query['search_keywords']);
                        $separator = ((substr($url, 0, 1) != '/') ? '/' : '');
                        ?>
                        <a href="<?php echo tep_href_link(ltrim($url, '/')) ?>"><?= $query['search_keywords'] ?></a>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
