<?php

class reviews
{

    private static $table = 'reviews';

    private static $tableDesc = 'reviews_description';

    private $sql;

    private $reviews_type;

    private $products_id;

    private $reviews = [];

    public $reviewsHtml = '';

    private $customer_id = 0;

    private $isLoginRequired = false;

    private $customer_name = '';

    private $dateFormat = '';

    private $languageId = null;

    private $ajaxPath = '';

    private $totalPages = 1;

    private $answerButton;

    public $reviews_blocks = '';

    public $pagination = '';

    public $showImage = false;

    public $lastPageArrived = false;

    public $drawAnswer = true;

    public $reviews_per_page = 5;

    public $canAnswer = true;

    const PAGINATION_PAGES = 5;

    public function __construct($reviews_type = false)
    {
        $this->dateFormat = defined('DATE_FORMAT') ? DATE_FORMAT : 'Y-m-d H:i:s';
        if (defined('REVIEWS_WRITE_ACCESS')) {
            $this->isLoginRequired = REVIEWS_WRITE_ACCESS == 'true';
        }
    }


    public function setReviewsType($type)
    {
        $this->reviews_type = $type;
    }
    public function setLanguageId($id)
    {
        $this->languageId = (int)$id;
    }

    public function setAjaxPath($path)
    {
        $this->ajaxPath = $path;
    }

    public function setShowImage($status)
    {
        $this->showImage = $status;
    }


    public function setDrawAnswer($drawAnswer)
    {
        $this->drawAnswer = $drawAnswer;
    }

    public function setReviewsPerPage($perPage)
    {
        $this->reviews_per_page = $perPage;
    }

    public function setProductId($id)
    {
        $this->products_id = $id;
    }

    public function setCustomerData($name, $id)
    {
        $this->customer_id   = $id;
        $this->customer_name = $name;
    }

    public function getReviewsQuery($parent_id = '(0)')
    {

        $select_clause = [
          'r.reviews_id',
          'r.products_id',
          'r.customers_id',
          'r.customers_name',
          'r.reviews_rating',
          'r.date_added',
          'rd.reviews_text',
          'r.parent_id',
        ];
        $join_clause   = ["INNER JOIN " . self::$tableDesc . " rd on r.reviews_id = rd.reviews_id " . (!is_null($this->languageId) ? " and rd.languages_id = '{$this->languageId}' " : "")];
        if ($this->showImage) {
            $select_clause[] = 'p.products_image';
            $join_clause[]   = "LEFT JOIN products p ON p.products_id = r.products_id";
        }
        if ($this->reviews_type) {
            $where_clause[] = " r.reviews_type = '{$this->reviews_type}' ";
        }
        if ($this->products_id) {
            $where_clause[] = " r.products_id = '{$this->products_id}' ";
        }
        $select    = implode(',', $select_clause);
        $join      = implode(' ', $join_clause);
        $this->sql = "SELECT {$select}
                       FROM " . self::$table . " r
                       {$join}";
        $where_clause[] = " r.parent_id IN $parent_id ";
        if ($where_clause) {
            $this->sql .= " WHERE " . implode(' and ', $where_clause);
        }
    }

    public function setQueryOrder($order = 1)
    {
        switch ($order) {
            //#todo add more order and add control from admin panel
            default:
                $order_clause = ' ORDER BY r.reviews_id DESC ';
        }
        $this->sql .= $order_clause;
    }

    public function fetchReviews()
    {
        $listing_split = new splitPageResults(strtolower($this->sql), $this->reviews_per_page, 'r.reviews_id', 'rpage');

        $query            = tep_db_query($listing_split->sql_query);
        $this->totalPages = $listing_split->number_of_pages;
        if (isset($_GET['rpage']) && (int)$_GET['rpage'] >= $this->totalPages) {
            $this->lastPageArrived = true;
            if ((int)$_GET['rpage'] > $this->totalPages) {
                return false;
            }
        }
        if ($this->totalPages > 1) {
            $params           = $this->products_id ? 'products_id=' . $this->products_id : '';
            $this->pagination = $listing_split->display_links(self::PAGINATION_PAGES, $params, 'span');
        }
        while ($row = tep_db_fetch_array($query)) {
            $row['date_added']                 = date($this->dateFormat, strtotime($row['date_added']));
            $this->reviews[$row['reviews_id']] = $row;
        }
        if (!empty($this->reviews)) {
            // Get children reviews
            $parent_id = "( " . implode(",", array_keys($this->reviews)) . " )";
            $this->getReviewsQuery($parent_id);
            $query = tep_db_query($this->sql);
            while ($row = tep_db_fetch_array($query)) {
                $row['date_added']                 = date($this->dateFormat, strtotime($row['date_added']));
                $this->reviews[$row['parent_id']]['children'][$row['reviews_id']] = $row;
            }
        }
    }

    public function drawReviewsBlocks()
    {
        foreach ($this->reviews as $review) {
            $children = '';
            if (isset($review['children']) && !empty($review['children'])) {
                $children .= '<div class="review-children">';
                foreach ($review['children'] as $child) {
                    $rating               = $child['reviews_rating'] * 20;
                    $children .= strtr($this->getBlockTemplate('review'), [
                        '{{name}}'          => $child['customers_name'],
                        '{{date_added}}'    => $child['date_added'],
                        '{{rating}}'        => $rating,
                        '{{text}}'          => $child['reviews_text'],
                        '{{answer_button}}' => $this->answerButton,
                        '{{review_id}}'     => $child['parent_id'],
                        '{{children}}'      => '',
                    ]);
                }
                $children .= '</div>';
            }
            $rating               = $review['reviews_rating'] * 20;
            $this->reviews_blocks .= strtr($this->getBlockTemplate('review'), [
              '{{name}}'          => $review['customers_name'],
              '{{date_added}}'    => $review['date_added'],
              '{{rating}}'        => $rating,
              '{{text}}'          => $review['reviews_text'],
              '{{answer_button}}' => $this->answerButton,
              '{{review_id}}'     => $review['reviews_id'],
              '{{children}}'      => $children,
            ]);
        }
    }

    public function drawAllReviewsBlocks()
    {
        foreach ($this->reviews as $review) {
            $rating               = $review['reviews_rating'] * 20;
            $image                = 'getimage/100x100/products/' . explode(';', $review['products_image'])[0];
            $href                 = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $review['products_id']);
            $this->reviews_blocks .= strtr($this->getBlockTemplate('review2'), [
              '{{name}}'       => $review['customers_name'],
              '{{date_added}}' => $review['date_added'],
              '{{rating}}'     => $rating,
              '{{href}}'       => $href,
              '{{image}}'      => $image,
              '{{text}}'       => $review['reviews_text'],
            ]);
        }
    }

    public function drawLoginBlock()
    {
        $login_link = tep_href_link(FILENAME_LOGIN);
        return strtr($this->getBlockTemplate('login'), [
          '{{link}}'        => $login_link,
          '{{login_text}}'  => REVIEWS_LOGIN,
          '{{review_text}}' => REVIEWS_LOGIN_TEXT,
        ]);
    }

    public function makeAnswerBlock()
    {
        return $this->customer_id || $this->isLoginRequired === false ? $this->drawAnswerBlock() : $this->drawLoginBlock();
    }

    public function drawReviews()
    {
        if ($this->drawAnswer) {
            $answer_block = $this->makeAnswerBlock();
        } else {
            $answer_block = '';
        }
        if ($this->canAnswer) {
            $answerForm = $this->drawAnswerForm();
        } else {
            $answerForm = '';
        }
        $this->reviewsHtml = strtr($this->getBlockTemplate('reviews'), [
          '{{products_id}}' => $this->products_id,
          '{{text}}'        => $this->reviews_blocks,
          '{{pagination}}'  => $this->pagination,
          '{{answer}}'      => $answer_block,
          '{{answer_form}}' => $answerForm,
        ]);
    }

    public function drawAnswerButton()
    {
        if ($this->canAnswer) {
            $this->answerButton = strtr($this->getBlockTemplate('answer_button'), [
                '{{REVIEWS_ANSWER_BUTTON_TITLE}}' => REVIEWS_ANSWER_BUTTON_TITLE,
            ]);
        } else {
            $this->answerButton = '';
        }
    }

    public function drawAnswerForm()
    {
        return strtr($this->getBlockTemplate('answer_form'), [
            '{{REVIEWS_ANSWER_BUTTON_TITLE}}' => REVIEWS_ANSWER_BUTTON_TITLE,
            '{{header}}'             => REVIEWS_HEADER,
            '{{customer_id}}'        => $this->customer_id,
            '{{product_id}}'         => $this->products_id,
            '{{placeholderName}}'    => REVIEWS_ENTRY_NAME,
            '{{placeholderComment}}' => REVIEWS_ENTRY_TEXT,
            '{{buttonSend}}'         => BUTTON_SEND,
            '{{buttonCancel}}'       => BUTTON_CANCEL,
            '{{customer_name}}'      => $this->customer_name,
            '{{recaptchaContainer}}' => $this->getRecaptcha()
        ]);
    }

    public function drawAllReviews()
    {
        $this->reviewsHtml = strtr($this->getBlockTemplate('reviews'), [
          '{{blocks}}' => $this->reviews_blocks,
        ]);
    }

    public function getReviewContainer()
    {
        global $languages_id;

        $this->setLanguageId($languages_id);
        $this->getReviewsQuery();
        $this->setQueryOrder();
        $this->fetchReviews();
        //        if (!$this->lastPageArrived) {
        $this->drawAnswerButton();
        $this->drawReviewsBlocks();
        //        }
    }

    public function getAllReviewContainer()
    {
        $this->getReviewsQuery();
        $this->setQueryOrder();
        $this->fetchReviews();
        if (!$this->lastPageArrived) {
            $this->drawAllReviewsBlocks();
        }
    }

    public function printReviews()
    {
        $this->getReviewContainer();
        $this->drawReviews();
        echo $this->reviewsHtml;
    }

    public function addReview($data)
    {
        tep_db_perform(self::$table, $data['review']);
        $id                                = tep_db_insert_id();
        $data['review_desc']['reviews_id'] = $id;
        tep_db_perform(self::$tableDesc, $data['review_desc']);
    }

    private static function getBlockTemplate($blockName)
    {
        if (file_exists($filename = DIR_FS_CATALOG . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/reviews/' . $blockName . '.tpl.php')) {
            return file_get_contents($filename);
        } elseif (file_exists($filename = DIR_FS_CATALOG . DIR_WS_CONTENT . 'reviews/' . $blockName . '.tpl.php')) {
            return file_get_contents($filename);
        } else {
            return '';
        }
    }

    public static function drawRatingBlock($rating)
    {
        $ratingPercent = $rating * 20;
        return strtr(self::getBlockTemplate('rating'), [
            '{{rating_value}}'  => $ratingPercent,
        ]);
    }
    public static function drawQuantityBlock($count, $text)
    {
        return strtr(self::getBlockTemplate('quantity'), [
            '{{count}}'  => $count,
            '{{text}}'  => $text,
        ]);
    }

    public function getRecaptcha()
    {
        $recaptcha = '';

        if (defined('GOOGLE_RECAPTCHA_STATUS') && constant('GOOGLE_RECAPTCHA_STATUS') == 'true' && file_exists(DIR_FS_EXT . "recaptcha/recaptcha.php")) {
            ob_start();
            require DIR_FS_EXT . "recaptcha/recaptcha.php";
            $recaptcha = ob_get_clean();
        }

        return $recaptcha;
    }
    public function drawAnswerBlock()
    {

        return strtr($this->getBlockTemplate('answer'), [
          '{{header}}'             => REVIEWS_HEADER,
          '{{customer_id}}'        => $this->customer_id,
          '{{product_id}}'         => $this->products_id,
          '{{placeholderName}}'    => REVIEWS_ENTRY_NAME,
          '{{placeholderComment}}' => REVIEWS_ENTRY_TEXT,
          '{{buttonSend}}'         => BUTTON_SEND,
          '{{customer_name}}'      => $this->customer_name,
          '{{recaptchaContainer}}' => $this->getRecaptcha()
        ]);
    }
    public static function count_comments($products_id, $reviews_type = 1)
    {
        global $languages_id;

        $countcomment = tep_db_query("
                                    SELECT count(r.reviews_id) as count, AVG(r.reviews_rating) as average 
                                    FROM " . self::$table . " r
                                    JOIN " . TABLE_REVIEWS_DESCRIPTION . " rd ON r.reviews_id = rd.reviews_id AND rd.languages_id = " . (int)$languages_id . "
                                    WHERE r.products_id=" . (int)$products_id . " 
                                        AND r.reviews_type='" . tep_db_prepare_input($reviews_type) . "'
                                        ");
        $out = tep_db_fetch_array($countcomment);
        if (empty($out)) {
            $out = ['count' => 0,'average' => 0];
        }
        return $out;
    }
    public function renderScripts()
    {
        global $assets;

        $assets->jsInline[] = '
        function addReview(block_selector){
        $(\'.reviews-errors\').remove();
        var block = $(block_selector);
        if (!block.length) return false;
        var cid = block.find(\'[name="cid"]\').val();
        var pid = block.find(\'[name="pid"]\').val();
        var text = block.find(\'[name="text"]\').val();
        var name = block.find(\'[name="name"]\').val();
        var parent_id = block.find(\'[name="parent_id"]\').val();
        var rating = block.find(\'[name="rating"]\').val()||5;
        if (!text || !name || !rating){
            return false;
        }
        var formData = {
            cid:cid||0,
            pid:pid,
            text:text,
            rating:rating,
            name:name,
            parent_id: parent_id,
            action:\'addReview\',
        };
            $.ajax({
            url:\'' . $this->ajaxPath . '\',
            method:\'post\',
            dataType:\'json\',
            data:formData,
            beforeSend: function(r){
                block.addClass(\'pointer_events_none\');
            },
            success: function(r){
                $(".comment-reply-block,.comment clearfix.leave_comment_form").detach().insertAfter($(\'.add_comment_box\')).hide();
                if (r.html.length) $(\'.reviews_container\').html(r.html);
                if (r.rating.length) $(\'.rating_product>div\').html(r.rating);
                if (r.count.length) $(\'#comment-tab-count\').html(r.count);
                block.removeClass(\'pointer_events_none\');
                block.find(\'[name="text"]\').val(\'\');
                block.find(\'[name="rating"]\').val(\'5\');
                block.find(\'.average\').css(\'width\',\'100%\')
            }
        })
    }
    
    document.addEventListener("DOMContentLoaded", function(){
        $(document).on(\'click\', \'.reviews_container .pagination li:not(.active)>a, .reviews_container .pagination li:not(.active)>span\', function(e){
            e.preventDefault();
            var paramString = $(this).attr(\'href\').split(\'.html\').pop()
            var params = new URLSearchParams(paramString);
            var rpage = params.get(\'rpage\') || 1;
            $.ajax({
                url:\'' . $this->ajaxPath . '?rpage=\'+rpage,
                method:\'post\',
                dataType:\'json\',
                data:{action:\'getMore\',pid:$(\'input[name="reviews_products_id"]\').val()},
                success: function(r){
                    var url = new URL(window.location);
                    if (rpage == 1){
                        url.searchParams.delete(\'rpage\')
                    } else {
                        url.searchParams.set(\'rpage\', rpage);
                    }
                    window.history.replaceState(\'\', \'\',url.href)
                    if (r.html.length) $(\'.reviews_container\').html(r.html);
                }
            })
        });
        $(document).on(\'click\', \'.add_comment_box .review_score>span\',function(){
            var val = $(this).data(\'val\');
            $(\'.add_comment_box [name="rating"]\').val(val);
            $(\'.add_comment_box .average\').css(\'width\',val*20+\'%\');
        });
        $(document).on(\'click\', \'.comment-reply-block .review_score>span\',function(){
            var val = $(this).data(\'val\');
            $(\'.comment-reply-block [name="rating"]\').val(val);
            $(\'.comment-reply-block .average\').css(\'width\',val*20+\'%\');
        });
        $(document).on(\'click\', \'.rating_product .review_score>span\',function(){
            var val = $(this).data(\'val\');
            $(\'.add_comment_box [name="rating"]\').val(val);
            $(\'.add_comment_box .average\').css(\'width\',val*20+\'%\');
            $(\'#tab-comments-anchor\').click();
            $("html, body").animate({
              scrollTop:$(\'#tab-comments-anchor\').offset().top
            },1000);
        });
        $(document).on(\'click\', \'.comment-reply-block .review_score>a\',function(){
            var val = $(this).data(\'val\');
            $(\'.comment-reply-block [name="rating"]\').val(val);
            $(\'.comment-reply-block .average\').css(\'width\',val*20+\'%\');
        });
        $(\'.reviews_container\').on(\'click\', \'.reply-to-comment\', function(e) {
        e.preventDefault();
            $(\'.reply-to-comment\').show();
            $(this).hide();
            var review_id = $(this).parent().data(\'id\');
            $(\'.comment-reply-block .comment-skin-body input[name=parent_id]\').val(review_id);
            $(".comment-reply-block,.comment clearfix.leave_comment_form").detach().insertAfter(this).removeClass(\'hidden\').hide().slideDown();
        });
        $(\'.comment-reply-block\').on(\'click\', \'.cancel-reply-to-comment\', function() {
            $(\'.reply-to-comment\').show();
            $(".comment-reply-block,.comment clearfix.leave_comment_form").slideUp(\'fast\');
        });
    })
        ';
    }
    public function renderScriptsModal()
    {
        global $assets;

        $assets->jsInline[] = '
        function addReview(){
        var block = $(\'.add_comment_box\');
        if (!block.length) return false;
        var cid = block.find(\'[name="cid"]\').val();
        var pid = block.find(\'[name="pid"]\').val();
        var text = block.find(\'[name="text"]\').val();
        var name = block.find(\'[name="name"]\').val();
        var rating = block.find(\'[name="rating"]\').val()||5;
        if (!text || !name || !rating){
            return false;
        }
        var formData = {
            cid:cid||0,
            pid:pid,
            text:text,
            rating:rating,
            name:name,
            action:\'addReview\',
        };
            $.ajax({
            url:\'' . $this->ajaxPath . '\',
            method:\'post\',
            dataType:\'json\',
            data:formData,
            beforeSend: function(r){
                block.addClass(\'pointer_events_none\');
            },
            success: function(r){
                if (r.html.length) $(\'.reviews_container\').html(r.html);
                if (r.rating.length) $(\'.rating_product>div\').html(r.rating);
                if (r.count.length) $(\'#comment-tab-count\').html(r.count);
                block.removeClass(\'pointer_events_none\');
                block.find(\'[name="text"]\').val(\'\');
                block.find(\'[name="rating"]\').val(\'5\');
                block.find(\'.average\').css(\'width\',\'100%\')
            }
        })
    }
   
        $(document).on(\'click\', \'.reviews_container .pagination li:not(.active)>a\', function(e){
            e.preventDefault();
            var paramString = $(this).attr(\'href\').split(\'.html\').pop();
            var params = new URLSearchParams(paramString);
            var rpage = params.get(\'rpage\') || 1;
            $.ajax({
                url:\'' . $this->ajaxPath . '?rpage=\'+rpage,
                method:\'post\',
                dataType:\'json\',
                data:{action:\'getMore\',pid:$(\'input[name="reviews_products_id"]\').val()},
                success: function(r){
                    var url = new URL(window.location);
                    if (rpage == 1){
                        url.searchParams.delete(\'rpage\')
                    } else {
                        url.searchParams.set(\'rpage\', rpage);
                    }
                    window.history.replaceState(\'\', \'\',url.href);
                    if (r.html.length) $(\'.reviews_container\').html(r.html);
                }
            })
        });
        $(document).on(\'click\', \'.add_comment_box .review_score>span\',function(){
            var val = $(this).data(\'val\');
            $(\'.add_comment_box [name="rating"]\').val(val);
            $(\'.add_comment_box .average\').css(\'width\',val*20+\'%\');
        })
        ';
    }


    public function setIsLoginRequired($isLoginRequired)
    {
        $this->isLoginRequired = $isLoginRequired;
    }
}
