<?php

if (empty($_POST['action'])) {
    die;
}

$_POST['pid'] = isset($_POST['pid']) ? (int) $_POST['pid'] : 0;

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require('includes/application_top.php');
require('ext/reviews/reviews.php');
includeLanguages('includes/languages/' . $language . '/product_info.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . 'reviews.json');
$reviews = new reviews();
//$reviews->setLanguageId($languages_id);
$postData = tep_db_prepare_input($_POST);
switch ($_POST['action']) :
    case 'addReview':
        if (GOOGLE_RECAPTCHA_STATUS === 'true' && file_exists(DIR_WS_EXT . "recaptcha/recaptcha.php")) {
            if ($_SESSION['recaptcha'] !== true) {
                $rating = Reviews::count_comments($postData['pid']);
                $reviews->getReviewContainer();
                echo json_encode(
                    [
                        'html' => $reviews->reviews_blocks . $reviews->pagination . '</ul></nav><div class = "h3 reviews-errors">ReCaptcha error</div>',
                        'count' => "({$rating['count']})",
                        'rating' => Reviews::drawRatingBlock($rating['average']) . Reviews::drawQuantityBlock($rating['count'],
                                TEXT_REVIEWSES)
                    ]
                );
                die;
            }
            unset($_SESSION['recaptcha']);
        }
        $data = [
            'review' => [
                'products_id' => $postData['pid'],
                'customers_id' => $postData['cid'],
                'customers_name' => $postData['name'],
                'reviews_rating' => $postData['rating'],
                'date_added' => date('Y-m-d H:i:s'),
                'reviews_type' => 1,
                'parent_id' => (int)$postData['parent_id'],
            ],
            'review_desc' => [
                'reviews_text' => $postData['text'],
                'languages_id' => (int)$languages_id,
            ],
        ];
        $reviews->addReview($data);
        $reviews->setProductId($postData['pid']);
        $reviews->getReviewContainer();
        $rating = Reviews::count_comments($postData['pid']);

        echo json_encode(
            [
                'html' => $reviews->reviews_blocks . $reviews->pagination,
                'count' => "({$rating['count']})",
                'rating' => Reviews::drawRatingBlock($rating['average']) . Reviews::drawQuantityBlock($rating['count'],
                        TEXT_REVIEWSES)
            ]
        );
        break;
    case 'getMore':
        if (!empty($postData['pid'])) {
            $reviews->setProductId($postData['pid']);
        }
        $reviews->getReviewContainer();
        echo json_encode(
            ['html' => $reviews->reviews_blocks . $reviews->pagination]
        );
        die;
    case 'getAllMore':
        $reviews->setReviewsPerPage(20); // 1 - products
        $reviews->setShowImage(true); // 1 - products
        $reviews->getAllReviewContainer();
        echo json_encode(
            ['html' => $reviews->reviews_blocks, 'lastPage' => $reviews->lastPageArrived]
        );
    default:
        die;
endswitch;
