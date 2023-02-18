<!--/////////////  FOOTER ARTICLES  /////////////-->
<ul>
    <?php
    $query_footer_article = "select ad.articles_id, ad.articles_name, ad.articles_head_desc_tag 
                        from " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t, " . TABLE_TOPICS . " t 
                        where a.articles_id=ad.articles_id 
                        and ad.articles_id=a2t.articles_id 
                        and a2t.topics_id=t.topics_id 
                        and a.articles_status='1'
                        order by ad.articles_id DESC LIMIT 5";
    $query_footer_art_links = tep_db_query($query_footer_article);
    while ($row = tep_db_fetch_array($query_footer_art_links)) {
        $foo_art_title = '<a href="' . tep_href_link(
            FILENAME_ARTICLE_INFO,
            'articles_id=' . $row['articles_id']
        ) . '">' . $row['articles_name'] . '</a>';
        $output = '<li>' . $foo_art_title . '</li>';
        echo $output;
    }


    ?>
</ul>
<!--/////////////  END FOOTER ARTICLES  /////////////-->
