<?php
$free_subscribe_tpl_link = 'https://solomono.net/' . $lng->language['code'] . '/subscription.html?package=free&from=' . $_SERVER['SERVER_NAME'];
$subscribe_tpl_link = 'https://solomono.net/' . $lng->language['code'] . '/subscription.html?from=' . $_SERVER['SERVER_NAME'];
$buy_tpl_link = 'https://solomono.net/' . $lng->language['code'] . '/pricing.html?type=p&from=' . $_SERVER['SERVER_NAME'];
$to_date = getenv('TRIAL_END_DATE');
$checkIsSiteAvailable = true;
if ($_GET['checksite'] != 'true' && !empty($to_date) && is_numeric($to_date) && $to_date < strtotime("now")) {
    $checkIsSiteAvailable = false;
}

if ((getenv('APP_ENV') == 'trial' && !$checkIsSiteAvailable) || (getenv('SUBSCRIPTION_STATUS' == 'overdue'))) { ?>
    <div class="container test-over_wrapper">
        <h1 class="test-over_title"><?php echo TEST_PERIOD_OVER_TITLE; ?></h1>
        <div class="test-over-flex">
            <p class="test-over-text"><?php echo TEST_PERIOD_OVER_CHOOSE_VAR; ?></p>
            <?php
            $to_date = getenv('TRIAL_END_DATE');
            $end_date = new DateTime(date("Y-m-d", strtotime('+14 days', $to_date)));
            $now = new DateTime(date("Y-m-d"));
            ?>
            <p class="test-over-date"><?php echo TEST_PERIOD_TIME_TO_DELETE1 . ' <span class="packet_name"> ' . $end_date->diff($now)->days . ' ' . TEST_PERIOD_TIME_TO_DELETE2; ?></span></p>
        </div>
        <div class="row item_wrapper flex_center" id="js-item_wrapper">
            <div class="col-sm-3 col-xs-12">
                <div class="item">
                    <span class="packet_name"><?php echo TEST_PERIOD_PACKET1_NAME; ?></span>

                    <span class="packet_price"><?php echo '0$/' . TEST_PERIOD_MONTH; ?></span>

                    <p class="packet_text"><?php echo TEST_PERIOD_PACKET1_TEXT; ?></p>
                    <a href="<?php echo $free_subscribe_tpl_link; ?>" target="_blank">
                        <div class="button_choose"><?php echo TEST_PERIOD_PACKET_FREE_SUBSCRIBE_BTN; ?></div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="item">
                    <span class="packet_name"><?php echo TEST_PERIOD_PACKET2_NAME; ?></span>

                    <span class="packet_price"><?php echo TEST_PERIOD_FROM . ' 10$/' . TEST_PERIOD_MONTH; ?></span>

                    <p class="packet_text"><?php echo TEST_PERIOD_PACKET2_TEXT; ?></p>
                    <a href="<?php echo $subscribe_tpl_link; ?>" target="_blank">
                        <div class="button_choose"><?php echo TEST_PERIOD_PACKET_SUBSCRIBE_BTN; ?></div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="item">
                    <span class="packet_name"><?php echo TEST_PERIOD_PACKET3_NAME; ?></span>

                    <span class="packet_price"><?php echo TEST_PERIOD_FROM . ' 100$'; ?></span>

                    <p class="packet_text"><?php echo TEST_PERIOD_PACKET3_TEXT; ?></p>
                    <a href="<?php echo $buy_tpl_link; ?>" target="_blank">
                        <div class="button_choose"><?php echo TEST_PERIOD_PACKET_BUY_BTN; ?></div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const itemSelector = ".item"
        document.getElementById('js-item_wrapper').addEventListener('click', function (e) {
            document.querySelectorAll(".item.active").forEach(function (item) {
                item.classList.remove('active');
            })
            event.target.closest(itemSelector).classList.add('active');
        })
    </script>

    </body>
    <?php die; ?>
<?php } elseif ( getConstantValue('PRODUCTS_LIMIT_REACHED',false) == 'true') { ?>
    <div class="container test-over_wrapper">
        <h1 class="test-over_title"><?php echo PRODUCT_LIMITS_IS_REACHED_TEXT; ?></h1>
        <div class="test-over-flex">
            <p class="test-over-text"><?php echo PRODUCT_LIMITS_IS_REACHED_DESC1; ?><br><a href="mailto:admin@solomono.net" >admin@solomono.net</a></p>
        </div>
    </div>
    </body>
    <?php die;
}?>
